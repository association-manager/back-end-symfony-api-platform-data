<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
// CustomAsset
// use App\Validator\Constraints as DateTimeAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectPlanningRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/projets/plannings/lister"},
 *          "POST"={"path"="/projets/plannings/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/projet/planning/{id}/afficher"}, 
 *          "PUT"={"path"="/projet/planning/{id}/modifier"},
 *          "DELETE"={"path"="/projet/planning/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "project_planning_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class ProjectPlanning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("string", message="Le nom n'est pas conforme")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("\DateTimeInterface", message="Le format de la date de début n'est pas correcte.")
     * @Assert\GreaterThan("today UTC", message="La date de début doit être ultérieure à la date d'aujourd'hui !")
     */
    private $startAt;
    // @DateTimeAssert\AssoManagerDateTime()

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "task_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("\DateTimeInterface", message="Le format de la date de fin n'est pas correcte.")
     * @Assert\GreaterThan(propertyPath="startAt", message="La date de fin doit être plus éloignée que la date de début !")
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="projectPlannings")
     * @Groups({
     *      "member_read", 
     *      "project_planning_read", 
     *      "task_read"
     * })
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="projectPlanning")
     * @Groups({
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read",
     *      "projects_subresource"
     * })
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt($startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt($endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject($project): self
    {
        $this->project = $project;

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
            $task->setProjectPlanning($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getProjectPlanning() === $this) {
                $task->setProjectPlanning(null);
            }
        }

        return $this;
    }
}
