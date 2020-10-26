<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubCategoriesRepository")
 */
class SubCategories
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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="subCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubCategoriesProduct", mappedBy="subCategorie", orphanRemoval=true)
     */
    private $subCategoriesProducts;

    public function __construct()
    {
        $this->subCategoriesProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|SubCategoriesProduct[]
     */
    public function getSubCategoriesProducts(): Collection
    {
        return $this->subCategoriesProducts;
    }

    public function addSubCategoriesProduct(SubCategoriesProduct $subCategoriesProduct): self
    {
        if (!$this->subCategoriesProducts->contains($subCategoriesProduct)) {
            $this->subCategoriesProducts[] = $subCategoriesProduct;
            $subCategoriesProduct->setSubCategorie($this);
        }

        return $this;
    }

    public function removeSubCategoriesProduct(SubCategoriesProduct $subCategoriesProduct): self
    {
        if ($this->subCategoriesProducts->contains($subCategoriesProduct)) {
            $this->subCategoriesProducts->removeElement($subCategoriesProduct);
            // set the owning side to null (unless already changed)
            if ($subCategoriesProduct->getSubCategorie() === $this) {
                $subCategoriesProduct->setSubCategorie(null);
            }
        }

        return $this;
    }
}
