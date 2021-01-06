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
            // ->getRepository(FormAdd::class)->findAll()[0]->getName();
            // ->find($name);

    // $repository = $this->getDoctrine()->getRepository(FormAdd::class);

    // $product = $repository->find($id);
    // require_once('../src/scripts/form.php');
    // $conn->close();

    return $this->render('home/admin/add.html.twig', [
      'forms' => $form
    ]);
  }

  public function adding(AuthenticationUtils $authenticationUtils) {

    $user = $authenticationUtils->getLastUsername();
    $db = new SQLHandle;
    $conn = $db->databaseConnect();
    $form_handle = new FormToSQL;
    $form_handle->addVrh($_POST, $conn, $user);


    $pes = $form_handle->pridatPsa();


    $post = $form_handle->addPost($_POST, $conn, $user);

    return $this->render('home/admin/adding.html.twig', [
      // 'post' => $post
      // 'post' => $_POST
      'post' => $pes
    ]);
  }


}

 ?>
