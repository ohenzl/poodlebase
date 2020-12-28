<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gen
 *
 * @ORM\Table(name="gen")
 * @ORM\Entity
 */
class Gen
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="patella", type="string", length=5, nullable=false)
     */
    private $patella;

    /**
     * @var string
     *
     * @ORM\Column(name="oci", type="string", length=5, nullable=false)
     */
    private $oci;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vloz_datum", type="date", nullable=false)
     */
    private $vlozDatum;

    /**
     * @var int
     *
     * @ORM\Column(name="vloz_osoba", type="integer", nullable=false)
     */
    private $vlozOsoba;


}
