<?php

namespace App\Entity;

use App\Repository\BillsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillsRepository::class)]
class Bills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Product $Product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TotalPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $buyPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Profit = null;

    #[ORM\ManyToOne]
    private ?Inventory $Inventory = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    private $inventoryId;
    private $productId;

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(?string $Quantity): static
    {
        $this->Quantity = $Quantity;

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

    public function getTotalPrice(): ?string
    {
        return $this->TotalPrice;
    }

    public function setTotalPrice(?string $TotalPrice): static
    {
        $this->TotalPrice = $TotalPrice;

        return $this;
    }

    public function getBuyPrice(): ?string
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(?string $buyPrice): static
    {
        $this->buyPrice = $buyPrice;

        return $this;
    }

    public function getProfit(): ?string
    {
        return $this->Profit;
    }

    public function setProfit(?string $Profit): static
    {
        $this->Profit = $Profit;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->Inventory;
    }

    public function setInventory(?Inventory $Inventory): static
    {
        $this->Inventory = $Inventory;

        return $this;
    }
    public function getInventoryId(): ?string
    {
        return $this->inventoryId;
    }
    public function setInventoryId(?string $inventoryId): static
    {
        $this->inventoryId = $inventoryId;
        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): static
    {
        $this->Product = $Product;

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

}
