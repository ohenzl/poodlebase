<?php

namespace App\scripts;
use App\scripts\PesBase;

class Pes extends PesBase
{

    function addOrEdit($conn, $user, $vrh)
    {
        $cele_jmeno = $this->pes_jmeno . ' ' . $vrh->stanice;
        $sql = "SELECT *, p.ID IDp FROM vrh v JOIN psi p ON p.vrh=v.ID HAVING concat(p.pes_jmeno, ' ', v.stanice) = '$cele_jmeno'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->vrh = $vrh->ID;
                $this->edit($row['IDp'], $user, $conn);
            }
        } else {
            return $this->add($conn, $user, $vrh);
        }
    }

    function add($conn, $user, $vrh)
    {
        $datetime = date("Y-m-d H:i:s");
        $co = "VALUES ('$this->pes_jmeno', '$this->pohlavi', '$this->barva', '$this->srst', '$vrh->ID', '$this->cmku_pref', '$this->cmku', '$this->cip', '$user', '$datetime');";
        $kam = "INSERT INTO psi (pes_jmeno, pohlavi, barva, srst, vrh, cmku_pref, cmku, cip, vloz_osoba, vloz_datum) ";
        $sql = $kam . $co;
        //zápis psa, získání ID rodiče
        if ($conn->query($sql) === true) {
            return $conn->insert_id;  //získání ID
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function edit($ID, $user, $conn)
    {
        $datetime = date("Y-m-d H:i:s");
        $objects = get_object_vars($this);
        $sql = "UPDATE psi SET ";
        foreach ($objects as $nazev => $hodnota) {
            if ($nazev !== 'ID' && $nazev !== 'stanice') {
                if ($hodnota !== '') {
                    $sql .= "{$nazev} = '{$hodnota}', ";
                }
            }
        }
        $sql .= "vloz_osoba='$user', vloz_datum='$datetime' WHERE ID='$ID'";
        if ($conn->query($sql) === true) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function fullEdit($ID, $user, $conn)
    {
        $datetime = date("Y-m-d H:i:s");
        $objects = get_object_vars($this);
        $sql = "UPDATE psi SET ";
        foreach ($objects as $nazev => $hodnota) {
            if ($nazev !== 'ID' && $nazev !== 'stanice') {
                $sql .= "{$nazev} = '{$hodnota}', ";
            }
        }
        $sql .= "vloz_osoba='$user', vloz_datum='$datetime' WHERE ID='$ID'";
        if ($conn->query($sql) === true) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function checkSql($conn)
    {
        $sql = '';
        $prvni = true;
        $data = get_object_vars($this);
        foreach ($data as $name => $value) {
            if ($value !== '' && $name !== 'cmku_pref') {
                if ($name !== 'stanice') {
                    $prefix = 'p';
                } else {
                    $prefix = 'v';
                }

                if ($prvni === false) {
                    $sql .= "AND {$prefix}.{$name} = '{$value}' ";
                } else {
                    $sql .= "WHERE {$prefix}.{$name} = '{$value}' ";
                    $prvni = false;
                }
            }
        }
        $sql = "SELECT p.*, v.stanice FROM psi p join vrh v on v.ID=p.vrh {$sql}";
        $result = $conn->query($sql);
        if (!$result || $result->num_rows === 0) {
            $vysl['error'] = true;
            $vysl['errormsg'] = 'Tomuto zadání neodpovídá žádný vrh v databázi.';
        } elseif ($result->num_rows > 1) {
            $vysl['error'] = true;
            $vysl['errormsg'] = 'Tomuto zadání odpovídá více vrhů v databázi. Upřesněte údaje.';
        } else {
            while($row = $result->fetch_assoc()) {
                $vysl = json_encode($row);
            }
        }
        return $vysl;
    }

}

?>
