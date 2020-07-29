<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceDonationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InvoiceDonationRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/donations/factures/lister"},
 *          "POST"={"path"="/donations/facture/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/donation/facture/{id}/afficher"}, 
 *          "PUT"={"path"="/donation/facture/{id}/modifier"},
 *          "DELETE"={"path"="/donation/facture/{id}/supprimer"}
 *          }
 * )
 */
class InvoiceDonation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="float")
     */
    private $total_amount;

    /**
     * @ORM\Column(type="float")
     */
    private $total_after_deduction;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="invoiceDonation")
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getTotalAmount(): ?float
    {
        return $this->total_amount;
    }

    public function setTotalAmount(float $total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    public function getTotalAfterDeduction(): ?float
    {
        return $this->total_after_deduction;
    }

    public function setTotalAfterDeduction(float $total_after_deduction): self
    {
        $this->total_after_deduction = $total_after_deduction;

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
            $address->setInvoiceDonation($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getInvoiceDonation() === $this) {
                $address->setInvoiceDonation(null);
            }
        }

        return $this;
    }
}
