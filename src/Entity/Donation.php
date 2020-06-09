<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DonationRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @ORM\Column(type="decimal", precision=10, scale=4)
     * @Groups({
     *      "donation_read", 
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
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
     * @ORM\Column(type="decimal", precision=10, scale=4)
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

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
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

    public function getTaxDeductionPercentage(): ?string
    {
        return $this->taxDeductionPercentage;
    }

    public function setTaxDeductionPercentage(string $taxDeductionPercentage): self
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
