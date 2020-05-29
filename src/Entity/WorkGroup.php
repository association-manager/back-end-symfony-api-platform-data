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
     * @ORM\ManyToOne(targetEntity=MemberTaskGroupRelation::class, inversedBy="workGroups")
     */
    private $memberTaskGroupRelation;

    public function __construct()
    {
        $this->associationId = new ArrayCollection();
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

    public function getMemberTaskGroupRelation(): ?MemberTaskGroupRelation
    {
        return $this->memberTaskGroupRelation;
    }

    public function setMemberTaskGroupRelation(?MemberTaskGroupRelation $memberTaskGroupRelation): self
    {
        $this->memberTaskGroupRelation = $memberTaskGroupRelation;

        return $this;
    }
}
