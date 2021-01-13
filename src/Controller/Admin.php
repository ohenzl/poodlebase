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
                ->getRepository(FormAdd::class)->findAll();

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
    $vrh->id = $vrh->addOrEdit($conn, $user);
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
    $vrh->editVrh($vrh->id, $user, $conn);

    return $this->render('home/admin/adding.html.twig', [
      'post' => $vrh
    ]);
  }


  public function checkSqlVrh(Request $request) {
    $request = Request::createFromGlobals();

    // echo var_dump($test->request->all()) . "<br><br>";

    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;

    $rq = $request->query->all();

    $vrh = $form_handle->parsePostVrh($rq);
    $sql = $vrh->checkVrh($conn);
    // $sql = '';
    // foreach ($rq as $data => $value) {
    //   $sql .= "AND {$data} = '{$value}' ";
    // }

    // $ry = get_object_vars ( $rq );
    //
    // $form = $this->getDoctrine()
    //             ->getRepository(FormAdd::class)->findAll();

    return new JsonResponse(
            $sql,
        200);
  }

}
 ?>
