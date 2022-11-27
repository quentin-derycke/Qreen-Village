<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parent')]
    private ?self $childs = null;

    #[ORM\OneToMany(mappedBy: 'childs', targetEntity: self::class)]
    private Collection $parent;

    #[ORM\OneToMany(mappedBy: 'categoryId', targetEntity: Product::class)]
    private Collection $category;

    public function __construct()
    {
        $this->parent = new ArrayCollection();
        $this->category = new ArrayCollection();
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
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Product $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setCategoryId($this);
        }

        return $this;
    }

    public function removeCategory(Product $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategoryId() === $this) {
                $category->setCategoryId(null);
            }
        }

        return $this;
    }
}
