<?php

namespace App\scripts\API\v1;

use App\scripts\PesDetail;

class Process
{

    private $conn;
    private $input;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    //create inputs for getAll
    public function createInputs($input)
    {
        $this->input = $input;
        $where = '';
        $types = '';
        $what = array();

        if (count($this->input->all()) !== []) {
            foreach ($this->input->all() as $key => $value) {
                if (!in_array($key, ['page', 'limit'])) {

                    //create WHERE if there for first and AND for more
                    if ($where === '') {
                        $where = 'WHERE ';
                    } else {
                        $where .=  ' AND ';
                    }

                    //add type for each variable
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
                        // return 'error @ switch';
                        break;
                    }

                    if ($key !== 'birthMin' && $key !== 'birthMax') {
                        $where .= ' LIKE ?';
                        $what[] = "%" . $value . "%";
                    } else {
                        $what[] = $value;
                    }
                }

            }
        }

        $in['what'] = $what;
        $in['where'] = $where;
        $in['types'] = $types;
        return $in;

    }

    //select all dogs with possible offset
    public function getAll($page = 1, $limit = 50, $in)
    {

        //get offset from page number
        $limit = is_int($limit) ? $limit : 50;
        $offset = is_int($page) ? (($page-1)*$limit) : 0;

        //get input types
        $what = array(...$in['what'], $limit, $offset);
        $where = $in['where'];
        $types = $in['types'] . 'ii';

        //select everything
        $sql = $this->conn->prepare("SELECT p.barva barva, p.srst srst, p.pohlavi pohlavi, p.pes_jmeno pes_jmeno, p.ID IDp, p.majitel majitel, v.chovatel_jmeno chovatel_jmeno, v.narozeni narozeni, v.stanice stanice, otec.pes_jmeno otec_jmeno, ovrh.stanice otec_stanice, matka.pes_jmeno matka_jmeno, mvrh.stanice matka_stanice FROM psi p LEFT JOIN vrh v on p.vrh=v.id LEFT JOIN psi otec ON v.otec_id=otec.ID LEFT JOIN vrh ovrh ON otec.vrh=ovrh.ID LEFT JOIN psi matka ON v.matka_id=matka.ID LEFT JOIN vrh mvrh ON matka.vrh=mvrh.ID {$where} ORDER BY p.pes_jmeno ASC LIMIT ? OFFSET ?");
        $sql->bind_param($types, ...$what);
        $sql->execute();
        $result = $sql->get_result();


        if ($result->num_rows > 0) {

            $output = array();
            $output['dogs'] = array();
            while($row = $result->fetch_assoc()) {

                //get dog from Database
                $dog_current = array(
                  'ID' => $row['IDp'],
                  'name' => $row['pes_jmeno'],
                  'kennel' => $row['stanice'],
                  'hair' => $row['srst'],
                  'color' => $row['barva'],
                  'sex' => strtolower($row['pohlavi']),
                  'birth' => $row['narozeni'],
                  'father_name' => $row['otec_jmeno'],
                  'father_kennel' => $row['otec_stanice'],
                  'mother_name' => $row['matka_jmeno'],
                  'mother_kennel' => $row['matka_stanice'],
                  'breeder' => $row['chovatel_jmeno'],
                  'owner' => $row['majitel']
                );

                //Add dogs to array
                array_push($output['dogs'], $dog_current);
            }

        } else {
            // $output['error'] = array($what, $where, $types);
            $output['error'] = 'No dogs were found.';
        }
        return $output;

    }


    //get dog by ID
    public function getOne($id)
    {

        $parents_next = array();
        $dog = new PesDetail;

        //dog information
        $dog->getAllInfo($this->conn, $id);

        //prepare empty array for each generation
        for ($i = 1; $i < 5; $i++) {
            $ancestors[$i] = [];
        }

        //create mother and father
        $ancestors[1] = array_merge($parents_next, $dog->createParents($this->conn));

        //gen = depth
        for ($gen = 2; $gen < 5; $gen++) {
            foreach ($ancestors[$gen-1] as $parent) {
                $ancestors[$gen] = array_merge($ancestors[$gen], $parent->createParents($this->conn));
            }
        }

        return $dog;

    }


    //full edit, including name changes and empty fields
    public function editDogFull($id)
    {

    }

    //partial edit, only filled fields
    public function editDogPart($id)
    {

    }


}

?>
