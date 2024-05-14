<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BuyingPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SelinPrice = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;

    #[ORM\ManyToOne]
    private ?Refcompany $company = null;
    private $productid;
    private $Quantitysid;
    private $companyId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(?string $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getBuyingPrice(): ?string
    {
        return $this->BuyingPrice;
    }

    public function setBuyingPrice(?string $BuyingPrice): static
    {
        $this->BuyingPrice = $BuyingPrice;

        return $this;
    }

    public function getSelinPrice(): ?string
    {
        return $this->SelinPrice;
    }

    public function setSelinPrice(?string $SelinPrice): static
    {
        $this->SelinPrice = $SelinPrice;

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
        return $this->productid;
    }
    public function setProductId(?string $productid): static
    {
        $this->productid = $productid;
        return $this;
    }

    public function getQuantitysId(): ?string
    {
        return $this->Quantitysid;
    }
    public function setQuantitysId(?string $Quantitysid): static
    {
        $this->Quantitysid = $Quantitysid;
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
