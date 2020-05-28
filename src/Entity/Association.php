<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRepository")
 * @ApiResource
 */
class Association
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $cgu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dataUsageAgreement;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $associationType;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $assemblyConstituveDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $foundedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCgu()
    {
        return $this->cgu;
    }

    public function setCgu($cgu): self
    {
        $this->cgu = $cgu;

        return $this;
    }

    public function getDataUsageAgreement(): ?bool
    {
        return $this->dataUsageAgreement;
    }

    public function setDataUsageAgreement(?bool $dataUsageAgreement): self
    {
        $this->dataUsageAgreement = $dataUsageAgreement;

        return $this;
    }

    public function getAssociationType(): ?string
    {
        return $this->associationType;
    }

    public function setAssociationType(string $associationType): self
    {
        $this->associationType = $associationType;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAssemblyConstituveDate(): ?\DateTimeInterface
    {
        return $this->assemblyConstituveDate;
    }

    public function setAssemblyConstituveDate(\DateTimeInterface $assemblyConstituveDate): self
    {
        $this->assemblyConstituveDate = $assemblyConstituveDate;

        return $this;
    }

    public function getFoundedAt(): ?\DateTimeInterface
    {
        return $this->foundedAt;
    }

    public function setFoundedAt(?\DateTimeInterface $foundedAt): self
    {
        $this->foundedAt = $foundedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
