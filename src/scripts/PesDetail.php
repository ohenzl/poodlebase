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
    public $stanice;
    public $narozeni;

    function getAllInfo($conn, $ID) {
      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov, v.stanice, v.narozeni FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.ID = $ID";
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

    function createParent($conn, $parent_sex) {

      $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov, v.stanice, v.narozeni FROM psi p JOIN vrh v ON p.vrh=v.ID";
      if ($parent_sex === 'otec') {
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
      } else {
        if ($parent_sex === 'otec') {
          $parent->pes_jmeno = $this->otec_jmeno;
          $parent->stanice = $this->otec_chov;
        } else {
          $parent->pes_jmeno = $this->matka_jmeno;
          $parent->stanice = $this->matka_chov;
        }
      }
      return $parent;
    }

    function printInfo() {
      if ($this->ID !== null) {
        return "<div><a href='../../pes/{$this->ID}/" . str_replace(' ', '-', ($this->pes_jmeno . " " . $this->stanice)) . "'>{$this->pes_jmeno} {$this->stanice}</a></div>";
      } else {
        return "<div>{$this->pes_jmeno} {$this->stanice}</div>";
      }
    }

    function getJmeno() {
      if($this->prezdivka) {
        return $this->pes_jmeno . " '{$this->prezdivka}' " . $this->stanice;
      } else {
        return $this->pes_jmeno . " " . $this->stanice;
      }
    }

    function getColor() {
      return $this->barva;
    }

    function getHair() {
      return $this->srst;
    }

    function getSex() {
      return $this->pohlavi;
    }

    function getBirthday() {
      return $this->narozeni;
    }

}

 ?>
