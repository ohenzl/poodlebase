<?php

namespace App\scripts;


class Edit
{

    public $name;
    public $ID;
    public $date;

    public function __construct($ID, $name, $date)
    {
        $this->name = $name;
        $this->ID = $ID;
        $this->date = $date;
    }

}


?>
