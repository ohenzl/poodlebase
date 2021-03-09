<?php

namespace App\scripts;

class PesBase
{
    public $ID;
    public $pes_jmeno;
    public $pohlavi;
    public $barva;
    public $srst;
    public $cmku_pref;
    public $cmku;
    public $cip;
    public $vrh;
    public $stanice;
    public $prezdivka;
    public $vyska;
    public $majitel;
    public $web;
    public $patella_l;
    public $patella_r;

    function __construct()
    {
        $this->ID = '';
        $this->pes_jmeno = '';
        $this->pohlavi = '';
        $this->barva = '';
        $this->srst = '';
        $this->cmku_pref = '';
        $this->cmku = '';
        $this->cip = '';
        $this->vrh = '';
        $this->stanice = '';
        $this->prezdivka = '';
        $this->vyska = '';
        $this->majitel = '';
        $this->web = '';
        $this->patella_l = '';
        $this->patella_r = '';
    }

    function exists($conn)
    {
        //změna ze exists($conn, stanice) a $cele_jmeno = $this->pes_jmeno . ' ' . $stanice;
        $cele_jmeno = $this->pes_jmeno . ' ' . $this->stanice;

        $sql = "SELECT * FROM vrh v JOIN psi p ON p.vrh=v.ID HAVING concat(p.pes_jmeno, ' ', v.stanice) = ?";

        $prep = $conn->prepare($sql);
        $prep->bind_param("s", $cele_jmeno);
        $prep->execute();
        $result = $prep->get_result();

        // $user = $result->fetch_assoc();
        //
        // $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getID($conn, $stanice)
    {
        $cele_jmeno = $this->pes_jmeno . ' ' . $stanice;
        $sql = "SELECT *, p.ID ID FROM vrh v JOIN psi p ON p.vrh=v.ID HAVING concat(p.pes_jmeno, ' ', v.stanice) = '$cele_jmeno'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // echo $row['ID'];
                return $row['ID'];
            }
        } else {
            // echo $sql;
            return false;
        }
    }

}

?>
