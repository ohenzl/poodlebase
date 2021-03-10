<?php

namespace App\scripts\API\v1;

class Process
{

  public function getAll($page = 0) {

    //get offset

    $offset = $page*50;

    //select everything
    $sql = $this->conn->prepare("SELECT p.barva barva, p.srst srst, p.pohlavi pohlavi, p.pes_jmeno pes_jmeno, p.ID IDp, p.majitel majitel, v.chovatel_jmeno chovatel_jmeno, v.narozeni narozeni, v.stanice stanice, otec.pes_jmeno otec_jmeno, ovrh.stanice otec_stanice, matka.pes_jmeno matka_jmeno, mvrh.stanice matka_stanice FROM psi p LEFT JOIN vrh v on p.vrh=v.id LEFT JOIN psi otec ON v.otec_id=otec.ID LEFT JOIN vrh ovrh ON otec.vrh=ovrh.ID LEFT JOIN psi matka ON v.matka_id=matka.ID LEFT JOIN vrh mvrh ON matka.vrh=mvrh.ID ORDER BY p.pes_jmeno DESC LIMIT 10 OFFSET {$offset}");
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        }
    }

  }

}

?>
