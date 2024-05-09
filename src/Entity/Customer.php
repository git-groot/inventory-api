<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customerName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PhoneNo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuantityType $Quantity = null;
    private $quantityId;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): static
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function getPhoneNo(): ?string
    {
        return $this->PhoneNo;
    }

    public function setPhoneNo(?string $PhoneNo): static
    {
        $this->PhoneNo = $PhoneNo;

        return $this;
    }

    public function getQuantity(): ?QuantityType
    {
        return $this->Quantity;
    }

    public function setQuantity(?QuantityType $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }
    public function getQuantityId(): ?string
    {
        return $this->quantityId;
    }
    public function setQuantityId(?string $quantityId): static
    {
        $this->quantityId = $quantityId;
        return $this;
    }
}
