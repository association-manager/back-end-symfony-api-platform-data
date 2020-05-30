<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRepository")
 * @ApiResource
 */
class Association
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dataUsageAgreement;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $associationType;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $assemblyConstituveDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $foundedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=WorkGroup::class, mappedBy="association")
     */
    private $workGroups;


    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="association")
     */
    private $addresses;

    /**
     * @ORM\ManyToMany(targetEntity=Member::class, inversedBy="associations")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity=NetworksSocialLink::class, mappedBy="association")
     */
    private $networksSocialLinks;

    /**
     * @ORM\OneToOne(targetEntity=AssociationProfile::class, inversedBy="association", cascade={"persist", "remove"})
     */
    private $associationProfile;

    /**
     * @ORM\OneToMany(targetEntity=Planning::class, mappedBy="association")
     */
    private $plannings;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="association", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="association")
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=FileManager::class, mappedBy="association")
     */
    private $files;

    public function __construct()
    {
        $this->workGroups = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->networksSocialLinks = new ArrayCollection();
        $this->plannings = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->fileManagers = new ArrayCollection();
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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
            if ($address->getAssociation() === $this) {
                $address->setAssociation(null);
            }
        }

        return $this;
    }
}
