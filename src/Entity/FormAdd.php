<?php

namespace App\Entity;

// use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * FormAdd
 *
 * @ORM\Table(name="form_add")
 * @ORM\Entity
 */
class FormAdd
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ID;

    /**
     * @var string
     *
     * @ORM\Column(name="nadrazeny", type="string", length=30, nullable=false)
     */
    private $nadrazeny;

    /**
     * @var string
     *
     * @ORM\Column(name="subnadpis", type="string", length=30, nullable=false)
     */
    private $subnadpis;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=30, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="required", type="string", length=11, nullable=false)
     */
    private $required;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=30, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="typ", type="string", length=10, nullable=false)
     */
    private $typ;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=50, nullable=false)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="ucel", type="integer", length=11, nullable=false)
     */
    private $ucel;

    public function getId(): ?int
    {
        return $this->ID;
    }

    public function getNadrazeny(): ?string
    {
        return $this->nadrazeny;
    }

    public function setNadrazeny(string $nadrazeny): self
    {
        $this->nadrazeny = $nadrazeny;

        return $this;
    }

    public function getSubnadpis(): ?string
    {
        return $this->subnadpis;
    }

    public function setSubnadpis(string $subnadpis): self
    {
        $this->subnadpis = $subnadpis;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getRequired(): ?string
    {
        return $this->required;
    }

    public function setRequired(string $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getUcel(): ?string
    {
        return $this->ucel;
    }

    public function setUcel(string $ucel): self
    {
        $this->ucel = $ucel;

        return $this;
    }


}
