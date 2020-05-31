<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlanningRepository")
 */
class Planning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity=AssoManagerEvent::class, mappedBy="planning")
     */
    private $assoManagerEvents;

    public function __construct()
    {
        $this->assoManagerEvents = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }
    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="plannings")
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="plannings")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="planning")
     */
    private $projects;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|AssoManagerEvent[]
     */
    public function getAssoManagerEvents(): Collection
    {
        return $this->assoManagerEvents;
    }

    public function addEvent(AssoManagerEvent $assoManagerEvent): self
    {
        if (!$this->assoManagerEvents->contains($assoManagerEvent)) {
            $this->assoManagerEvents[] = $assoManagerEvent;
            $assoManagerEvent->addPlanning($this);
        }

        return $this;
    }

    public function removeEvent(AssoManagerEvent $assoManagerEvent): self
    {
        if ($this->assoManagerEvents->contains($assoManagerEvent)) {
            $this->assoManagerEvents->removeElement($assoManagerEvent);
            $assoManagerEvent->removePlanning($this);
        }
    }
    
    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $project->setPlanning($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getPlanning() === $this) {
                $project->setPlanning(null);
            }
        }

        return $this;
    }
}
