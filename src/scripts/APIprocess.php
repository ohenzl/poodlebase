<?php

namespace App\scripts\API;

use App\scripts\API\Dog;

class Process
{


    public $input;
    public $output;
    public $conn;


    function __construct($conn, $input = '')
    {
        $this->input = $input;
        $this->conn = $conn;
    }

    function build()
    {
        $where = '';
        $types = '';
        $what = [];
        if ($this->input->all() !== []) {
            foreach ($this->input->all() as $key => $value) {
                if ($where === '') {
                    $where = 'WHERE ';
                } else {
                    $where .=  ' AND ';
                }

                $types .= 's';

                switch ($key) {
                case "name":
                    $where .= "concat(p.pes_jmeno, ' ', v.stanice)";
                    break;
                case "name_strict":
                    $where .= "p.pes_jmeno";
                    break;
                case "kennel":
                      $where .= "v.stanice";
                    break;
                case "color":
                    $where .= "p.barva";
                    break;
                case "sex":
                    $where .= "p.pohlavi";
                    break;
                case "breeder":
                    $where .= "v.chovatel_jmeno";
                    break;
                case "owner":
                    $where .= "p.majitel";
                    break;
                case "father":
                    $where .= "concat(otec.pes_jmeno, ' ', ovrh.stanice)";
                    break;
                case "mother":
                    $where .= "concat(matka.pes_jmeno, ' ', mvrh.stanice)";
                    break;
                case "birthMin":
                    $where .= "v.narozeni > ?";
                    break;
                case "birthMax":
                    $where .= "v.narozeni < ?";
                    break;
                default:
                    return 'error @ switch';
                }
                if ($key !== 'birthMin' && $key !== 'birthMax') {
                    $where .= ' LIKE ?';
                    $what[] = "%" . $value . "%";
                } else {
                    $what[] = $value;
                }
            }
        }

        $sql = $this->conn->prepare("SELECT p.barva barva, p.srst srst, p.pohlavi pohlavi, p.pes_jmeno pes_jmeno, p.ID IDp, p.majitel majitel, v.chovatel_jmeno chovatel_jmeno, v.narozeni narozeni, v.stanice stanice, otec.pes_jmeno otec_jmeno, ovrh.stanice otec_stanice, matka.pes_jmeno matka_jmeno, mvrh.stanice matka_stanice FROM psi p LEFT JOIN vrh v on p.vrh=v.id LEFT JOIN psi otec ON v.otec_id=otec.ID LEFT JOIN vrh ovrh ON otec.vrh=ovrh.ID LEFT JOIN psi matka ON v.matka_id=matka.ID LEFT JOIN vrh mvrh ON matka.vrh=mvrh.ID {$where} ORDER BY p.pes_jmeno DESC");
        if ($what !== []) {
            $sql->bind_param($types, ...$what);
        }

        $sql->execute();

        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row['IDp'];
                $dog[$id] = new Dog;

                $dog[$id]->ID = $id;
                $dog[$id]->name = $row['pes_jmeno'];
                $dog[$id]->kennel = $row['stanice'];
                $dog[$id]->hair = $row['srst'];
                $dog[$id]->color = $row['barva'];
                $dog[$id]->sex = strtolower($row['pohlavi']);
                $dog[$id]->birth = $row['narozeni'];
                $dog[$id]->father_name = $row['otec_jmeno'];
                $dog[$id]->father_kennel = $row['otec_stanice'];
                $dog[$id]->mother_name = $row['matka_jmeno'];
                $dog[$id]->mother_kennel = $row['matka_stanice'];
                $dog[$id]->breeder = $row['chovatel_jmeno'];
                $dog[$id]->owner = $row['majitel'];

            }
        } else {
            return false;
        }

        return $dog;
    }

}


?>
