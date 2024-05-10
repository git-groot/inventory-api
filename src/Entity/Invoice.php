<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;
    private $productid;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Amount = null;

    #[ORM\ManyToOne]
    private ?Orders $Orders = null;
    private $orderid;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProductid(): ?string
    {
        return $this->productid;
    }

    public function setProductid(?string $productid): static
    {
        $this->productid = $productid;

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

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(?string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(?string $Amount): static
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->Orders;
    }

    public function setOrders(?Orders $Orders): static
    {
        $this->Orders = $Orders;

        return $this;
    }
    public function getOrdersid(): ?string
    {
        return $this->orderid;
    }

    public function setOrdersid(?string $orderid): static
    {
        $this->orderid = $orderid;

        return $this;
    }
}
