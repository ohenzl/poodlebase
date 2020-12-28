<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chovatel
 *
 * @ORM\Table(name="chovatel")
 * @ORM\Entity
 */
class Chovatel
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
     * @ORM\Column(name="jmeno", type="string", length=50, nullable=false)
     */
    private $jmeno;

    /**
     * @var string
     *
     * @ORM\Column(name="prijmeni", type="string", length=50, nullable=false)
     */
    private $prijmeni;

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=15, nullable=false)
     */
    private $telefon;

    /**
     * @var string
     *
     * @ORM\Column(name="adresa", type="string", length=160, nullable=false)
     */
    private $adresa;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

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

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): self
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    public function setAdresa(string $adresa): self
    {
        $this->adresa = $adresa;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
