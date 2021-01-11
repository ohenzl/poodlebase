<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\FormAdd;
use App\scripts\SQLHandle;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\scripts\FormToSQL;

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

  public function adding(AuthenticationUtils $authenticationUtils) {


    //ODKOMENTOVAT PRO ZNOVUZPŘÍSTUPNĚNÍ PŘIDÁVÁNÍ DO DATABÁZE

    $user = $authenticationUtils->getLastUsername();
    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    // $vrh = $form_handle->parsePostVrh($_POST, $conn, $user);
    // $vrh->id = $vrh->addOrEdit($conn, $user);
    // $psi = $form_handle->parsePostPes($_POST, $conn, $user);
    // foreach ($psi as $pes) {
    //   $psi_input[] = $pes->addOrEdit($conn, $user, $vrh);
    // }

    // $test = $_POST;
    $test = $form_handle->parsePostPes($_POST, $conn, $user);

    return $this->render('home/admin/adding.html.twig', [
      // 'post' => $vrh
      'post' => $test
    ]);
  }

  public function editVrh() {

    return $this->render('home/admin/editvrh.html.twig', [
      // 'forms' => $form
    ]);

  }


}

 ?>
