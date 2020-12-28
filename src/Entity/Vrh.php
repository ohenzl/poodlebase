<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vrh
 *
 * @ORM\Table(name="vrh")
 * @ORM\Entity
 */
class Vrh
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
     * @var int
     *
     * @ORM\Column(name="otec", type="integer", nullable=false)
     */
    private $otec;

    /**
     * @var int
     *
     * @ORM\Column(name="matka", type="integer", nullable=false)
     */
    private $matka;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="narozeni", type="date", nullable=false)
     */
    private $narozeni;

    /**
     * @var int
     *
     * @ORM\Column(name="stanice", type="integer", nullable=false)
     */
    private $stanice;

    /**
     * @var int
     *
     * @ORM\Column(name="chovatel", type="integer", nullable=false)
     */
    private $chovatel;

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
