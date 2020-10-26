<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieSpecsRepository")
 */
class CategorieSpecs
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="categorieSpecs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Specs", mappedBy="categorieSpecs", orphanRemoval=true)
     */
    private $specs;

    public function __construct()
    {
        $this->specs = new ArrayCollection();
    }

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

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection|Specs[]
     */
    public function getSpecs(): Collection
    {
        return $this->specs;
    }

    public function addSpec(Specs $spec): self
    {
        if (!$this->specs->contains($spec)) {
            $this->specs[] = $spec;
            $spec->setCategorieSpecs($this);
        }

        return $this;
    }

    public function removeSpec(Specs $spec): self
    {
        if ($this->specs->contains($spec)) {
            $this->specs->removeElement($spec);
            // set the owning side to null (unless already changed)
            if ($spec->getCategorieSpecs() === $this) {
                $spec->setCategorieSpecs(null);
            }
        }

        return $this;
    }
}
