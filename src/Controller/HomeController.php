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

  public function login(Request $request): Response {
    $type = $request->query->get('failed');

    if ($type === '1') {
      $error = 'Nepodařilo se přihlásit. Špatné jméno nebo heslo';
    } elseif ($type === '2') {
      $error = 'Byl překročen počet pokusů. Zkuste to za chvíli';
    } else {
      $error = 0;
    }
    return $this->render('home/login.html.twig', [
      'error' => $error
    ]);

  }

  public function logged() {

    if ($this->session->get('logged') === false) {
      require_once('../src/scripts/login.php');
      $errinfo = checkLoginInformation($_POST["name"], $_POST["password"], $this->session);
    }


    if ($this->session->get('logged') === true) {
      return $this->render('home/logged.html.twig', [
      ]);
    } else {
      return $this->redirectToRoute('login', ['failed' => $errinfo]);
    }
  }

  public function logout() {
    $this->session->set('logged', false);
    $this->session->set('level', '');
    $this->session->set('name', '');
    return $this->redirectToRoute('login');
  }
}


 ?>
