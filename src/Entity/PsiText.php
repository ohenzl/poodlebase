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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoznamky(): ?string
    {
        return $this->poznamky;
    }

    public function setPoznamky(string $poznamky): self
    {
        $this->poznamky = $poznamky;

        return $this;
    }

    public function getVysledky(): ?string
    {
        return $this->vysledky;
    }

    public function setVysledky(string $vysledky): self
    {
        $this->vysledky = $vysledky;

        return $this;
    }

    public function getCharakteristika(): ?string
    {
        return $this->charakteristika;
    }

    public function setCharakteristika(string $charakteristika): self
    {
        $this->charakteristika = $charakteristika;

        return $this;
    }

    public function getVlozDatum(): ?\DateTimeInterface
    {
        return $this->vlozDatum;
    }

    public function setVlozDatum(\DateTimeInterface $vlozDatum): self
    {
        $this->vlozDatum = $vlozDatum;

        return $this;
    }

    public function getVlozOsoba(): ?int
    {
        return $this->vlozOsoba;
    }

    public function setVlozOsoba(int $vlozOsoba): self
    {
        $this->vlozOsoba = $vlozOsoba;

        return $this;
    }


}
