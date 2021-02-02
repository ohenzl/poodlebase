<?php

namespace App\scripts;

  class PesBase {
    public $ID;
    public $pes_jmeno;
    public $pohlavi;
    public $barva;
    public $srst;
    public $cmku_pref;
    public $cmku;
    public $cip;
    public $vrh;
    public $stanice;
    public $prezdivka;
    public $vyska;
    public $majitel;
    public $web;
    public $patella_l;
    public $patella_r;

    function __construct() {
      $this->ID = '';
      $this->pes_jmeno = '';
      $this->pohlavi = '';
      $this->barva = '';
      $this->srst = '';
      $this->cmku_pref = '';
      $this->cmku = '';
      $this->cip = '';
      $this->vrh = '';
      $this->stanice = '';
      $this->prezdivka = '';
      $this->vyska = '';
      $this->majitel = '';
      $this->web = '';
      $this->patella_l = '';
      $this->patella_r = '';
    }

    function exists($conn, $stanice)  {
      $sql = "SELECT p.ID ID FROM vrh v JOIN psi p ON p.vrh=v.ID WHERE p.pes_jmeno = '$this->pes_jmeno' AND v.stanice = '$stanice'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        return true;
      } else {
        return false;
      }
    }

  }

 ?>
