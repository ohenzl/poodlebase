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
      $vrh_id = $conn->insert_id;  //získání ID
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  function kontrolaDatabaze($jmeno, $chovatelska_stanice, $conn, $pohlavi) {

    $sql = "SELECT * FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.jmeno = '$jmeno' and v.stanice = '$chovatelska_stanice'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        return $row['ID'];
      }
    } else {
      $this->pridatPsa($jmeno, $chovatelska_stanice, $conn, $user, $pohlavi);
    }
  }

  function addVrh($input, $conn, $user) {
    $vrh = new Vrh;
    //kontrola otce
    if ($input['otec_jmeno1'] !== '') {
      $vrh->otec_ID = $this->kontrolaDatabaze($input['otec_jmeno1'], $input['otec_chov1'], $conn, 'pes');
    }
    //kontrola matky
    if ($input['matka_jmeno1'] !== '') {
      $vrh->matka_ID = $this->kontrolaDatabaze($input['matka_jmeno1'], $input['matka_chov1'], $conn, 'fena');
    }

  }


  function addPost($input, $conn, $user) {

    $inner_co = '';
    $inner_kam = '';

    foreach($input as $key => $value) {
      if ((int)substr($key,-1) === 1 && $value !== '') {
        $vrh[$key] = $value;

        $inner_co .= "'" . $value . "', ";
        $inner_kam .= substr($key, 0, -1) . ", ";

      }
    }

    $inner_co = substr($inner_co, 0, -2);
    $inner_kam = substr($inner_kam, 0, -2);
    $datetime = date("Y-m-d H:i:s");

    $co = "VALUES ($inner_co, '$user', '$datetime');";
    $kam = "INSERT INTO vrh ($inner_kam, vloz_osoba, vloz_datum) ";
    $sql = $kam . $co;

    foreach($input as $key => $value) {
      if ((int)substr($key,-1) === 1 && $value !== '') {
        $vrh[$key] = $value;
      } elseif ((int)substr($key,-1) !== 1 && $value !== '')  {

      }
    }
    // echo $sql;
    if(isset($vrh)) {
      if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      echo "New record created successfully. Last inserted ID is: " . $last_id;
      echo $last_id;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // echo var_dump($vrh) . "<br>";
    } else {
      echo "nevkládám, protože není vrh";
    }

      $post = $sql;
      // $post = $input;
      return $post;
  }
}


 ?>
