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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getPohlavi(): ?string
    {
        return $this->pohlavi;
    }

    public function setPohlavi(string $pohlavi): self
    {
        $this->pohlavi = $pohlavi;

        return $this;
    }

    public function getBarva(): ?string
    {
        return $this->barva;
    }

    public function setBarva(string $barva): self
    {
        $this->barva = $barva;

        return $this;
    }

    public function getSrst(): ?string
    {
        return $this->srst;
    }

    public function setSrst(string $srst): self
    {
        $this->srst = $srst;

        return $this;
    }

    public function getVrh(): ?int
    {
        return $this->vrh;
    }

    public function setVrh(int $vrh): self
    {
        $this->vrh = $vrh;

        return $this;
    }

    public function getCmku(): ?string
    {
        return $this->cmku;
    }

    public function setCmku(string $cmku): self
    {
        $this->cmku = $cmku;

        return $this;
    }

    public function getCip(): ?int
    {
        return $this->cip;
    }

    public function setCip(int $cip): self
    {
        $this->cip = $cip;

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
