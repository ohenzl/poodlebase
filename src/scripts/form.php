<?php

namespace App\scripts;
use App\scripts\Pes;
use App\scripts\PesDetail;
use App\scripts\Vrh;
// use App\scripts\SQLHandle;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FormToSQL {


  function parsePostVrh($input) {
    $vrh = new Vrh;

    foreach($input['vrh'] as $key => $value) {
        $vrh->$key = trim($value);
      }
    return $vrh;
  }


  function parsePostPes($input) {
    foreach($input['pes'] as $number => $dog) {
      $pes[$number] = new Pes;
      foreach($dog as $nazev => $data) {
        $pes[$number]->$nazev = trim($data);
      }
    }
    // echo var_dump($pes);
    return $pes;
  }


  function parsePostPedigree($input) {

    foreach($input['gen'] as $generation => $dogs) {
      foreach($dogs as $number => $data) {
        $pes[$generation][$number] = new PesDetail;
        // echo var_dump($data) . "<br>";
        // echo isset($data["jmeno"]) . "<br>";
        $pes[$generation][$number]->pes_jmeno = $data['jmeno'];
        $pes[$generation][$number]->stanice = $data['stanice'];
        $pes[$generation][$number]->pohlavi = $data['pohlavi'];
      }
    }

    $pedigree = new PesDetail;

    $this->createParentFromPedigree($pes, 1);

    $pedigree->otec = $pes[1][0];
    $pedigree->matka = $pes[1][1];

    return $pedigree;
  }

  function createParentFromPedigree($pes, $generation) {

    foreach ($pes[$generation] as $number => $pes_current) {

        $pes_current->otec = $pes[$generation+1][$number*2];
        $pes_current->matka = $pes[$generation+1][($number*2)+1];

      if ($generation < 3) {
        $this-> createParentFromPedigree($pes, ($generation+1));
      }

    }
  }

  function pedigreeIntoDatabase($pes, $conn, $user) {
    //předělat na to, že matka NEBO otec nejsou null
    if ($pes->otec !== null) {
      if ($pes->otec->pes_jmeno !== '') {
        $pes->otec_id = $this->pedigreeIntoDatabase($pes->otec, $conn, $user);
      }
    }
    if ($pes->matka !== null) {
      if ($pes->matka->pes_jmeno !== '') {
        $pes->matka_id = $this->pedigreeIntoDatabase($pes->matka, $conn, $user);
      }
    }
    // echo (!$pes->exists($conn, $pes->stanice));
    if (!$pes->exists($conn) && $pes->pes_jmeno !== null) {

      $vrh = new Vrh;
      $datetime = date("Y-m-d H:i:s");
      $co = "VALUES ('$pes->otec_id', '$pes->matka_id', '$pes->stanice', '$user', '$datetime');";
      $kam = "INSERT INTO vrh (otec_id, matka_id, stanice, vloz_osoba, vloz_datum) ";
      $sql = $kam . $co;
      if ($conn->query($sql) === TRUE) {
        $this->ID = $conn->insert_id;
        $id = $pes->add($conn, $user, $this);  //získání ID
        // echo var_dump($pes);
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      return $id;
    } else {
      return $pes->getID($conn, $pes->stanice);
    }
  }

}


 ?>
