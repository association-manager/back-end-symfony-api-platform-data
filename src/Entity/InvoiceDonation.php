<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceDonationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=InvoiceDonationRepository::class)
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
}
