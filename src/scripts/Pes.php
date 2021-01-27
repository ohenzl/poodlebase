<?php

namespace App\scripts;
use App\scripts\PesBase;

  class Pes extends PesBase {

    function addOrEdit($conn, $user, $vrh) {
      echo $this->pes_jmeno . " " . $vrh->stanice . "<br>";
      $sql = "SELECT p.ID ID FROM vrh v JOIN psi p ON p.vrh=v.ID WHERE p.pes_jmeno = '$this->pes_jmeno' AND v.stanice = '$vrh->stanice'";
      echo $sql . "<br>";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $this->edit($row['ID'], $user, $conn);
        }
      } else {
        return $this->add($conn, $user, $vrh);
      }
    }

    function add($conn, $user, $vrh) {
      $datetime = date("Y-m-d H:i:s");
      $co = "VALUES ('$this->pes_jmeno', '$this->pohlavi', '$this->barva', '$this->srst', '$vrh->ID', '$this->cmku_pref', '$this->cmku', '$this->cip', '$user', '$datetime');";
      $kam = "INSERT INTO psi (pes_jmeno, pohlavi, barva, srst, vrh, cmku_pref, cmku, cip, vloz_osoba, vloz_datum) ";
      $sql = $kam . $co;
      //zápis psa, získání ID rodiče
      if ($conn->query($sql) === TRUE) {
        // return $conn->insert_id;  //získání ID
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function edit($ID, $user, $conn) {
      $datetime = date("Y-m-d H:i:s");
      $objects = get_object_vars($this);
      $sql = "UPDATE psi SET ";
      foreach ($objects as $nazev => $hodnota) {
        if ($nazev !== 'ID' && $nazev !== 'stanice') {
          if ($nazev !== 'vrh' || $hodnota !== '') {
            $sql .= "{$nazev} = '{$hodnota}', ";
          }
        }
      }
      $sql .= "vloz_osoba='$user', vloz_datum='$datetime' WHERE ID='$ID'";

      if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function checkSql($conn) {
      $sql = '';
      $prvni = true;
      $data = get_object_vars($this);
      foreach ($data as $name => $value) {
        if ($value !== '') {
          if ($prvni === false) {
            $sql .= "AND {$name} = '{$value}' ";
          } else {
            $sql .= "WHERE {$name} = '{$value}' ";
            $prvni = false;
          }
        }
      }
      $sql = "SELECT p.*, v.stanice FROM psi p join vrh v on v.ID=p.vrh {$sql}";
      // echo $sql;
      $result = $conn->query($sql);
      if (!$result || $result->num_rows === 0) {
        $vysl['error'] = true;
        $vysl['errormsg'] = 'Tomuto zadání neodpovídá žádný vrh v databázi.';
      } elseif ($result->num_rows > 1) {
        $vysl['error'] = true;
        $vysl['errormsg'] = 'Tomuto zadání odpovídá více vrhů v databázi. Upřesněte údaje.';
      } else {
        while($row = $result->fetch_assoc()) {
          $vysl = json_encode($row);
        }
    }
    return $vysl;
  }

}

 ?>
