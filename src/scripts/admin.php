<?php

namespace App\scripts;

use App\scripts\Edit;


class AdminArea {

  private $user;
  private $conn;

  public function __construct($conn, $user) {
    $this->conn = $conn;
    $this->user = $user;
  }

  public function getLastDogs() {
    $sql = "SELECT * FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.vloz_osoba = '$this->user' ORDER BY p.vloz_datum LIMIT 20";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $edits[] = new Edit($row['ID'], $row['pes_jmeno'] . " " . $row['stanice'], $row['vloz_datum']);
      }
    }
    return $edits;
  }

}


 ?>
