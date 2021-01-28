<?php

namespace App\scripts;
use App\scripts\PesBase;

  class PesDetail extends PesBase {

    function __construct() {

    }

    public $otec_jmeno;
    public $otec_chov;
    public $matka_jmeno;
    public $matka_chov;
    public $otec;
    public $matka;

    function getAllInfo($conn, $ID) {
      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.ID = $ID";
      // echo $sql;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          foreach ($row as $key => $value) {
            $this->$key = $value;
          }
        }
      }
    }

    function createParents($conn) {
      $this->otec = $this->createParent($conn, 'otec');
      $this->matka = $this->createParent($conn, 'matka');

      $parents[] = $this->otec;
      $parents[] = $this->matka;
      return $parents;
    }

    function createParent($conn, $parent) {

      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov FROM psi p JOIN vrh v ON p.vrh=v.ID";
      if ($parent === 'otec') {
         $sql .= " WHERE p.pes_jmeno = '$this->otec_jmeno' AND v.stanice = '$this->otec_chov'";
      } else {
        $sql .= " WHERE p.pes_jmeno = '$this->matka_jmeno' AND v.stanice = '$this->matka_chov'";
      }

      // echo $sql . "<br>";

      $result = $conn->query($sql);
      $parent = new PesDetail;
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          foreach ($row as $key => $value) {
            $parent->$key = $value;
          }
        }
      }
      return $parent;
    }

    function printInfo() {
      // return "<div>{$this->pes_jmeno}</div>";
      return $this->pes_jmeno;
    }


}

 ?>
