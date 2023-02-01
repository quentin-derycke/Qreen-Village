<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: [ "groups" => ["category"]]
)]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[Groups(["product:read",'category'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["product:read", 'category'])]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[Groups(["category"])]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parent')]
    private ?self $childs = null;

    #[Groups(["product:read", 'category'])]
    #[ORM\OneToMany(mappedBy: 'childs', targetEntity: self::class)]
    private Collection $parent;

    #[Groups(["product:read", 'category'])]
    #[ORM\OneToMany(mappedBy: 'categoryId', targetEntity: Product::class)]
    private Collection $products;

    #[Groups("category")]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $Image = null;

    #[Groups("category")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;


    public function __construct()
    {
        $this->parent = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    public function getChilds(): ?self
    {
        return $this->childs;
    }

    public function setChilds(?self $childs): self
    {
        $this->childs = $childs;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(self $parent): self
    {
        if (!$this->parent->contains($parent)) {
            $this->parent->add($parent);
            $parent->setChilds($this);
        }

        return $this;
    }

    public function removeParent(self $parent): self
    {
        if ($this->parent->removeElement($parent)) {
            // set the owning side to null (unless already changed)
            if ($parent->getChilds() === $this) {
                $parent->setChilds(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategoryId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategoryId() === $this) {
                $product->setCategoryId(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->Image;
    }

    public function setImage(?Image $Image): self
    {
        $this->Image = $Image;

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
}
