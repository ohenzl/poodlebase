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
    private $id;

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


}
