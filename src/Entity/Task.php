<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/taches/lister"},
 *          "POST"={"path"="/taches/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/tache/{id}/afficher"}, 
 *          "PUT"={"path"="/tache/{id}/modifier"},
 *          "DELETE"={"path"="/tache/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "task_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("string", message="Le format du titre n'est pas conforme")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("\DateTimeInterface", message="Le format de la date de début n'est pas correcte.")
     * @Assert\GreaterThan("today UTC", message="La date de début doit être ultérieure à la date d'aujourd'hui !")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("\DateTimeInterface", message="Le format de la date de fin n'est pas correcte.")
     * @Assert\GreaterThan(propertyPath="startDate", message="La date de fin doit être plus éloignée que la date de début !")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("string", message="Le format du type de tâche n'est pas conforme")
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read",
     *      "projects_subresource"
     * })
     * @Assert\Type("string", message="La description n'est pas au bon format")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectPlanning::class, inversedBy="tasks")
     * @Groups({
     *      "task_read", 
     *      "member_read"
     * })
     */
    private $projectPlanning;

    /**
     * @ORM\OneToMany(targetEntity=MemberTaskWorkGroupRelation::class, mappedBy="task")
     * @Groups({
     *      "task_read", 
     *      "project_planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read",
     *      "projects_subresource"
     * })
     */
    private $memberTaskWorkGroupRelations;

    public function __construct()
    {
        $this->memberTaskWorkGroupRelations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate($endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProjectPlanning(): ?ProjectPlanning
    {
        return $this->projectPlanning;
    }

    public function setProjectPlanning(?ProjectPlanning $projectPlanning): self
    {
        $this->projectPlanning = $projectPlanning;

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
            $memberTaskWorkGroupRelation->setTask($this);
        }

        return $this;
    }

    public function removeMemberTaskWorkGroupRelation(MemberTaskWorkGroupRelation $memberTaskWorkGroupRelation): self
    {
        if ($this->memberTaskWorkGroupRelations->contains($memberTaskWorkGroupRelation)) {
            $this->memberTaskWorkGroupRelations->removeElement($memberTaskWorkGroupRelation);
            // set the owning side to null (unless already changed)
            if ($memberTaskWorkGroupRelation->getTask() === $this) {
                $memberTaskWorkGroupRelation->setTask(null);
            }
        }

        return $this;
    }
}
