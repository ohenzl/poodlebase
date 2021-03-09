<?php

namespace App\scripts;

use App\scripts\Edit;

class AdminArea
{

    private $_user;
    private $_conn;

    public function __construct($conn, $user)
    {
        $this->_conn = $conn;
        $this->_user = $user;
    }

    public function getLastDogs()
    {
        $edits = [];
        $sql = "SELECT *, p.ID IDp, p.vloz_datum datum FROM psi p JOIN vrh v ON p.vrh=v.ID WHERE p.vloz_osoba = '$this->_user' ORDER BY p.vloz_datum DESC LIMIT 20";
        $result = $this->_conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $edits[] = new Edit($row['IDp'], $row['pes_jmeno'] . " " . $row['stanice'], $row['datum']);
            }
        }
        return $edits;
    }

}


?>
