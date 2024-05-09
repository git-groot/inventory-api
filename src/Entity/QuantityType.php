<?php

namespace App\Entity;

use App\Repository\QuantityTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuantityTypeRepository::class)]
class QuantityType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantityName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meserment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $units = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;

    #[ORM\ManyToOne]
    private ?Refcompany $company = null;
    private $companyId;
    private $productId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantityName(): ?string
    {
        return $this->quantityName;
    }

    public function setQuantityName(?string $quantityName): static
    {
        $this->quantityName = $quantityName;

        return $this;
    }

    public function getMeserment(): ?string
    {
        return $this->meserment;
    }

    public function setMeserment(?string $meserment): static
    {
        $this->meserment = $meserment;

        return $this;
    }

    public function getUnits(): ?string
    {
        return $this->units;
    }

    public function setUnits(?string $units): static
    {
        $this->units = $units;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
    public function getProductId(): ?string
    {
        return $this->productId;
    }
    public function setProductId(?string $productId): static
    {
        $this->productId = $productId;
        return $this;
    }

    public function getCompany(): ?Refcompany
    {
        return $this->company;
    }

    public function setCompany(?Refcompany $company): static
    {
        $this->company = $company;

        return $this;
    }
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    public function setCompanyId(?string $companyId): static
    {
        $this->companyId = $companyId;
        return $this;
    }
}
