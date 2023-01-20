<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 10)]
    #[Groups(["user:read", "order:read"])]
    private ?string $houseNumber = null;

   
    #[ORM\Column(length: 50)]
    #[Groups(["user:read", "order:read"])]
    private ?string $street = null;

  
    #[ORM\Column(length: 50)]
    #[Groups(["user:read", "order:read"])]
    private ?string $city = null;

    
    #[ORM\Column(length: 50)]
    #[Groups(["user:read", "order:read"])]
    private ?string $zipcode = null;

    
    #[ORM\ManyToOne(inversedBy: 'addresses')]
    #[Groups(["user:read", "order:read"])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
