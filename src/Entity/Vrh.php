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
     * @var string
     *
     * @ORM\Column(name="otec_jmeno", type="string", length=50, nullable=false)
     */
    private $otecJmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="otec_chov", type="string", length=50, nullable=false)
     */
    private $otecChov;

    /**
     * @var string
     *
     * @ORM\Column(name="matka_jmeno", type="string", length=50, nullable=false)
     */
    private $matkaJmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="matka_chov", type="string", length=50, nullable=false)
     */
    private $matkaChov;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="narozeni", type="date", nullable=false)
     */
    private $narozeni;

    /**
     * @var string
     *
     * @ORM\Column(name="stanice", type="string", length=50, nullable=false)
     */
    private $stanice;

    /**
     * @var string
     *
     * @ORM\Column(name="chovatel_jmeno", type="string", length=80, nullable=false)
     */
    private $chovatelJmeno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vloz_datum", type="datetime", nullable=false)
     */
    private $vlozDatum;

    /**
     * @var string
     *
     * @ORM\Column(name="vloz_osoba", type="string", length=30, nullable=false)
     */
    private $vlozOsoba;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOtecJmeno(): ?string
    {
        return $this->otecJmeno;
    }

    public function setOtecJmeno(string $otecJmeno): self
    {
        $this->otecJmeno = $otecJmeno;

        return $this;
    }

    public function getOtecChov(): ?string
    {
        return $this->otecChov;
    }

    public function setOtecChov(string $otecChov): self
    {
        $this->otecChov = $otecChov;

        return $this;
    }

    public function getMatkaJmeno(): ?string
    {
        return $this->matkaJmeno;
    }

    public function setMatkaJmeno(string $matkaJmeno): self
    {
        $this->matkaJmeno = $matkaJmeno;

        return $this;
    }

    public function getMatkaChov(): ?string
    {
        return $this->matkaChov;
    }

    public function setMatkaChov(string $matkaChov): self
    {
        $this->matkaChov = $matkaChov;

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

    public function getStanice(): ?string
    {
        return $this->stanice;
    }

    public function setStanice(string $stanice): self
    {
        $this->stanice = $stanice;

        return $this;
    }

    public function getChovatelJmeno(): ?string
    {
        return $this->chovatelJmeno;
    }

    public function setChovatelJmeno(string $chovatelJmeno): self
    {
        $this->chovatelJmeno = $chovatelJmeno;

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

    public function getVlozOsoba(): ?string
    {
        return $this->vlozOsoba;
    }

    public function setVlozOsoba(string $vlozOsoba): self
    {
        $this->vlozOsoba = $vlozOsoba;

        return $this;
    }


}
