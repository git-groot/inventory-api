<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
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
    private ?string $phoneNo = null;

    #[ORM\ManyToOne]
    private ?Refcompany $Company = null;
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
        return $this->phoneNo;
    }

    public function setPhoneNo(?string $phoneNo): static
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    public function getCompany(): ?Refcompany
    {
        return $this->Company;
    }

    public function setCompany(?Refcompany $Company): static
    {
        $this->Company = $Company;

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
