<?php

namespace App\scripts;
use App\scripts\PesBase;

  class PesDetail extends Pes {

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
    public $otec_id;
    public $matka_id;

    function getAllInfo($conn, $ID) {
      $sql = "SELECT p.*, v.otec_id, v.matka_id, v.stanice, v.narozeni, v.chovatel_jmeno FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.ID = $ID";
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

      // $sql = "SELECT p.*, v.otec_jmeno, v.otec_chov, v.matka_jmeno, v.matka_chov, v.stanice, v.narozeni FROM psi p JOIN vrh v ON p.vrh=v.ID join psi otec on v.otec_id=otec.id";
      // if ($parent_sex === 'otec') {
      //    $sql .= " WHERE p.pes_jmeno = '$this->otec_jmeno' AND v.stanice = '$this->otec_chov'";
      // } else {
      //   $sql .= " WHERE p.pes_jmeno = '$this->matka_jmeno' AND v.stanice = '$this->matka_chov'";
      // }


      $sql = "SELECT p.*, v.otec_id, v.matka_id, v.stanice, v.narozeni FROM psi p JOIN vrh v ON p.vrh=v.ID";
      if ($parent_sex === 'otec') {
        $sql .= " WHERE p.id = '$this->otec_id'";
      } else {
        $sql .= " WHERE p.id = '$this->matka_id'";
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
          $parent->otec_id = $this->otec_id;
          // $parent->pes_jmeno = $this->otec_jmeno;
          // $parent->stanice = $this->otec_chov;
        } else {
          // $parent->pes_jmeno = $this->matka_jmeno;
          // $parent->stanice = $this->matka_chov;
        }
      }
      return $parent;
    }


    //printing and outputting

    function printInfo() {
      if ($this->ID !== null) {
        if ($this->vyska === "0.00") {
          $this->vyska = "--";
        } else {
          $this->vyska = number_format(round($this->vyska, 1), 1);
        }
        if ($this->barva === "") {
          $this->barva = "--";
        } else {
          $this->barva = strtolower($this->barva);
        }
        if ($this->patella_l === "" || $this->patella_r === "") {
          $this->patella = "--";
        } else {
          $this->patella = $this->patella_l . "/" . $this->patella_r;
        }
        return "<div class='display name'><a class='dogname' href='../../pes/{$this->ID}/" . str_replace(' ', '-', ($this->pes_jmeno . " " . $this->stanice)) . "'>{$this->pes_jmeno} {$this->stanice}</a></div>
        <div class='display height'>{$this->vyska}</div>
        <div class='display color'>{$this->barva}</div>
        <div class='display patella'>$this->patella</div>";
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
