<?php

namespace App\scripts;
use App\scripts\Pes;
use App\scripts\PesDetail;
use App\scripts\Vrh;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FormToSQL //objekt z formulářů
{

    function parsePostVrh($input)
    {
        $vrh = new Vrh;
        foreach($input['vrh'] as $key => $value) {
            $vrh->$key = trim($value);
        }
        return $vrh;
    }


    function parsePostPes($input)
    {
        foreach($input['pes'] as $number => $dog) {
            $pes[$number] = new Pes;
            foreach($dog as $nazev => $data) {
                $pes[$number]->$nazev = trim($data);
            }
        }
        return $pes;
    }


    function parsePostPedigree($input)
    {
        foreach($input['gen'] as $generation => $dogs) {
            foreach($dogs as $number => $data) {
                $pes[$generation][$number] = new PesDetail;
                $pes[$generation][$number]->pes_jmeno = $data['jmeno'];
                $pes[$generation][$number]->stanice = $data['stanice'];
                $pes[$generation][$number]->pohlavi = $data['pohlavi'];
            }
        }

        $pedigree = new PesDetail;
        $this->createParentFromPedigree($pes, 1);
        $pedigree->otec = $pes[1][0];
        $pedigree->matka = $pes[1][1];

        return $pedigree;
    }

    //vytvoření rodokmenu
    function createParentFromPedigree($pes, $generation)
    {
        foreach ($pes[$generation] as $number => $pes_current) {
            $pes_current->otec = $pes[$generation+1][$number*2];
            $pes_current->matka = $pes[$generation+1][($number*2)+1];
            if ($generation < 3) {
                $this-> createParentFromPedigree($pes, ($generation+1));
            }
        }
    }

    //zápis rodokmenu do databáze
    function pedigreeIntoDatabase($pes, $conn, $user)
    {

        if ($pes->otec !== null) {
            if ($pes->otec->pes_jmeno !== '') {
                $pes->otec_id = $this->pedigreeIntoDatabase($pes->otec, $conn, $user);
            }
        }
        if ($pes->matka !== null) {
            if ($pes->matka->pes_jmeno !== '') {
                $pes->matka_id = $this->pedigreeIntoDatabase($pes->matka, $conn, $user);
            }
        }

        //pokud pes neexistuje, vytvořit, jinak získat ID pro zápis rodiče do vrhu
        if (!$pes->exists($conn) && $pes->pes_jmeno !== null) {
            $vrh = new Vrh;
            $datetime = date("Y-m-d H:i:s");
            $kam = "INSERT INTO vrh (otec_id, matka_id, stanice, vloz_osoba, vloz_datum) ";
            $co = "VALUES ('$pes->otec_id', '$pes->matka_id', '$pes->stanice', '$user', '$datetime');";
            $sql = $kam . $co;
            if ($conn->query($sql) === true) {
                $this->ID = $conn->insert_id;
                $id = $pes->add($conn, $user, $this);  //získání ID
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            return $id;
        } else {
            return $pes->getID($conn, $pes->stanice);
        }
    }

}


?>
