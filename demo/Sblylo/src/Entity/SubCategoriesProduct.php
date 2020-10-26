<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubCategoriesProductRepository")
 */
class SubCategoriesProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategories", inversedBy="subCategoriesProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="subCategoriesProduct", orphanRemoval=true)
     */
    private $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubCategorie(): ?SubCategories
    {
        return $this->subCategorie;
    }

    public function setSubCategorie(?SubCategories $subCategorie): self
    {
        $this->subCategorie = $subCategorie;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setSubCategoriesProduct($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSubCategoriesProduct() === $this) {
                $product->setSubCategoriesProduct(null);
            }
        }

        return $this;
    }
}
