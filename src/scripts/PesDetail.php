<?php

namespace App\scripts;
use App\scripts\PesBase;

  class PesDetail extends PesBase {

    private $otec_jmeno;
    private $otec_chov;
    private $otec_ID;
    private $matka_jmeno;
    private $matka_chov;
    private $matka_ID;

    function getAllInfo($conn, $ID) {
      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.ID = $ID";
      echo $sql;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          foreach ($row as $key => $value) {
            $this->$key = $value;
          }
        }
      }
    }

    function createParent($conn, $parent) {
      
      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov FROM psi p JOIN vrh v ON p.vrh=v.ID";
      if ($parent === 'otec') {
         $sql .= " WHERE p.pes_jmeno = '$this->otec_jmeno' AND v.stanice = '$this->otec_chov'";
      } else {
        $sql .= " WHERE p.pes_jmeno = '$this->matka_jmeno' AND v.stanice = '$this->matka_chov'";
      }

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

}

 ?>
