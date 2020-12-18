<?php


// namespace src\scripts;
  class Person {
    public $name;
    public $password;
  }

  function failedLogin() {

  }

  function checkLoginInformation($name, $password, $session) {

    $person = new Person;
    $person->name = $name;
    $person->password = $password;

    $error = 0;
    $date = date("Y-m-d H:i:s");
    require 'data.php';
    $datum = strtotime('now') ;
    $datum_past = date("Y-m-d H:i:s", strtotime("-10 minutes", $datum));
    $ip = $_SERVER["REMOTE_ADDR"];


    //kontrola počtu přihlášení
    $sql = "SELECT count(login) FROM login WHERE datum > '$datum_past' AND IP = '$ip' AND SUCCESS = '0'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pocet_prihlaseni = $row['count(login)'];
      }
    }

    //logika přihlášení
    if ($pocet_prihlaseni < 5) {
      $sql = "SELECT jmeno, heslo, level FROM users WHERE username = '$person->name'";
      $result = $conn->query($sql);
      // echo var_dump($result);
      // echo "number of rows: " . $result->num_rows;
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          if (password_verify($person->password, $row['heslo'])) {
            $session->set('name', $row['jmeno']);
            $session->set('level', $row['level']);
            $session->set('logged', true);
          } else {
            $session->set('logged', false);
            $error = 1;
            break;
          }
        }
      } else {
        $session->set('logged', false);
        $error = 1;
      }
      //zápis přihlášení do databáze
      $success = $session->get('logged');
      $sql = "INSERT INTO login (IP, datum, login, success) VALUES ('$ip', '$date', '$person->name', '$success')";
      $result = $conn->query($sql);
      $conn->close();
    } else {
      $error = 2;
    }
    return $error;
  }

 ?>
