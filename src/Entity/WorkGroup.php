<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WorkGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkGroupRepository::class)
 * @ORM\Table(name="`work_group`")
 * @ApiResource
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
     * @ORM\ManyToMany(targetEntity=Association::class, inversedBy="groups")
     */
    private $association;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="workGroup")
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity=WorkGroup::class, inversedBy="workGroups")
     */
    private $workGroup;

    /**
     * @ORM\OneToMany(targetEntity=WorkGroup::class, mappedBy="workGroup")
     */
    private $workGroups;

    /**
     * @ORM\OneToMany(targetEntity=MemberTaskWorkGroupRelation::class, mappedBy="workGroup")
     */
    private $memberTaskWorkGroupRelations;

    public function __construct()
    {
        $this->association = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->workGroups = new ArrayCollection();
        $this->memberTaskWorkGroupRelations = new ArrayCollection();
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
        return $this->association;
    }

    public function addAssociationId(Association $association): self
    {
        if (!$this->association->contains($association)) {
            $this->association[] = $association;
        }

        return $this;
    }

    public function removeAssociationId(Association $association): self
    {
        if ($this->association->contains($association)) {
            $this->association->removeElement($association);
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setWorkGroup($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getWorkGroup() === $this) {
                $project->setWorkGroup(null);
            }
        }

        return $this;
    }

    public function getWorkGroup(): ?self
    {
        return $this->workGroup;
    }

    public function setWorkGroup(?self $workGroup): self
    {
        $this->workGroup = $workGroup;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getWorkGroups(): Collection
    {
        return $this->workGroups;
    }

    public function addWorkGroup(self $workGroup): self
    {
        if (!$this->workGroups->contains($workGroup)) {
            $this->workGroups[] = $workGroup;
            $workGroup->setWorkGroup($this);
        }

        return $this;
    }

    public function removeWorkGroup(self $workGroup): self
    {
        if ($this->workGroups->contains($workGroup)) {
            $this->workGroups->removeElement($workGroup);
            // set the owning side to null (unless already changed)
            if ($workGroup->getWorkGroup() === $this) {
                $workGroup->setWorkGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MemberTaskWorkGroupRelation[]
     */
    public function getMemberTaskWorkGroupRelations(): Collection
    {
        return $this->memberTaskWorkGroupRelations;
    }

    public function addMemberTaskWorkGroupRelation(MemberTaskWorkGroupRelation $memberTaskWorkGroupRelation): self
    {
        if (!$this->memberTaskWorkGroupRelations->contains($memberTaskWorkGroupRelation)) {
            $this->memberTaskWorkGroupRelations[] = $memberTaskWorkGroupRelation;
            $memberTaskWorkGroupRelation->setWorkGroup($this);
        }

        return $this;
    }

    public function removeMemberTaskWorkGroupRelation(MemberTaskWorkGroupRelation $memberTaskWorkGroupRelation): self
    {
        if ($this->memberTaskWorkGroupRelations->contains($memberTaskWorkGroupRelation)) {
            $this->memberTaskWorkGroupRelations->removeElement($memberTaskWorkGroupRelation);
            // set the owning side to null (unless already changed)
            if ($memberTaskWorkGroupRelation->getWorkGroup() === $this) {
                $memberTaskWorkGroupRelation->setWorkGroup(null);
            }
        }

        return $this;
    }
}
