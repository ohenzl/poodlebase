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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOtec(): ?int
    {
        return $this->otec;
    }

    public function setOtec(int $otec): self
    {
        $this->otec = $otec;

        return $this;
    }

    public function getMatka(): ?int
    {
        return $this->matka;
    }

    public function setMatka(int $matka): self
    {
        $this->matka = $matka;

        return $this;
    }

    public function getNarozeni(): ?\DateTimeInterface
    {
        return $this->narozeni;
    }

    public function setNarozeni(\DateTimeInterface $narozeni): self
    {
        $this->narozeni = $narozeni;

        return $this;
    }

    public function getStanice(): ?int
    {
        return $this->stanice;
    }

    public function setStanice(int $stanice): self
    {
        $this->stanice = $stanice;

        return $this;
    }

    public function getChovatel(): ?int
    {
        return $this->chovatel;
    }

    public function setChovatel(int $chovatel): self
    {
        $this->chovatel = $chovatel;

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
