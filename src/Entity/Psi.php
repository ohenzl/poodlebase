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
     * @ORM\Column(name="pes_jmeno", type="string", length=60, nullable=false)
     */
    private $pesJmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="pohlavi", type="string", length=10, nullable=false)
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Vrh")
     * @ORM\JoinColumn(name="vrh", referencedColumnName="ID")
     */
    private $vrh;

    /**
     * @var string
     *
     * @ORM\Column(name="cmku_pref", type="string", length=30, nullable=false)
     */
    private $cmkuPref;

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
     * @var int
     *
     * @ORM\Column(name="vyska", type="integer", nullable=false)
     */
    private $vyska;

    /**
     * @var string
     *
     * @ORM\Column(name="prezdivka", type="string", length=50, nullable=false)
     */
    private $prezdivka;

    /**
     * @var string
     *
     * @ORM\Column(name="majitel", type="string", length=50, nullable=false)
     */
    private $majitel;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=false)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="patella_l", type="string", length=2, nullable=false)
     */
    private $patellaL;

    /**
     * @var string
     *
     * @ORM\Column(name="patella_r", type="string", length=2, nullable=false)
     */
    private $patellaR;

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

    public function getPesJmeno(): ?string
    {
        return $this->pesJmeno;
    }

    public function setPesJmeno(string $pesJmeno): self
    {
        $this->pesJmeno = $pesJmeno;

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


    public function getJoinedVrh(): ?object
    {
        return $this->vrh;
    }


    public function getJoinedFather(): ?object
    {
        return $this->vrh->getFather();
    }


    public function setVrh(int $vrh): self
    {
        $this->vrh = $vrh;

        return $this;
    }

    public function getCmkuPref(): ?string
    {
        return $this->cmkuPref;
    }

    public function setCmkuPref(string $cmkuPref): self
    {
        $this->cmkuPref = $cmkuPref;

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

    public function getVyska(): ?int
    {
        return $this->vyska;
    }

    public function setVyska(int $vyska): self
    {
        $this->vyska = $vyska;

        return $this;
    }

    public function getPrezdivka(): ?string
    {
        return $this->prezdivka;
    }

    public function setPrezdivka(string $prezdivka): self
    {
        $this->prezdivka = $prezdivka;

        return $this;
    }

    public function getMajitel(): ?string
    {
        return $this->majitel;
    }

    public function setMajitel(string $majitel): self
    {
        $this->majitel = $majitel;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(string $web): self
    {
        $this->web = $web;

        return $this;
    }

    public function getPatellaL(): ?string
    {
        return $this->patellaL;
    }

    public function setPatellaL(string $patellaL): self
    {
        $this->patellaL = $patellaL;

        return $this;
    }

    public function getPatellaR(): ?string
    {
        return $this->patellaR;
    }

    public function setPatellaR(string $patellaR): self
    {
        $this->patellaR = $patellaR;

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
