<?php

namespace App\Entity;

use App\Repository\WorkGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkGroupRepository::class)
 * @ORM\Table(name="`work_group`")
 */
class WorkGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=association::class, inversedBy="groups")
     */
    private $associationId;

    /**
     * @ORM\ManyToMany(targetEntity=Member::class, mappedBy="workGroups")
     */
    private $members;

    public function __construct()
    {
        $this->associationId = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

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

    /**
     * @return Collection|association[]
     */
    public function getAssociationId(): Collection
    {
        return $this->associationId;
    }

    public function addAssociationId(association $associationId): self
    {
        if (!$this->associationId->contains($associationId)) {
            $this->associationId[] = $associationId;
        }

        return $this;
    }

    public function removeAssociationId(association $associationId): self
    {
        if ($this->associationId->contains($associationId)) {
            $this->associationId->removeElement($associationId);
        }

        return $this;
    }

    /**
     * @return Collection|Member[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->addWorkGroup($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            $member->removeWorkGroup($this);
        }

        return $this;
    }
}
