<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController {

  public $session;

  public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

  public function homepage() {

    return $this->render('base.html.twig', [
    ]);
  }

  public function show() {

    return $this->render('home/show.html.twig', [
      'question' => 'hey how are you'
    ]);

  }
}


 ?>
