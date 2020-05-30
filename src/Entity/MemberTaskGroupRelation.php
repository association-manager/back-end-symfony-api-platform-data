<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MemberTaskGroupRelationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberTaskGroupRelationRepository::class)
 * @ApiResource
 */
class MemberTaskGroupRelation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Member::class, mappedBy="memberTaskGroupRelation")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="memberTaskGroupRelation")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity=WorkGroup::class, mappedBy="memberTaskGroupRelation")
     */
    private $workGroups;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->workGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $member->setMemberTaskGroupRelation($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getMemberTaskGroupRelation() === $this) {
                $member->setMemberTaskGroupRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setMemberTaskGroupRelation($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getMemberTaskGroupRelation() === $this) {
                $task->setMemberTaskGroupRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WorkGroup[]
     */
    public function getWorkGroups(): Collection
    {
        return $this->workGroups;
    }

    public function addWorkGroup(WorkGroup $workGroup): self
    {
        if (!$this->workGroups->contains($workGroup)) {
            $this->workGroups[] = $workGroup;
            $workGroup->setMemberTaskGroupRelation($this);
        }

        return $this;
    }

    public function removeWorkGroup(WorkGroup $workGroup): self
    {
        if ($this->workGroups->contains($workGroup)) {
            $this->workGroups->removeElement($workGroup);
            // set the owning side to null (unless already changed)
            if ($workGroup->getMemberTaskGroupRelation() === $this) {
                $workGroup->setMemberTaskGroupRelation(null);
            }
        }

        return $this;
    }
}
