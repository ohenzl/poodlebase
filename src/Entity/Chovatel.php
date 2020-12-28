<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chovatel
 *
 * @ORM\Table(name="chovatel")
 * @ORM\Entity
 */
class Chovatel
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
     * @ORM\Column(name="jmeno", type="string", length=50, nullable=false)
     */
    private $jmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="prijmeni", type="string", length=50, nullable=false)
     */
    private $prijmeni;

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=15, nullable=false)
     */
    private $telefon;

    /**
     * @var string
     *
     * @ORM\Column(name="adresa", type="string", length=160, nullable=false)
     */
    private $adresa;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=80, nullable=false)
     */
    private $web;

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
