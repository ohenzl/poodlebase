<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\FormAdd;
use App\scripts\SQLHandle;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\scripts\FormToSQL;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\scripts\AdminArea;
use App\scripts\PesBase;

class Admin extends AbstractController
{

    // require_once('../src/scripts/logincheck.php');

    // require '../src/scripts/logincheck.php';

    public $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function admin(AuthenticationUtils $authenticationUtils)
    {

        $conn = SQLHandle::databaseConnect();
        // $conn = $db->databaseConnect();
        $admin_info = new AdminArea($conn, $authenticationUtils->getLastUsername());
        $last_dogs = $admin_info->getLastDogs();

        // $user = $authenticationUtils->getLastUsername();

        return $this->render(
            'home/admin.html.twig', [
            'last_dogs' => $last_dogs
            ]
        );
    }

    public function add()
    {
        $form = $this->getDoctrine()
            ->getRepository(FormAdd::class)->findBy(
                ['ucel' => '0']
            );


        return $this->render(
            'home/admin/add.html.twig', [
            'forms' => $form,
            'pedigree' => array(1, 2, 4, 8, 16)
            ]
        );
    }

    public function adding(AuthenticationUtils $authenticationUtils, Request $request)
    {


        //PŘIDÁVÁNÍ DO DATABÁZE
        $user = $authenticationUtils->getLastUsername();
        $conn = SQLHandle::databaseConnect();
        $form_handle = new FormToSQL;

        //rodokmen
        $pedigree = $form_handle->parsePostPedigree($_POST);
        $form_handle->pedigreeIntoDatabase($pedigree, $conn, $user);

        $vrh = $form_handle->parsePostVrh($_POST);
        $vrh->matka_id = $pedigree->matka_id;
        $vrh->otec_id = $pedigree->otec_id;
        $vrh->ID = $vrh->addOrEdit($conn, $user);
        $psi = $form_handle->parsePostPes($_POST);
        foreach ($psi as $pes) {
            $pes->addOrEdit($conn, $user, $vrh);
        }



        return $this->render(
            'home/admin/adding.html.twig', [
            'post' => $vrh
            ]
        );
    }

    public function editVrh()
    {

        $form = $this->getDoctrine()
            ->getRepository(FormAdd::class)->findBy(
                ['nadrazeny' => 'Vrh']
            );

        return $this->render(
            'home/admin/editvrh.html.twig', [
            'forms' => $form,
            'typ' => 'editingVrh'
            ]
        );
    }


    public function editingVrh(AuthenticationUtils $authenticationUtils, Request $request)
    {

        //ÚPRAVA DATABÁZE
        $user = $authenticationUtils->getLastUsername();
        $conn = SQLHandle::databaseConnect();
        $form_handle = new FormToSQL;
        $vrh = $form_handle->parsePostVrh($_POST);
        $vrh->editVrh($vrh->ID, $user, $conn);

        return $this->render(
            'home/admin/adding.html.twig', [
            'post' => $vrh
            ]
        );
    }


    public function checkSqlVrh(Request $request)
    {
        $request = Request::createFromGlobals();

        $conn = SQLHandle::databaseConnect();
        $form_handle = new FormToSQL;
        $rq = $request->query->all();
        $vrh = $form_handle->parsePostVrh($rq);
        $sql = $vrh->checkVrh($conn);

        return new JsonResponse(
            $sql,
            200
        );
    }

    public function editPes(EntityManagerInterface $em, $dogID)
    {
        $this->entityManager = $em;

        $query = $this->entityManager->createQuery(
            'SELECT f
            FROM App\Entity\FormAdd f
            WHERE f.nadrazeny = :nadrazeny OR f.name = :name'
        )->setParameter('nadrazeny', 'psi')->setParameter('name', 'stanice');

        $form = $query->getResult();

        return $this->render(
            'home/admin/editpes.html.twig', [
            'forms' => $form,
            'typ' => 'editingPes',
            'nadpise' => 'Úprava psa',
            'dogID' => $dogID
            ]
        );
    }


    public function editingPes(AuthenticationUtils $authenticationUtils, Request $request)
    {

        //ÚPRAVA DATABÁZE
        $user = $authenticationUtils->getLastUsername();
        $conn = SQLHandle::databaseConnect();
        $form_handle = new FormToSQL;
        $pes = $form_handle->parsePostPes($_POST);
        current($pes)->fullEdit(current($pes)->ID, $user, $conn);

        return $this->render(
            'home/admin/adding.html.twig', [
            'post' => $pes
            ]
        );
    }


    public function checkSqlPes(Request $request)
    {
        $request = Request::createFromGlobals();
        $conn = SQLHandle::databaseConnect();
        $form_handle = new FormToSQL;
        $rq = $request->query->all();
        $pes = $form_handle->parsePostPes($rq);
        // echo var_dump($form_handle);
        $sql = current($pes)->checkSql($conn);

        return new JsonResponse(
            $sql,
            200
        );
    }

    public function removePes(EntityManagerInterface $em)
    {
        $this->entityManager = $em;

        $query = $this->entityManager->createQuery(
            'SELECT f
            FROM App\Entity\FormAdd f
            WHERE f.nadrazeny = :nadrazeny OR f.name = :name'
        )->setParameter('nadrazeny', 'psi')->setParameter('name', 'stanice');

        $form = $query->getResult();

        return $this->render(
            'home/admin/editpes.html.twig', [
            'forms' => $form,
            'typ' => '/admin/removingPes',
            'nadpise' => 'Mazání psa'
            ]
        );
    }

    public function removingPes(AuthenticationUtils $authenticationUtils, Request $request)
    {

        $request = Request::createFromGlobals();
        $rq = $request->request->all()['pes'][1]['ID'];

        $conn = SQLHandle::databaseConnect();
        $sql = "DELETE FROM psi WHERE ID = '$rq'";

        if ($conn->query($sql) === true) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        return $this->render(
            'home/admin/adding.html.twig', [
            'post' => $sql
            ]
        );
    }

    public function removeVrh(EntityManagerInterface $em)
    {
        $form = $this->getDoctrine()
            ->getRepository(FormAdd::class)->findBy(
                ['nadrazeny' => 'Vrh']
            );

        return $this->render(
            'home/admin/editvrh.html.twig', [
            'forms' => $form,
            'typ' => '/admin/removingVrh',
            'nadpise' => 'Mazání vrhu'
            ]
        );
    }

    public function removingVrh(AuthenticationUtils $authenticationUtils, Request $request)
    {

        $request = Request::createFromGlobals();
        $rq = $request->request->all()['vrh']['ID'];

        $conn = SQLHandle::databaseConnect();
        $sql = "DELETE FROM vrh WHERE ID = '$rq'";

        if ($conn->query($sql) === true) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "DELETE FROM psi WHERE vrh = '$rq'";

        if ($conn->query($sql) === true) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        return $this->render(
            'home/admin/adding.html.twig', [
            'post' => $sql
            ]
        );
    }

    public function exists(Request $request)
    {

        $request = Request::createFromGlobals();
        $rq = $request->query->all();

        $conn = SQLHandle::databaseConnect();

        $dog = new PesBase;
        $dog->pes_jmeno = trim($rq['name']);
        $dog->stanice = trim($rq['stanice']);
        $exists = $dog->exists($conn);

        return new JsonResponse(
            $exists,
            200
        );

    }


}
?>
