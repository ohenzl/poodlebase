<?php

namespace App\scripts;

  class Vrh {
    public $ID;
    public $narozeni;
    public $otec_jmeno;
    public $otec_chov;
    public $otec_id;
    public $matka_jmeno;
    public $matka_chov;
    public $matka_id;
    public $stanice;
    public $chovatel_jmeno;
    public $chovatel_prijmeni;

    function __construct() {
      $this->ID = '';
      $this->narozeni = '';
      $this->otec_jmeno = '';
      $this->otec_chov = '';
      $this->matka_jmeno = '';
      $this->matka_chov = '';
      $this->stanice = '';
      $this->chovatel_jmeno = '';
      $this->chovatel_prijmeni = '';
    }

    function addOrEdit($conn, $user) {
      $sql = "SELECT v.ID FROM vrh v JOIN psi p ON v.ID=p.vrh WHERE matka_id = '$this->matka_id' AND narozeni = '$this->narozeni'";
      // echo $sql;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $this->editVrh($row['ID'], $user, $conn);
          return $row['ID'];
        }
      } else {
        return $this->addVrh($conn, $user);
      }
    }

    function addVrh($conn, $user) {
      $datetime = date("Y-m-d H:i:s");
      $co = "VALUES ('$this->otec_id', '$this->matka_id', '$this->narozeni', '$this->stanice', '$this->chovatel_jmeno', '$user', '$datetime');";
      $kam = "INSERT INTO vrh (otec_id, matka_id, narozeni, stanice, chovatel_jmeno, vloz_osoba, vloz_datum) ";
      $sql = $kam . $co;
      //zápis psa, získání ID rodiče
      if ($conn->query($sql) === TRUE) {
        $this->ID = $conn->insert_id;
        return $conn->insert_id;  //získání ID
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function editVrh($ID, $user, $conn) {
      $datetime = date("Y-m-d H:i:s");
      $sql = "UPDATE vrh
      SET otec_jmeno='$this->otec_jmeno', otec_chov='$this->otec_chov', matka_jmeno='$this->matka_jmeno', matka_chov='$this->matka_chov', narozeni='$this->narozeni', stanice='$this->stanice', chovatel_jmeno='$this->chovatel_jmeno', vloz_osoba='$user', vloz_datum='$datetime'
      WHERE ID='$ID'";
      // echo $sql;

      if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function checkVrh($conn) {
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
      $sql = "SELECT * FROM vrh {$sql}";

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
