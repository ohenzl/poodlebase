<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
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
      'question' => 'hey how are you'
    ]);

  }

  public function logged() {

    require_once('../src/scripts/login.php');

    $person = checkLoginInformation($_POST["name"], $_POST["password"]);

    return $this->render('home/logged.html.twig', [
      'person' => $person,
    ]);

  }
}

 ?>
