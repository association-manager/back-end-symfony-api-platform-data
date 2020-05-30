<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 * @ApiResource
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressLine1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressLine2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="yes")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=association::class, inversedBy="addresses")
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=invoiceShop::class, inversedBy="addresses")
     */
    private $invoiceShop;

    /**
     * @ORM\ManyToOne(targetEntity=invoiceDonation::class, inversedBy="addresses")
     */
    private $invoiceDonation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(?string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(?string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAssociation(): ?association
    {
        return $this->association;
    }

    public function setAssociation(?association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getInvoiceShop(): ?invoiceShop
    {
        return $this->invoiceShop;
    }

    public function setInvoiceShop(?invoiceShop $invoiceShop): self
    {
        $this->invoiceShop = $invoiceShop;

        return $this;
    }

    public function getInvoiceDonation(): ?invoiceDonation
    {
        return $this->invoiceDonation;
    }

    public function setInvoiceDonation(?invoiceDonation $invoiceDonation): self
    {
        $this->invoiceDonation = $invoiceDonation;

        return $this;
    }
}
