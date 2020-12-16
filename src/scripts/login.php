<?php


// namespace src\scripts;
  class Person {
    public $name;
    public $password;
  }

  function checkLoginInformation($name, $password, $session) {

    $person = new Person;
    $person->name = $name;
    $person->password = $password;

    $date = date("Y-m-d H:i:s");
    require 'data.php';
    $datum = strtotime('now') ;
    $datum_past = date("Y-m-d H:i:s", strtotime("-10 minutes", $datum));
    $ip = $_SERVER["REMOTE_ADDR"];


    $sql = "SELECT count(login) FROM login WHERE datum > '$datum_past' AND IP = '$ip'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pocet_prihlaseni = $row['count(login)'];
      }
    }

    if ($pocet_prihlaseni < 5) {
      $sql = "SELECT jmeno FROM users WHERE username = '$person->name' and heslo = '$person->password'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $session->set('name', $row['jmeno']);
            $session->set('logged', true);
        }
      } else {
        $sql = "INSERT INTO login (IP, datum, login) VALUES ('$ip', '$date', '$person->name')";
        $result = $conn->query($sql);
        $session->set('logged', false);
        die;
      }
      $conn->close();
    } else {
      echo "překročen počet přihlášení";
    }
  }

 ?>
