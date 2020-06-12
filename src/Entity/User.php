<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/utilisateurs/lister"},
 *          "POST"={"path"="/utilisateurs/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/utilisateur/{id}/afficher"}, 
 *          "PUT"={"path"="/utilisateur/{id}/modifier"},
 *          "DELETE"={"path"="/utilisateur/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "addresses_get_subresource"={"path"="/utilisateurs/{id}/adresses"} ,
 *          "members_get_subresource"={"path"="/utilisateurs/{id}/membres"}  
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "user_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_read", "member_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read", "member_read"})
     * @Assert\Email(
     *     message = "L'adresse email '{{ value }}' n'est pas valide."
     * )
     * @Assert\NotBlank(message="L'email est obligatoire")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user_read", "member_read"})
     * @Assert\Type(
     *     type="array",
     *     message="La valeur  {{ value }} ne respecte pas le format du type attendu {{ type }}."
     * )
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "member_read"})
     * @Assert\Type("string", message="Le format du prénom n'est pas valide")
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 255 caractères"
     * )
     * @Assert\NotBlank(message="Le prénom est obligatoire")
     * @Assert\NotBlank(message="Le prénom est obligatoire")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "member_read"})
     * @Assert\Type("string", message="Le format du nom n'est pas valide")
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 255 caractères"
     * )
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user_read", "member_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     * @Assert\Type(
     *     type="bool",
     *     message="La valeur {{ value }} n'est pas un {{ type }} valid."
     * )
     */
    private $dataUsageAgreement = false;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"user_read", "member_read"})
     * @Assert\Type("string", message="Le mobile n'est pas conforme")
     * @Assert\Regex(
     *      pattern="/^(0|\+33)[6-7]([-. ]?[0-9]{2}){4}$/",
     *      message="Ce numéro de mobile n'est pas valide."
     * )
     */
    private $mobile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $validatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $updatedBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $validatedBy;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"user_read", "member_read"})
     * @Assert\Type("string", message="Le sexe n'est pas conforme")
     * @Assert\Length(
     *      max=10, 
     *      maxMessage="Vous ne pouvez pas saisir plus de 10 caractères"
     * )
     */
    private $sex;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type("\DateTimeInterface", message="Le format de la date de naissance n'est pas correcte.")
     */
    private $dob;

    /**
     * Getting and setting user password befor enconding by password property
     *
     * @var string
     * @Assert\NotBlank(message="Le mot de passe est obligatoire")
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Member", mappedBy="userId", orphanRemoval=true)
     * @ApiSubresource
     * @Assert\Valid
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity=FileManager::class, mappedBy="createdBy")
     * @Groups({"user_read", "member_read"})
     * @Assert\Valid
     */
    private $fileManagers;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="user", cascade={"persist"})
     * @Groups({"user_read", "member_read"})
     * @ApiSubresource
     * @Assert\Valid
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Association::class, mappedBy="createdBy", cascade={"persist", "remove"})
     */
    private $associations;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->dataUsageAgreement = true;
        $this->members = new ArrayCollection();
        $this->fileManagers = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->associations = new ArrayCollection();
    }

    /**
     * Automatically assign the current date
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function prePersist() {
        if(empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(){
        return "{$this->firstName} {$this->lastName}";
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDataUsageAgreement(): ?bool
    {
        return $this->dataUsageAgreement;
    }

    public function setDataUsageAgreement(bool $dataUsageAgreement): self
    {
        if (!$dataUsageAgreement) $this->dataUsageAgreement = false;
        else $this->dataUsageAgreement = $dataUsageAgreement;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->validatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $this->validatedAt = $validatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?self
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?self $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getValidatedBy(): ?self
    {
        return $this->validatedBy;
    }

    public function setValidatedBy(?self $validatedBy): self
    {
        $this->validatedBy = $validatedBy;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
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
            $member->setUserId($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getUserId() === $this) {
                $member->setUserId(null);
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
            $fileManager->setCreatedBy($this);
        }

        return $this;
    }

    public function removeFileManager(FileManager $fileManager): self
    {
        if ($this->fileManagers->contains($fileManager)) {
            $this->fileManagers->removeElement($fileManager);
            // set the owning side to null (unless already changed)
            if ($fileManager->getCreatedBy() === $this) {
                $fileManager->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->address->contains($address)) {
            $this->address->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }
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
            $association->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
            // set the owning side to null (unless already changed)
            if ($association->getCreatedBy() === $this) {
                $association->setCreatedBy(null);
            }
        }

        return $this;
    }
}
