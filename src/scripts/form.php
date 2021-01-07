<?php

namespace App\scripts;
use App\scripts\Pes;
// use App\scripts\SQLHandle;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FormToSQL {

  function pridatPsa($jmeno, $chovatelska_stanice, $conn, $user, $pohlavi) {
    //vytváření vrh pro rodiče pouze s chovatelskou stanicí a získání ID
    $datetime = date("Y-m-d H:i:s");
    //sql pro vložení rodiče
    $co = "VALUES ('$chovatelska_stanice', '$user', '$datetime');";
    $kam = "INSERT INTO vrh (stanice , vloz_osoba, vloz_datum) ";
    $sql = $kam . $co;

    if ($conn->query($sql) === TRUE) {
      $vrh_id = $conn->insert_id;  //získání ID
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //zapsání rodiče
    $co = "VALUES ('$jmeno', '$pohlavi', '$vrh_id', '$user', '$datetime');";
    $kam = "INSERT INTO psi (jmeno, pohlavi, vrh, vloz_osoba, vloz_datum) ";
    $sql = $kam . $co;
    //zápis psa, získání ID rodiče
    if ($conn->query($sql) === TRUE) {
      $pes_id = $conn->insert_id;
      return $pes_id;  //získání ID
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  function kontrolaDatabaze($jmeno, $chovatelska_stanice, $conn, $pohlavi, $user) {
    $sql = "SELECT p.ID ID FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.jmeno = '$jmeno' and v.stanice = '$chovatelska_stanice'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        return $row['ID'];
      }
    } else {
      return $this->pridatPsa($jmeno, $chovatelska_stanice, $conn, $user, $pohlavi);
    }
  }


  function parsePostVrh($input, $conn, $user) {
    $vrh = new Vrh;

    foreach($input as $key => $value) {
      if ((int)substr($key,-1) === 1 && $value !== '') {
        $name = substr($key, 0, -1);
        $vrh->$name = $value;
      }
    }
    //kontrola otce
    if ($input['otec_jmeno1'] !== '') {
      $vrh->otec_ID = $this->kontrolaDatabaze($input['otec_jmeno1'], $input['otec_chov1'], $conn, 'pes', $user);
    }
    //kontrola matky
    if ($input['matka_jmeno1'] !== '') {
      $vrh->matka_ID = $this->kontrolaDatabaze($input['matka_jmeno1'], $input['matka_chov1'], $conn, 'fena', $user);
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
