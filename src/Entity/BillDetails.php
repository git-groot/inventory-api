<?php

namespace App\Entity;

use App\Repository\BillDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillDetailsRepository::class)]
class BillDetails
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
    private $customerId;
    private $billId;

    #[ORM\ManyToOne]
    private ?Bills $Bill = null;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $Customer): static
    {
        $this->Customer = $Customer;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
    public function setCustomerId(?string $customerId): static
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getBill(): ?Bills
    {
        return $this->Bill;
    }

    public function setBill(?Bills $Bill): static
    {
        $this->Bill = $Bill;

        return $this;
    }
    public function getBillId(): ?string
    {
        return $this->billId;
    }
    public function setBillId(?string $billId): static
    {
        $this->billId = $billId;
        return $this;
    }
}
