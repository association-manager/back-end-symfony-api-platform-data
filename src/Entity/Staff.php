<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StaffRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StaffRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/personnels/lister"},
 *          "POST"={"path"="/personnels/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/personnel/{id}/afficher"}, 
 *          "PUT"={"path"="/personnel/{id}/modifier"},
 *          "DELETE"={"path"="/personnel/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "staff_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class Staff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "staff_read", 
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "staff_read", 
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     * @Assert\Type("string", message="Le format du nom n'est pas valide")
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 255 caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *      "staff_read", 
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     * @Assert\Type("string", message="Le format de la description n'est pas valide")
     */
    private $description;


    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Type("integer", message="Format non valide")
     * @Assert\Length(
     *      max=1, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 1 caractère"
     * )
     */
    private $dataUsageAgreement;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     * @Assert\Type("string", message="Le format du type d'association n'est pas valide")
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 45 caractères"
     * )
     * @Assert\NotBlank(message="Le type d'association est obligatoire")
     */
    private $associationType;

    /**
     * @ORM\Column(type="string", nullable=true, length=20)
     * @Groups({
     *      "staff_read", 
     *      "member_read", 
     *      "association_read",
     *      "members_subresource"
     * })
     * @Assert\Type("string", message="Le format du téléphone n'est pas valide")
     * @Assert\Regex(
     *      pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/",
     *      message="Ce numéro de téléphone n'est pas valide."
     * )
     * @Assert\Length(
     *      max=20, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 20 caractères"
     * )
     */
    private $phoneNumber;

    /**
     * @ORM\ManyToMany(targetEntity=Member::class, mappedBy="staff")
     * @Groups({
     *      "staff_read"
     * })
     */
    private $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDataUsageAgreement(): ?int
    {
        return $this->dataUsageAgreement;
    }

    public function setDataUsageAgreement($dataUsageAgreement): self
    {
        $this->dataUsageAgreement = $dataUsageAgreement;

        return $this;
    }

    public function getAssociationType(): ?string
    {
        return $this->associationType;
    }

    public function setAssociationType($associationType): self
    {
        $this->associationType = $associationType;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
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
            $member->addStaff($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            $member->removeStaff($this);
        }

        return $this;
    }
}
