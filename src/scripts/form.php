<?php

namespace App\scripts;
use App\scripts\Pes;
// use App\scripts\SQLHandle;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FormToSQL {


  function parsePostVrh($input, $conn, $user) {
    $vrh = new Vrh;

    foreach($input as $key => $value) {
      if ((int)substr($key,-1) === 1 && $value !== '') {
        $name = substr($key, 0, -1);
        $vrh->$name = $value;
      }
    }
    return $vrh;
  }

  function parsePostPes($input, $conn, $user) {

    foreach($input as $key => $value) {
      $cislo_psa = (int)substr($key,-1);
      if ($cislo_psa > 1 && $value !== '') {
        if(!isset($pes[$cislo_psa])) {
          $pes[$cislo_psa] = new Pes;
        }
        $name = substr($key, 0, -1);
        $pes[$cislo_psa]->$name = $value;
      }
    }
    return $pes;
  }

}


 ?>
