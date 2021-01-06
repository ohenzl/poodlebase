<?php

namespace App\scripts;

  class Pes {
    public $id;
    public $pes_jmeno;
    public $pohlavi;
    public $barva;
    public $srst;
    public $CMKU_pref;
    public $CMKU;
    public $cip;
    public $vrh;

    function __construct() {
      $this->id = '';
      $this->pes_jmeno = '';
      $this->pohlavi = '';
      $this->barva = '';
      $this->srst = '';
      $this->CMKU_pref = '';
      $this->CMKU = '';
      $this->cip = '';
      $this->vrh = '';
    }

    function addOrEdit($conn, $user, $vrh) {
      $sql = "SELECT * FROM vrh v JOIN psi p ON p.vrh=v.ID WHERE p.jmeno = '$this->pes_jmeno' AND v.stanice = '$vrh->stanice'";
      // echo $sql . "<br>";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $this->edit($row['ID']);
        }
      } else {
        return $this->add($conn, $user, $vrh);
      }
    }

    function add($conn, $user, $vrh) {
      $datetime = date("Y-m-d H:i:s");
      $co = "VALUES ('$this->pes_jmeno', '$this->pohlavi', '$this->barva', '$this->srst', '$vrh->id', '$this->CMKU_pref', '$this->CMKU', '$this->cip', '$user', '$datetime');";
      $kam = "INSERT INTO psi (jmeno, pohlavi, barva, srst, vrh, cmku_pref, cmku, cip, vloz_osoba, vloz_datum) ";
      $sql = $kam . $co;
      //zápis psa, získání ID rodiče
      if ($conn->query($sql) === TRUE) {
        // return $conn->insert_id;  //získání ID
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function edit($ID) {
      // nutné udělat editaci
    }
  }

 ?>
