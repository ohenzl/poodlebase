<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gen
 *
 * @ORM\Table(name="gen")
 * @ORM\Entity
 */
class Gen
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
     * @ORM\Column(name="patella", type="string", length=5, nullable=false)
     */
    private $patella;

    /**
     * @var string
     *
     * @ORM\Column(name="oci", type="string", length=5, nullable=false)
     */
    private $oci;

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

    public function getPatella(): ?string
    {
        return $this->patella;
    }

    public function setPatella(string $patella): self
    {
        $this->patella = $patella;

        return $this;
    }

    public function getOci(): ?string
    {
        return $this->oci;
    }

    public function setOci(string $oci): self
    {
        $this->oci = $oci;

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
