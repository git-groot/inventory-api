<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Customer $Customer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $orderdate = null;

    #[ORM\Column(length: 255)]
    private ?string $totalAmout = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $Customer): static
    {
        $this->Customer = $Customer;

        return $this;
    }

    public function getOrderdate(): ?string
    {
        return $this->orderdate;
    }

    public function setOrderdate(?string $orderdate): static
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    public function getTotalAmout(): ?string
    {
        return $this->totalAmout;
    }

    public function setTotalAmout(string $totalAmout): static
    {
        $this->totalAmout = $totalAmout;

        return $this;
    }
}
