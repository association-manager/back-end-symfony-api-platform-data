<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DonationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=DonationRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/donations/lister"},
 *          "POST"={"path"="/donations/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/donation/{id}/afficher"}, 
 *          "PUT"={"path"="/donation/{id}/modifier"},
 *          "DELETE"={"path"="/donation/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "donation_read"
 *          }
 *      }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Donation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="float", precision=10, scale=4)
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     * @Assert\Regex(
     *      pattern="/^(\d{1,6}.\d{4})$/",
     *      match=false,
     *      message="la valeur ne respecte pas le type *.0000" 
     * )
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     */
    private $mensuality;

    /**
     * @ORM\Column(type="float", precision=10, scale=4)
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     */
    private $taxDeductionPercentage;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "associations_members_subresource"
     * })
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="donations")
     * @Groups({
     *      "donation_read"
     * })
     */
    private $member;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getMensuality(): ?int
    {
        return $this->mensuality;
    }

    public function setMensuality(int $mensuality): self
    {
        $this->mensuality = $mensuality;

        return $this;
    }

    public function getTaxDeductionPercentage(): ?float
    {
        return $this->taxDeductionPercentage;
    }

    public function setTaxDeductionPercentage(float $taxDeductionPercentage): self
    {
        $this->taxDeductionPercentage = $taxDeductionPercentage;

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

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }
}
