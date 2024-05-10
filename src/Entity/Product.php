<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hsfcCode = null;

    #[ORM\ManyToOne]
    private ?Refcompany $company = null;
    private $companyId;

    #[ORM\ManyToOne]
    private ?QuantityType $Quantitytype = null;
    private $quantitytypeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getHsfcCode(): ?string
    {
        return $this->hsfcCode;
    }

    public function setHsfcCode(?string $hsfcCode): static
    {
        $this->hsfcCode = $hsfcCode;

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

    public function getQuantitytype(): ?QuantityType
    {
        return $this->Quantitytype;
    }

    public function setQuantitytype(?QuantityType $Quantitytype): static
    {
        $this->Quantitytype = $Quantitytype;

        return $this;
    }
    public function getQuantityId(): ?string
    {
        return $this->quantitytypeId;
    }
    public function setQuantityId(?string $quantitytypeId): static
    {
        $this->quantitytypeId = $quantitytypeId;
        return $this;
    }
}
