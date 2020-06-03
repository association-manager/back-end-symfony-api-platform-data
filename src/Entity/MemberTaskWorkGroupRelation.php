<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\MemberTaskWorkGroupRelationRepository;

/**
 * @ORM\Entity(repositoryClass=MemberTaskWorkGroupRelationRepository::class)
 * * @ApiResource(
 *      collectionOperations={
 *          "GET",
 *          "POST"
 *           },
 *      itemOperations={
 *          "GET", 
 *          "PUT",
 *          "DELETE"
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "member_task_work_group_relation_read"
 *          }
 *      }
 * )
 */
class MemberTaskWorkGroupRelation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read", 
     *      "work_group_read",
     *      "projects_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="memberTaskWorkGroupRelations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "member_task_work_group_relation_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read", 
     *      "work_group_read",
     *      "projects_subresource"
     * })
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="memberTaskWorkGroupRelations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "member_task_work_group_relation_read", 
     *      "member_read"
     * })
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity=WorkGroup::class, inversedBy="memberTaskWorkGroupRelations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "member_task_work_group_relation_read", 
     *      "member_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read"
     * })
     */
    private $workGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        $this->task = $task;

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
