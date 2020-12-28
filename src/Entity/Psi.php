<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Psi
 *
 * @ORM\Table(name="psi")
 * @ORM\Entity
 */
class Psi
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
     * @ORM\Column(name="jmeno", type="string", length=60, nullable=false)
     */
    private $jmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="pohlavi", type="string", length=2, nullable=false)
     */
    private $pohlavi;

    /**
     * @var string
     *
     * @ORM\Column(name="barva", type="string", length=50, nullable=false)
     */
    private $barva;

    /**
     * @var string
     *
     * @ORM\Column(name="srst", type="string", length=20, nullable=false)
     */
    private $srst;

    /**
     * @var int
     *
     * @ORM\Column(name="vrh", type="integer", nullable=false)
     */
    private $vrh;

    /**
     * @var string
     *
     * @ORM\Column(name="cmku", type="string", length=20, nullable=false)
     */
    private $cmku;

    /**
     * @var int
     *
     * @ORM\Column(name="cip", type="integer", nullable=false)
     */
    private $cip;

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
