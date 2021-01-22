<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Session\Session;

class Database extends AbstractController {

  public function overview(EntityManagerInterface $em) {
    $this->entityManager = $em;


    $qb = $this->entityManager->createQueryBuilder();
    $qb
        ->select('a', 'u')
        ->from('App\Entity\Psi', 'a')
        ->join('a.vrh', 'u');
    $result = $qb->getQuery()->getResult();

    // $query = $em->createQueryBuilder();
    //
    // $query->select('p', 'v')
    //     ->from('App\Entity\Psi', 'p')
    //     ->join(
    //         'App\Entity\Vrh',
    //         'v',
    //         \Doctrine\ORM\Query\Expr\Join::WITH,
    //         'p.vrh = v.id'
    //     );

        // $result = $query->getQuery()->getResult();


    return $this->render('home/overview.html.twig', [
      'psi' => $result
    ]);
  }


  public function database() {

    // require_once('../src/scripts/login.php');


    // $sql = "SELECT count(login) FROM login WHERE datum > '$datum_past' AND IP = '$ip' AND SUCCESS = '0'";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //       $pocet_prihlaseni = $row['count(login)'];
    //   }
    // }

    return $this->render('home/database.html.twig', [
    ]);

  }
}

 ?>
