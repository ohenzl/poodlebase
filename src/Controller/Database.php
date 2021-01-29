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

    $parents_next = [];

    $dog = new PesDetail;
    $dog->getAllInfo($conn, $dogID);
    // $parents_next = array_merge($parents_next,$dog->createParents($conn));

    //gen = depth
    // for ($gen = 1; $gen < 6; $gen++) {
    //   $parents = $parents_next;
    //   $parents_next = [];
    //   foreach ($parents as $parent) {
    //     $parents_next = array_merge($parents_next,$parent->createParents($conn));
    //   }
    //   $parents = [];
    // }


    for ($i = 1; $i < 5; $i++) {
      $parents[$i] = [];
    }
    $parents[1] = array_merge($parents_next,$dog->createParents($conn));

    //gen = depth
    for ($gen = 2; $gen < 5; $gen++) {
      foreach ($parents[$gen-1] as $parent) {
        $parents[$gen] = array_merge($parents[$gen],$parent->createParents($conn));
      }
    }


    return $this->render('home/dogpage.html.twig', [
      'dog' => $dog,
      'dogs' => $parents
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
