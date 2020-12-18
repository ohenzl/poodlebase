<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
// use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController {

  private $session;

  public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

  public function homepage() {

    return new Response('ASDFG');
  }

  public function show() {

    return $this->render('home/show.html.twig', [
      'question' => 'hey how are you'
    ]);

  }

  public function login() {

    return $this->render('home/login.html.twig', [
    ]);
  }

  public function logged() {

    if ($this->session->get('logged') === false) {
      require_once('../src/scripts/login.php');
      checkLoginInformation($_POST["name"], $_POST["password"], $this->session);
    }


    if ($this->session->get('logged') === true) {
      return $this->render('home/logged.html.twig', [
      ]);
    } else {
      return $this->render('home/login.html.twig', [
      ]);
    }
  }

  public function logout() {
    $this->session->set('logged', false);
    $this->session->set('name', '');
    return $this->render('home/login.html.twig', [
    ]);
  }
}

 ?>
