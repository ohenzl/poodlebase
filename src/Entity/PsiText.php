<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PsiText
 *
 * @ORM\Table(name="psi_text")
 * @ORM\Entity
 */
class PsiText
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
     * @ORM\Column(name="poznamky", type="text", length=65535, nullable=false)
     */
    private $poznamky;

    /**
     * @var string
     *
     * @ORM\Column(name="vysledky", type="text", length=65535, nullable=false)
     */
    private $vysledky;

    /**
     * @var string
     *
     * @ORM\Column(name="charakteristika", type="text", length=65535, nullable=false)
     */
    private $charakteristika;

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
