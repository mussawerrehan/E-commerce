<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecsRepository")
 */
class Specs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieSpecs", inversedBy="specs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieSpecs;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCategorieSpecs(): ?CategorieSpecs
    {
        return $this->categorieSpecs;
    }

    public function setCategorieSpecs(?CategorieSpecs $categorieSpecs): self
    {
        $this->categorieSpecs = $categorieSpecs;

        return $this;
    }
}
