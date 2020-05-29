<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ApiResource
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $projectType;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Planning::class, inversedBy="projects")
     */
    private $planning;

    /**
     * @ORM\OneToMany(targetEntity=ProjectPlanning::class, mappedBy="project")
     */
    private $projectPlannings;

    /**
     * @ORM\ManyToOne(targetEntity=WorkGroup::class, inversedBy="projects")
     */
    private $workGroup;

    public function __construct()
    {
        $this->projectPlannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getProjectType(): ?string
    {
        return $this->projectType;
    }

    public function setProjectType(?string $projectType): self
    {
        $this->projectType = $projectType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    /**
     * @return Collection|ProjectPlanning[]
     */
    public function getProjectPlannings(): Collection
    {
        return $this->projectPlannings;
    }

    public function addProjectPlanning(ProjectPlanning $projectPlanning): self
    {
        if (!$this->projectPlannings->contains($projectPlanning)) {
            $this->projectPlannings[] = $projectPlanning;
            $projectPlanning->setProject($this);
        }

        return $this;
    }

    public function removeProjectPlanning(ProjectPlanning $projectPlanning): self
    {
        if ($this->projectPlannings->contains($projectPlanning)) {
            $this->projectPlannings->removeElement($projectPlanning);
            // set the owning side to null (unless already changed)
            if ($projectPlanning->getProject() === $this) {
                $projectPlanning->setProject(null);
            }
        }

        return $this;
    }

    public function getWorkGroup(): ?WorkGroup
    {
        return $this->workGroup;
    }

    public function setWorkGroup(?WorkGroup $workGroup): self
    {
        $this->workGroup = $workGroup;

        return $this;
    }
}
