<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/associations/lister"},
 *          "POST"={"path"="/associations/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/association/{id}/afficher"}, 
 *          "PUT"={"path"="/association/{id}/modifier"},
 *          "DELETE"={"path"="/association/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "addresses_get_subresource"={"path"="/associations/{id}/adresses"},
 *          "transactions_get_subresource"={"path"="/associations/{id}/transactions"},
*           "plannings_get_subresource"={"path"="/associations/{id}/plannings"},
 *          "members_get_subresource"={"path"="/associations/{id}/membres"}       
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "association_read"
 *          }
 *      }
 * )
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Cette adresse email {{ value }} est déjà utilisée."
 * )
 */
class Association
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "file_manager_read", 
     *      "member_read", 
     *      "planning_read", 
     *      "task_read", 
     *      "transaction_read", 
     *      "work_group_read",
     *      "members_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read", 
     *      "asso_manager_event_read", 
     *      "category_read", 
     *      "file_manager_read", 
     *      "member_read", 
     *      "planning_read", 
     *      "task_read", 
     *      "transaction_read", 
     *      "work_group_read",
     *      "members_subresource"
     * })
     * @Assert\NotBlank(message="Le prénom de l'association est obligatoire")
     * @Assert\Length(min=3, minMessage="Le nom de l'association doit faire entre 3 et 255 caractères", max=255, maxMessage="Le nom de l'association doit faire entre 3 et 255 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({
     *      "association_read"
     * })
     */
    private $dataUsageAgreement;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, columnDefinition="enum('Association loi de 1901', 'Association avec agrément', 'Association d\'utilité publique')")
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "association_profile_read"
     * })
     */
    private $associationType;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read"
     * })
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read"
     * })
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read"
     * })
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read", 
     *      "association_profile_read"
     * })
     * @Assert\NotBlank(message="L'email est obligatoire")
     * @Assert\Email(
     *     message = "Cette adresse email '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     * @Assert\NotBlank(message="Le prénom est obligatoire")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     * @Assert\NotBlank(message="La date de constitution de l'assemblée est obligatoire")
     */
    private $assemblyConstituveDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     */
    private $foundedAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=WorkGroup::class, mappedBy="association")
     * @Groups({
     *      "association_read"
     * })
     */
    private $workGroups;


    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="association" , cascade={"persist", "remove"})
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "association_profile_read"
     * })
     * @ApiSubresource
     */
    private $addresses;

    /**
     * @ORM\ManyToMany(targetEntity=Member::class, inversedBy="associations")
     * @Groups({
     *      "association_read"
     * })
     * @ApiSubresource
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity=NetworksSocialLink::class, mappedBy="association")
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "association_profile_read"
     * })
     */
    private $networksSocialLinks;

    /**
     * @ORM\OneToOne(targetEntity=AssociationProfile::class, inversedBy="association", cascade={"persist", "remove"})
     * @Groups({
     *      "association_read", 
     *      "donation_read", 
     *      "staff_read", 
     *      "address_read"
     * })
     */
    private $associationProfile;

    /**
     * @ORM\OneToMany(targetEntity=Planning::class, mappedBy="association")
     * @Groups({
     *      "association_read"
     * })
     * @ApiSubresource
     */
    private $plannings;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="association", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="association")
     * @Groups({
     *      "association_read"
     * })
     * @ApiSubresource
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=FileManager::class, mappedBy="association")
     * @Groups({
     *      "association_read", 
     *      "association_profile_read"
     * })
     */
    private $fileManagers;

    public function __construct()
    {
        $this->workGroups = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->networksSocialLinks = new ArrayCollection();
        $this->plannings = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->fileManagers = new ArrayCollection();

        // Set auto createdAt
        // if(null !== $this->name){
        //     $this->createdAt = new \DateTimeImmutable();
        // }

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

    public function getDataUsageAgreement(): ?bool
    {
        return $this->dataUsageAgreement;
    }

    public function setDataUsageAgreement(?bool $dataUsageAgreement): self
    {
        $this->dataUsageAgreement = $dataUsageAgreement;

        return $this;
    }

    public function getAssociationType(): ?string
    {
        return $this->associationType;
    }

    public function setAssociationType(string $associationType): self
    {
        $this->associationType = $associationType;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAssemblyConstituveDate(): ?\DateTimeInterface
    {
        return $this->assemblyConstituveDate;
    }

    public function setAssemblyConstituveDate(\DateTimeInterface $assemblyConstituveDate): self
    {
        $this->assemblyConstituveDate = $assemblyConstituveDate;

        return $this;
    }

    public function getFoundedAt(): ?\DateTimeInterface
    {
        return $this->foundedAt;
    }

    public function setFoundedAt(?\DateTimeInterface $foundedAt): self
    {
        $this->foundedAt = $foundedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|WorkGroup[]
     */
    public function getWorkGroups(): Collection
    {
        return $this->workGroups;
    }

    public function addWorkGroup(WorkGroup $workGroup): self
    {
        if (!$this->workGroups->contains($workGroup)) {
            $this->workGroups[] = $workGroup;
            $workGroup->addAssociationId($this);
        }

        return $this;
    }

    public function removeWorkGroup(WorkGroup $workGroup): self
    {
        if ($this->workGroups->contains($workGroup)) {
            $this->workGroups->removeElement($workGroup);
            $workGroup->removeAssociationId($this);
        }

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
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
        }

        return $this;
    }

    /**
     * @return Collection|NetworksSocialLink[]
     */
    public function getNetworksSocialLinks(): Collection
    {
        return $this->networksSocialLinks;
    }

    public function addNetworksSocialLink(NetworksSocialLink $networksSocialLink): self
    {
        if (!$this->networksSocialLinks->contains($networksSocialLink)) {
            $this->networksSocialLinks[] = $networksSocialLink;
            $networksSocialLink->setAssociation($this);
        }

        return $this;
    }

    public function removeNetworksSocialLink(NetworksSocialLink $networksSocialLink): self
    {
        if ($this->networksSocialLinks->contains($networksSocialLink)) {
            $this->networksSocialLinks->removeElement($networksSocialLink);
            // set the owning side to null (unless alassociation_ready changed)
            if ($networksSocialLink->getAssociation() === $this) {
                $networksSocialLink->setAssociation(null);
            }
        }

        return $this;
    }

    public function getAssociationProfile(): ?AssociationProfile
    {
        return $this->associationProfile;
    }

    public function setAssociationProfile(?AssociationProfile $associationProfile): self
    {
        $this->associationProfile = $associationProfile;

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setAssociation($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->contains($planning)) {
            $this->plannings->removeElement($planning);
            // set the owning side to null (unless alassociation_ready changed)
            if ($planning->getAssociation() === $this) {
                $planning->setAssociation(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setAssociation($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless alassociation_ready changed)
            if ($transaction->getAssociation() === $this) {
                $transaction->setAssociation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FileManager[]
     */
    public function getFileManagers(): Collection
    {
        return $this->fileManagers;
    }

    public function addFileManager(FileManager $fileManager): self
    {
        if (!$this->fileManagers->contains($fileManager)) {
            $this->fileManagers[] = $fileManager;
            $fileManager->setAssociation($this);
        }

        return $this;
    }

    public function removeFileManager(FileManager $fileManager): self
    {
        if ($this->fileManagers->contains($fileManager)) {
            $this->fileManagers->removeElement($fileManager);
            // set the owning side to null (unless alassociation_ready changed)
            if ($fileManager->getAssociation() === $this) {
                $fileManager->setAssociation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setAssociation($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless alassociation_ready changed)
            if ($address->getAssociation() === $this) {
                $address->setAssociation(null);
            }
        }

        return $this;
    }
}
