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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVã½å¡ka(): ?string
    {
        return $this->vã½å¡ka;
    }

    public function setVã½å¡ka(string $vã½å¡ka): self
    {
        $this->vã½å¡ka = $vã½å¡ka;

        return $this;
    }

    public function getPå™ezdã­vka(): ?string
    {
        return $this->på™ezdã­vka;
    }

    public function setPå™ezdã­vka(string $på™ezdã­vka): self
    {
        $this->på™ezdã­vka = $på™ezdã­vka;

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
