<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\scripts\PesDetail;
use App\scripts\SQLHandle;
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


    return $this->render('home/overview.html.twig', [
      'psi' => $result
    ]);
  }


  public function displayDog($dogID, EntityManagerInterface $em) {

    $db = new SQLHandle;
    $conn = $db->databaseConnect();


    $dogs[0][0] = new PesDetail;
    $dogs[0][0]->getAllInfo($conn, $dogID);
    $dogs[1][0] = $dogs[0][0]->createParent($conn, 'otec');
    $dogs[1][1] = $dogs[0][0]->createParent($conn, 'matka');
    $dogs[2][0] = $dogs[1][0]->createParent($conn, 'matka');

    // for ($gen = 1; $gen < 3; $gen++) {
    //   $dogNumberWithinGen = 0;
    //   foreach ($dogs[$gen-1] as $dog) {
    //     $dogs[$gen][$dogNumberWithinGen] = new PesDetail;
    //     $dogs[$gen][$dogNumberWithinGen]->ID = $dogs[$gen-1]
    //     $dog->getAllInfo($conn, $dogID);
    //     $dogNumberWithinGen++;
    //   }
    // }

    // $this->entityManager = $em;
    // $qb = $this->entityManager->createQueryBuilder();
    // $qb
    //     ->select('a', 'u')
    //     ->from('App\Entity\Psi', 'a')
    //     ->join('a.vrh', 'u')
    //     ->where("a.id = {$dogID}");
    // $dog = $qb->getQuery()->getResult()[0];

    return $this->render('home/dogpage.html.twig', [
      'dogs' => $dogs
    ]);

  }

  public function makeRouteWithDogsName($dogID, EntityManagerInterface $em) {

    $this->entityManager = $em;
    $qb = $this->entityManager->createQueryBuilder();
    $qb
        ->select('a', 'u')
        ->from('App\Entity\Psi', 'a')
        ->join('a.vrh', 'u')
        ->where("a.id = {$dogID}");
    $dog = $qb->getQuery()->getResult()[0];
    $dogname = $dog->getPesJmeno();
    $dogname .= "-" . $dog->getJoinedVrh()->getStanice();
    $dogname = (str_replace(' ', '-', $dogname));

    $location = "database/pes/$dogID/$dogname";


    return $this->redirectToRoute("displayDogWithDog", ['dogID' => $dogID, 'dogname' => $dogname]);
  }


}

 ?>
