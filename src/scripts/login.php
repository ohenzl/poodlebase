<?php


// namespace src\scripts;
  class Person {
    public $name;
    public $password;
  }

  function checkLoginInformation($name, $password) {

    require 'data.php';

    $sql = "SELECT pes_jmeno FROM psi WHERE pes_cislo = '8901'";

    $result = $conn->query($sql);
    $pocet_psovodu = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo $row['pes_jmeno'];
      }
    }


    $person = new Person;
    $person->name = $_POST["name"];
    $person->password = $_POST["password"];

    return $person;
  }

 ?>
