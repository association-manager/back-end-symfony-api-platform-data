<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DonationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DonationRepository::class)
 */
class Donation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4)
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mensuality;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4)
     */
    private $taxDeductionPercentage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="donations")
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
