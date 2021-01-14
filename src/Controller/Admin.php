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

class Admin extends AbstractController {

  // require_once('../src/scripts/logincheck.php');

  // require '../src/scripts/logincheck.php';

  public $session;

  public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

  public function admin() {
    return $this->render('home/admin.html.twig', [
    ]);
  }

  public function add() {
    $form = $this->getDoctrine()
                ->getRepository(FormAdd::class)->findBy(
                  ['ucel' => '0']
              );

    return $this->render('home/admin/add.html.twig', [
      'forms' => $form
    ]);
  }

  public function adding(AuthenticationUtils $authenticationUtils, Request $request) {


    //PŘIDÁVÁNÍ DO DATABÁZE
    $user = $authenticationUtils->getLastUsername();
    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $vrh = $form_handle->parsePostVrh($_POST);
    $vrh->ID = $vrh->addOrEdit($conn, $user);
    $psi = $form_handle->parsePostPes($_POST);
    foreach ($psi as $pes) {
      $psi_input[] = $pes->addOrEdit($conn, $user, $vrh);
    }

    return $this->render('home/admin/adding.html.twig', [
      'post' => $vrh
    ]);
  }

  public function editVrh() {

    $form = $this->getDoctrine()
                ->getRepository(FormAdd::class)->findBy(
                  ['nadrazeny' => 'Vrh']
              );

    return $this->render('home/admin/editvrh.html.twig', [
      'forms' => $form
    ]);
  }


  public function editingVrh(AuthenticationUtils $authenticationUtils, Request $request) {

    //ÚPRAVA DATABÁZE
    $user = $authenticationUtils->getLastUsername();
    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $vrh = $form_handle->parsePostVrh($_POST);
    $vrh->editVrh($vrh->ID, $user, $conn);

    return $this->render('home/admin/adding.html.twig', [
      'post' => $vrh
    ]);
  }


  public function checkSqlVrh(Request $request) {
    $request = Request::createFromGlobals();

    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $rq = $request->query->all();
    $vrh = $form_handle->parsePostVrh($rq);
    $sql = $vrh->checkVrh($conn);

    return new JsonResponse(
            $sql,
        200);
  }

  public function editPes(EntityManagerInterface $em) {

    $this->entityManager = $em;

    $query = $this->entityManager->createQuery(
            'SELECT f
            FROM App\Entity\FormAdd f
            WHERE f.nadrazeny = :nadrazeny OR f.name = :name'
        )->setParameter('nadrazeny', 'psi')->setParameter('name', 'stanice');

        $form = $query->getResult();

    return $this->render('home/admin/editpes.html.twig', [
      'forms' => $form
    ]);
  }


  public function editingPes(AuthenticationUtils $authenticationUtils, Request $request) {

    //ÚPRAVA DATABÁZE
    $user = $authenticationUtils->getLastUsername();
    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $pes = $form_handle->parsePostPes($_POST);
    current($pes)->edit(current($pes)->ID, $user, $conn);

    return $this->render('home/admin/adding.html.twig', [
      'post' => $pes
    ]);
  }


  public function checkSqlPes(Request $request) {
    $request = Request::createFromGlobals();

    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $rq = $request->query->all();
    $pes = $form_handle->parsePostPes($rq);
    // echo var_dump($form_handle);
    $sql = current($pes)->checkSql($conn);

    return new JsonResponse(
            $sql,
        200);
  }
}
 ?>
