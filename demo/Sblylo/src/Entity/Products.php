<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historic", mappedBy="product")
     */
    private $historics;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategoriesProduct", inversedBy="product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategoriesProduct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="product", orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieSpecs", mappedBy="product", orphanRemoval=true)
     */
    private $categorieSpecs;

    public function __construct()
    {
        $this->historics = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->categorieSpecs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Historic[]
     */
    public function getHistorics(): Collection
    {
        return $this->historics;
    }

    public function addHistoric(Historic $historic): self
    {
        if (!$this->historics->contains($historic)) {
            $this->historics[] = $historic;
            $historic->setProduct($this);
        }

        return $this;
    }

    public function removeHistoric(Historic $historic): self
    {
        if ($this->historics->contains($historic)) {
            $this->historics->removeElement($historic);
            // set the owning side to null (unless already changed)
            if ($historic->getProduct() === $this) {
                $historic->setProduct(null);
            }
        }

        return $this;
    }

    public function getSubCategoriesProduct(): ?SubCategoriesProduct
    {
        return $this->subCategoriesProduct;
    }

    public function setSubCategoriesProduct(?SubCategoriesProduct $subCategoriesProduct): self
    {
        $this->subCategoriesProduct = $subCategoriesProduct;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieSpecs[]
     */
    public function getCategorieSpecs(): Collection
    {
        return $this->categorieSpecs;
    }

    public function addCategorieSpec(CategorieSpecs $categorieSpec): self
    {
        if (!$this->categorieSpecs->contains($categorieSpec)) {
            $this->categorieSpecs[] = $categorieSpec;
            $categorieSpec->setProduct($this);
        }

        return $this;
    }

    public function removeCategorieSpec(CategorieSpecs $categorieSpec): self
    {
        if ($this->categorieSpecs->contains($categorieSpec)) {
            $this->categorieSpecs->removeElement($categorieSpec);
            // set the owning side to null (unless already changed)
            if ($categorieSpec->getProduct() === $this) {
                $categorieSpec->setProduct(null);
            }
        }

        return $this;
    }
}
