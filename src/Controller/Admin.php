<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\FormAdd;

class Admin extends AbstractController {

  // require_once('../src/scripts/logincheck.php');

  // require '../src/scripts/logincheck.php';

  public $session;

  public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

  public function admin() {
    // loginCheck();
    // $sql = "SELECT count(login) FROM login WHERE datum > '$datum_past' AND IP = '$ip' AND SUCCESS = '0'";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //       $pocet_prihlaseni = $row['count(login)'];
    //   }
    // }
    return $this->render('home/admin.html.twig', [
    ]);
  }

  public function add() {

    // $name = 'narozeni';
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

  public function adding() {

    $post = $_POST;

    return $this->render('home/admin/adding.html.twig', [
      'post' => $post
    ]);
  }


}

 ?>
