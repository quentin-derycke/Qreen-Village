<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['product:read']],
)]
#[ApiFilter(SearchFilter::class, properties: [  'name' => 'partial', 'category' => 'exact'])]

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    #[Groups(["product:read"])]
    private ?int $id = null;

    #[Groups(["product:read"])]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[Groups(["product:read"])]
    #[ORM\Column(nullable: true)]
    private ?int $supplierId = null;

    #[Groups(["product:read"])]
    #[ORM\Column(length: 150, nullable: true)]
    private ?string $description = null;

    #[Groups(["product:read", "order:read"])]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[Groups(["product:read"])]
    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2, nullable: true)]
    private ?string $discount = null;

    #[Groups(["product:read"])]
    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    #[Groups(["product:read"])]
    #[ORM\Column(length: 50)]
    private ?string $reference = null;

    #[Groups(["product:read", "order:read"])]
    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $categoryId = null;

    #[Groups(["product:read"])]
    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'products')]
    private Collection $image;

    #[Groups(["product:read", 'suppliers:read', "order:read"])]
    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Suppliers $supplier = null;



    public function __construct()
    {
        $this->image = new ArrayCollection();
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

    public function getSupplierId(): ?int
    {
        return $this->supplierId;
    }

    public function setSupplierId(?int $supplierId): self
    {
        $this->supplierId = $supplierId;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->categoryId;
    }

    public function setCategoryId(?Category $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        $this->image->removeElement($image);

        return $this;
    }

    public function getSupplier(): ?Suppliers
    {
        return $this->supplier;
    }

    public function setSupplier(?Suppliers $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
