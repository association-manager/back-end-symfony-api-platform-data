<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanningRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/plannings/lister"},
 *          "POST"={"path"="/plannings/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/planning/{id}/afficher"}, 
 *          "PUT"={"path"="/planning/{id}/modifier"},
 *          "DELETE"={"path"="/planning/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "api_associations_plannings_get_subresource"={
 *          "normalization_context"={"groups"={"associations_plannings_subresource"}}
 *          } 
 *      }, 
 *      normalizationContext={
 *          "groups"={
 *              "planning_read"
 *          }
 *      }
 * 
 * )
 */
class Planning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource",
     *      "associations_plannings_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource",
     *      "associations_plannings_subresource"
     * })
     * @Assert\Length(
     *  min = 2,
     *  max = 255,
     *  minMessage = "Votre titre doit être superieur à {{ limit }} caractères",
     *  maxMessage = "Votre titre doit être inferieur à {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource",
     *      "associations_plannings_subresource"
     * })
     * @Assert\DateTime
     * @var string A "J/m/Y H:i:s" formatted value
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource",
     *      "associations_plannings_subresource"
     * })
     * @Assert\DateTime
     * @var string A "J/m/Y H:i:s" formatted value
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource",
     *      "associations_plannings_subresource"
     * })
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity=AssoManagerEvent::class, mappedBy="planning")
     * @Groups({
     *      "planning_read", 
     *      "category_read",
     *      "associations_plannings_subresource"
     * })
     */
    private $assoManagerEvents;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="plannings")
     * @Groups({
     *      "planning_read", 
     *      "asso_manager_event_read", 
     *      "category_read"
     * })
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="plannings")
     * @Groups({
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read",
     *      "projects_subresource"
     * })
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="planning")
     * @Groups({
     *      "planning_read", 
     *      "category_read"
     * })
     */
    private $projects;

    public function __construct()
    {
        $this->assoManagerEvents = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
