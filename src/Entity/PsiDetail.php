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
     * @ORM\Column(name="výška", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $v��ka;

    /**
     * @var string
     *
     * @ORM\Column(name="přezdívka", type="string", length=50, nullable=false)
     */
    private $p�ezd�vka;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getV��ka(): ?string
    {
        return $this->v��ka;
    }

    public function setV��ka(string $v��ka): self
    {
        $this->v��ka = $v��ka;

        return $this;
    }

    public function getP�ezd�vka(): ?string
    {
        return $this->p�ezd�vka;
    }

    public function setP�ezd�vka(string $p�ezd�vka): self
    {
        $this->p�ezd�vka = $p�ezd�vka;

        return $this;
    }

    public function getMajitel(): ?int
    {
        return $this->majitel;
    }

    public function setMajitel(int $majitel): self
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
