<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AddressRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/adresses/lister"},
 *          "POST"={"path"="/adresses/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/adresse/{id}/afficher"}, 
 *          "PUT"={"path"="/adresse/{id}/modifier"},
 *          "DELETE"={"path"="/adresse/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "api_users_addresses_get_subresource"={
 *          "normalization_context"={"groups"={"addresses_subresource"}}
 *          },
 *          "api_associations_addresses_get_subresource"={
 *          "normalization_context"={"groups"={"associations_addresses_subresource"}}
 *          }   
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "address_read"
 *          }
 *      },
 * )
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $addressLine1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $addressLine2;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({
     *      "address_read", 
     *      "association_read", 
     *      "donation_read", 
     *      "association_profile_read", 
     *      "staff_read", 
     *      "user_read",
     *      "addresses_subresource",
     *      "associations_addresses_subresource"
     * })
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="yes")
     * @Groups({
     *      "address_read"
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="addresses")
     * @Groups({
     *      "address_read"
     * })
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=InvoiceShop::class, inversedBy="addresses")
     * @Groups({"
     *      address_read"
     * })
     */
    private $invoiceShop;

    /**
     * @ORM\ManyToOne(targetEntity=InvoiceDonation::class, inversedBy="addresses")
     * @Groups({
     *      "address_read"
     * })
     */
    private $invoiceDonation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerAddres(){
        if (empty($this->user))
            return $this->association->getName();
        else
            return $this->user->getFullName();
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

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getInvoiceShop(): ?InvoiceShop
    {
        return $this->invoiceShop;
    }

    public function setInvoiceShop(?InvoiceShop $invoiceShop): self
    {
        $this->invoiceShop = $invoiceShop;

        return $this;
    }

    public function getInvoiceDonation(): ?InvoiceDonation
    {
        return $this->invoiceDonation;
    }

    public function setInvoiceDonation(?InvoiceDonation $invoiceDonation): self
    {
        $this->invoiceDonation = $invoiceDonation;

        return $this;
    }
}
