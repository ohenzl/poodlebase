<?php

namespace Script\FormCreator;

class Form {
  public $nadrazeny;
  public $subnadpis;
  public $name;
  public $label;
  public $required;

  function __construct($nadrazeny, $subnadpis, $name, $label, $required) {
    $this->nadrazeny=$nadrazeny;
    $this->subnadpis=$subnadpis;
    $this->name=$name;
    $this->label=$label;
    $this->required=$required;
  }
}

echo "AHOY";
// require_once('../src/scripts/data.php');

$sql = "SELECT * FROM form_add";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $pocet_prihlaseni = $row['name'];
    }
  }


 ?>
