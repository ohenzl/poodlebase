<?php

namespace App\scripts;
use App\scripts\Pes;
use App\scripts\Vrh;
// use App\scripts\SQLHandle;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FormToSQL {


  function parsePostVrh($input) {
    $vrh = new Vrh;

    foreach($input['vrh'] as $key => $value) {
        $vrh->$key = $value;
      }
    return $vrh;
  }

  function parsePostPes($input) {
    foreach($input['pes'] as $number => $dog) {
      $pes[$number] = new Pes;
      foreach($dog as $nazev => $data) {
        $pes[$number]->$nazev = $data;
      }
    }



    // foreach($input as $key => $value) {
    //   $cislo_psa = (int)substr($key,-1);
    //   if ($cislo_psa > 1 && $value !== '') {
    //     if(!isset($pes[$cislo_psa])) {
    //       $pes[$cislo_psa] = new Pes;
    //     }
    //     $name = substr($key, 0, -1);
    //     $pes[$cislo_psa]->$name = $value;
    //   }
    // }
    return $pes;
  }

}


 ?>
