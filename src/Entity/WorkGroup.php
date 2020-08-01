<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\WorkGroupRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WorkGroupRepository::class)
 * @ORM\Table(name="`work_group`")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/groupes/lister"},
 *          "POST"={"path"="/groupes/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/groupe/{id}/afficher"}, 
 *          "PUT"={"path"="/groupe/{id}/modifier"},
 *          "DELETE"={"path"="/groupe/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "projects_get_subresource"={"path"="/groupe/{id}/projets"}   
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "work_group_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class WorkGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read"
     * })
     * @Assert\Type("string", message="Le format du nom de groupe n'est pas valide")
     *  @Assert\Length(
     *      max=80, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 80 caractères"
     * )
     * @Assert\NotBlank(message="Le nom du groupe est obligatoire")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Association::class, inversedBy="workGroups")
     * @Groups({
     *      "work_group_read", 
     *      "member_task_work_group_relation_read"
     * })
     */
    private $association;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="workGroup")
     * @Groups({
     *      "work_group_read", 
     *      "association_read", 
     *      "member_task_work_group_relation_read"
     * })
     * 
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity=MemberTaskWorkGroupRelation::class, mappedBy="workGroup")
     * @Groups({
     *      "work_group_read"
     * })
     * 
     */
    private $memberTaskWorkGroupRelations;

    public function __construct()
    {
        $this->association = new ArrayCollection();
        $this->projects = new ArrayCollection();
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

    public function setName($name): self
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
