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

  }

?>
