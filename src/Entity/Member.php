<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/membres/lister"},
 *          "POST"={"path"="/membres/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/membre/{id}/afficher"}, 
 *          "PUT"={"path"="/membre/{id}/modifier"},
 *          "DELETE"={"path"="/membre/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "api_users_members_get_subresource"={
 *          "normalization_context"={"groups"={"members_subresource"}}
 *          },
 *          "api_associations_members_get_subresource"={
 *          "normalization_context"={"groups"={"associations_members_subresource"}}
 *          }             
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "member_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "member_read", 
     *      "association_read", 
     *      "staff_read", 
     *      "donation_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read", 
     *      "work_group_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({
     *      "member_read", 
     *      "association_read", 
     *      "staff_read", 
     *      "donation_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read", 
     *      "work_group_read",
     *      "projects_subresource",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     * @Assert\Type(
     *     type="array",
     *     message="La valeur  {{ value }} ne respecte pas le format du type attendu {{ type }}."
     * )
     */
    private $profile = [];

    /**
     * @ORM\Column(type="json")
     * @Groups({
     *      "member_read", 
     *      "association_read", 
     *      "staff_read", 
     *      "donation_read", 
     *      "project_read", 
     *      "project_planning_read", 
     *      "task_read", 
     *      "work_group_read",
     *      "projects_subresource",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     * @Assert\Type(
     *     type="array",
     *     message="La valeur  {{ value }} ne respecte pas le format du type attendu {{ type }}."
     * )
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "member_read"
     * })
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity=Association::class, mappedBy="members")
     * @Groups({
     *      "member_read", 
     *      "staff_read", 
     *      "donation_read", 
     *      "donation_read", 
     *      "task_read",
     *      "members_subresource"
     * })
     */
    private $associations;

    /**
     * @ORM\OneToMany(targetEntity=Donation::class, mappedBy="member")
     * @Groups({
     *      "member_read", 
     *      "association_read", 
     *      "staff_read",
     *      "members_subresource",
     *      "associations_members_subresource"
     * })
     */
    private $donations;

    /**
     * @ORM\ManyToMany(targetEntity=Staff::class, inversedBy="members")
     * @Groups({
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     */
    private $staff;

    /**
     * @ORM\OneToMany(targetEntity=MemberTaskWorkGroupRelation::class, mappedBy="member")
     *  @Groups({
     *      "member_read"
     * })
     */
    private $memberTaskWorkGroupRelations;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $responsibility;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateOfEntry;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
        $this->donations = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->memberTaskWorkGroupRelations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?array
    {
        return $this->profile;
    }

    public function setProfile($profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles($roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection|Association[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->addMember($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
            $association->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection|Donation[]
     */
    public function getDonations(): Collection
    {
        return $this->donations;
    }

    public function addDonation(Donation $donation): self
    {
        if (!$this->donations->contains($donation)) {
            $this->donations[] = $donation;
            $donation->setMember($this);
        }

        return $this;
    }

    public function removeDonation(Donation $donation): self
    {
        if ($this->donations->contains($donation)) {
            $this->donations->removeElement($donation);
            // set the owning side to null (unless already changed)
            if ($donation->getMember() === $this) {
                $donation->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|staff[]
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staff->contains($staff)) {
            $this->staff[] = $staff;
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staff->contains($staff)) {
            $this->staff->removeElement($staff);
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
            $memberTaskWorkGroupRelation->setMember($this);
        }

        return $this;
    }

    public function removeMemberTaskWorkGroupRelation(MemberTaskWorkGroupRelation $memberTaskWorkGroupRelation): self
    {
        if ($this->memberTaskWorkGroupRelations->contains($memberTaskWorkGroupRelation)) {
            $this->memberTaskWorkGroupRelations->removeElement($memberTaskWorkGroupRelation);
            // set the owning side to null (unless already changed)
            if ($memberTaskWorkGroupRelation->getMember() === $this) {
                $memberTaskWorkGroupRelation->setMember(null);
            }
        }

        return $this;
    }

    public function getResponsibility(): ?string
    {
        return $this->responsibility;
    }

    public function setResponsibility(?string $responsibility): self
    {
        $this->responsibility = $responsibility;

        return $this;
    }

    public function getDateOfEntry(): ?\DateTimeInterface
    {
        return $this->dateOfEntry;
    }

    public function setDateOfEntry(?\DateTimeInterface $dateOfEntry): self
    {
        $this->dateOfEntry = $dateOfEntry;

        return $this;
    }
}
