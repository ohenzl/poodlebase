<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PsiDetail
 *
 * @ORM\Table(name="psi_detail")
 * @ORM\Entity
 */
class PsiDetail
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
     * @ORM\Column(name="vÃ½Å¡ka", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $vã½å¡ka;

    /**
     * @var string
     *
     * @ORM\Column(name="pÅ™ezdÃ­vka", type="string", length=50, nullable=false)
     */
    private $på™ezdã­vka;

    /**
     * @var int
     *
     * @ORM\Column(name="majitel", type="integer", nullable=false)
     */
    private $majitel;

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
