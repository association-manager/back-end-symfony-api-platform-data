<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InvoiceShopRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InvoiceShopRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/boutique/factures/lister"},
 *          "POST"={"path"="/boutique/facture/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/boutique/facture/{id}/afficher"}, 
 *          "PUT"={"path"="/boutique/facture/{id}/modifier"},
 *          "DELETE"={"path"="/boutique/facture/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "invoice_shop_read"
 *          }
 *      }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class InvoiceShop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"invoice_shop_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"invoice_shop_read"}, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoice_shop_read"})
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoice_shop_read"})
     */
    private $vat;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="invoiceShop")
     * @Groups({"invoice_shop_read"})
     */
    private $addresses;

    /**
     * @ORM\Column(type="json")
     */
    private $data = [];

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * Automatically assign the current date
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function prePersist() {
        if(empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setInvoiceShop($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getInvoiceShop() === $this) {
                $address->setInvoiceShop(null);
            }
        }

        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}
