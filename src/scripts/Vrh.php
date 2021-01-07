<?php

namespace App\scripts;

  class Vrh {
    public $id;
    public $narozeni;
    public $otec_jmeno;
    public $otec_chov;
    public $otec_ID;
    public $matka_jmeno;
    public $matka_chov;
    public $matka_ID;
    public $stanice;
    public $chovatel_jmeno;
    public $chovatel_prijmeni;

    function __construct() {
      $this->id = '';
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
      $sql = "SELECT v.ID ID FROM vrh v LEFT JOIN psi p ON v.matka=p.ID WHERE p.jmeno = '$this->matka_jmeno' AND v.stanice = '$this->stanice' AND v.narozeni = '$this->narozeni'";
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
      $co = "VALUES ('$this->otec_ID', '$this->matka_ID', '$this->narozeni', '$this->stanice', '$this->chovatel_jmeno', '$user', '$datetime');";
      $kam = "INSERT INTO vrh (otec, matka, narozeni, stanice, chovatel, vloz_osoba, vloz_datum) ";
      $sql = $kam . $co;
      //zápis psa, získání ID rodiče
      if ($conn->query($sql) === TRUE) {
        $this->id = $conn->insert_id;
        return $conn->insert_id;  //získání ID
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function editVrh($ID, $user, $conn) {
      $datetime = date("Y-m-d H:i:s");
      $sql = "UPDATE vrh
      SET otec='$this->otec_ID', matka='$this->matka_ID', narozeni='$this->narozeni', stanice='$this->stanice', chovatel='$this->chovatel_jmeno', vloz_osoba='$user', vloz_datum='$datetime'
      WHERE ID='$ID'";

      if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

  }

?>
