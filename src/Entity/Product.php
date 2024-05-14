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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mesarment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Units = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $buyingPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gst = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cgst = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sgst = null;


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

   

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(?string $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getMesarment(): ?string
    {
        return $this->Mesarment;
    }

    public function setMesarment(?string $Mesarment): static
    {
        $this->Mesarment = $Mesarment;

        return $this;
    }

    public function getUnits(): ?string
    {
        return $this->Units;
    }

    public function setUnits(?string $Units): static
    {
        $this->Units = $Units;

        return $this;
    }

    public function getBuyingPrice(): ?string
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(?string $buyingPrice): static
    {
        $this->buyingPrice = $buyingPrice;

        return $this;
    }

    public function getGst(): ?string
    {
        return $this->gst;
    }

    public function setGst(?string $gst): static
    {
        $this->gst = $gst;

        return $this;
    }

    public function getCgst(): ?string
    {
        return $this->cgst;
    }

    public function setCgst(?string $cgst): static
    {
        $this->cgst = $cgst;

        return $this;
    }

    public function getSgst(): ?string
    {
        return $this->sgst;
    }

    public function setSgst(?string $sgst): static
    {
        $this->sgst = $sgst;

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
