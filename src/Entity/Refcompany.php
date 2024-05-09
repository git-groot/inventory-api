<?php

namespace App\Entity;

use App\Repository\RefcompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RefcompanyRepository::class)]
class Refcompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CompanyName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PhoneNo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $State = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $District = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PinCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Logo = null;

    // /**
    //  * @var Collection<int, QuantityType>
    //  */
    // #[ORM\OneToMany(targetEntity: QuantityType::class, mappedBy: 'company')]
    // private Collection $quantityTypes;

    // public function __construct()
    // {
    //     $this->quantityTypes = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(?string $CompanyName): static
    {
        $this->CompanyName = $CompanyName;

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

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(?string $Password): static
    {
        $this->Password = $Password;

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

    // /**
    //  * @return Collection<int, QuantityType>
    //  */
    // public function getQuantityTypes(): Collection
    // {
    //     return $this->quantityTypes;
    // }

    // public function addQuantityType(QuantityType $quantityType): static
    // {
    //     if (!$this->quantityTypes->contains($quantityType)) {
    //         $this->quantityTypes->add($quantityType);
    //         $quantityType->setCompany($this);
    //     }

    //     return $this;
    // }

    // public function removeQuantityType(QuantityType $quantityType): static
    // {
    //     if ($this->quantityTypes->removeElement($quantityType)) {
    //         // set the owning side to null (unless already changed)
    //         if ($quantityType->getCompany() === $this) {
    //             $quantityType->setCompany(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getLogo(): ?string
    {
        return $this->Logo;
    }

    public function setLogo(?string $Logo): static
    {
        $this->Logo = $Logo;

        return $this;
    }
}
