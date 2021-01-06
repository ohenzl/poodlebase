<?php

namespace App\scripts;

  class Pes {
    public $id;
    public $pes_jmeno;
    public $pohlavi;
    public $barva;
    public $srst;
    public $CMKU;
    public $cip;
    public $vrh;

    function __construct() {
      $this->id = '';
      $this->pes_jmeno = '';
      $this->pohlavi = '';
      $this->barva = '';
      $this->srst = '';
      $this->CMKU = '';
      $this->cip = '';
      $this->vrh = '';
    }

    function writePesToSQL() {
      if ($this->pes_jmeno !== '') {
        $co = "VALUES ('$pes_jmeno', '$pohlavi', '$barva', '$srst', '$CMKU', '$cip', '$vrh');";
        $kam = "INSERT INTO psi (jmeno, pohlavi, barva, srst, cmku, cip, vrh) ";
        $sql_zapis = $kam . $co;
        return $sql_zapis;
      }
    }
  }

 ?>
