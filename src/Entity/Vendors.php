<?php

namespace App\Entity;

use App\Repository\VendorsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendorsRepository::class)]
class Vendors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PhoneNo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $State = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $District = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PinCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GSTnumber = null;

    #[ORM\ManyToOne]
    private ?Refcompany $company = null;

    private $companyId;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): static
    {
        $this->Email = $Email;

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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(?string $State): static
    {
        $this->State = $State;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->District;
    }

    public function setDistrict(?string $District): static
    {
        $this->District = $District;

        return $this;
    }

    public function getPinCode(): ?string
    {
        return $this->PinCode;
    }

    public function setPinCode(?string $PinCode): static
    {
        $this->PinCode = $PinCode;

        return $this;
    }

    public function getGSTnumber(): ?string
    {
        return $this->GSTnumber;
    }

    public function setGSTnumber(?string $GSTnumber): static
    {
        $this->GSTnumber = $GSTnumber;

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
