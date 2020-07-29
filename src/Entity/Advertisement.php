<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdvertisementRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AdvertisementRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/annonces/lister"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/annonces/{id}/afficher"}
 *          },
 *      subresourceOperations={
 *          "user_get_subresource"={"path"="/annonces/{id}/annonceur"},
 *          "categories_get_subresource"={"path"="/annonces/{id}/categories"},
 *          "advertisement_files_get_subresource"={"path"="/annonces/{id}/medias"},
*           "association_get_subresource"={"path"="/annonces/{id}/association"}  
 *      },
 *      normalizationContext={
 *          "groups"={
 *              "annonces_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class Advertisement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Le titre ne peut pas contenir plus de 45 caractères"
     * )
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Le détails ne peut pas contenir plus de 255 caractères"
     * )
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $details;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="advertisements")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="advertisements")
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=VisitorServicePlatform::class, inversedBy="advertisements")
     */
    private $visitorServicePlatforms;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Le statut ne peut pas contenir plus de 45 caractères"
     * )
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $createdAt;

    // File management
    /**
     * @ORM\OneToMany(targetEntity=AdvertisementFile::class, mappedBy="advertisement", orphanRemoval=true, cascade={"persist", "remove"})
     * @Groups({
     *      "annonces_read"
     * })
     * @Assert\Valid
     */
    private $advertisementFiles;

    // Add image
    private $adImageFiles;

    // Ad video
    private $adVideoFiles;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Maximum 255 caractères"
     * )
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $audience;

    /**
     * @ORM\OneToOne(targetEntity=AppWebMobile::class, mappedBy="advertisement", cascade={"persist", "remove"})
     * @Groups({
     *      "annonces_read"
     * })
     * @Assert\Valid
     */
    private $appWebMobile;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="advertisements")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Vous devez être administrateur d'une association pour créer une annonce.")
     * @Groups({
     *      "annonces_read"
     * })
     */
    private $association;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->visitorServicePlatforms = new ArrayCollection();
        // File management
        $this->advertisementFiles = new ArrayCollection();
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
        if(empty($this->status)) {
            $this->status = "En attente de validation";
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|VisitorServicePlatform[]
     */
    public function getVisitorServicePlatforms(): Collection
    {
        return $this->visitorServicePlatforms;
    }

    public function addVisitorServicePlatform(VisitorServicePlatform $visitorServicePlatform): self
    {
        if (!$this->visitorServicePlatforms->contains($visitorServicePlatform)) {
            $this->visitorServicePlatforms[] = $visitorServicePlatform;
        }

        return $this;
    }

    public function removeVisitorServicePlatform(VisitorServicePlatform $visitorServicePlatform): self
    {
        if ($this->visitorServicePlatforms->contains($visitorServicePlatform)) {
            $this->visitorServicePlatforms->removeElement($visitorServicePlatform);
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    // Start File management
    
    /**
     * @return Collection|AdvertisementFile[]
     */
    public function getAdvertisementFiles(): Collection
    {
        return $this->advertisementFiles;
    }

    public function addAdvertisementFile(AdvertisementFile $advertisementFile): self
    {
        if (!$this->advertisementFiles->contains($advertisementFile)) {
            $this->advertisementFiles[] = $advertisementFile;
            $advertisementFile->setAdvertisement($this);
        }

        return $this;
    }

    public function removeAdvertisementFile(AdvertisementFile $advertisementFile): self
    {
        if ($this->advertisementFiles->contains($advertisementFile)) {
            $this->advertisementFiles->removeElement($advertisementFile);
            // set the owning side to null (unless already changed)
            if ($advertisementFile->getAdvertisement() === $this) {
                $advertisementFile->setAdvertisement(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */ 
    public function getAdImageFiles()
    {
        return $this->adImageFiles;
    }

    /**
     * @param mixed $adImageFiles
     *
     * @return  self
     */ 
    public function setAdImageFiles($adImageFiles): self
    {
        foreach ($adImageFiles as $adImageFile)
        {
            $advertisementFile = new AdvertisementFile();
            $advertisementFile->setImageFile($adImageFile);
            $this->addAdvertisementFile($advertisementFile);
        }

        $this->adImageFiles = $adImageFiles;

        return $this;
    }

    /**
     * @return mixed
     */ 
    public function getAdVideoFiles()
    {
        return $this->adVideoFiles;
    }

    /**
     * @param mixed $adVideoFiles
     *
     * @return  self
     */ 
    public function setAdVideoFiles($adVideoFiles): self
    {
        foreach ($adVideoFiles as $adVideoFile)
        {
            $advertisementFile = new AdvertisementFile();
            $advertisementFile->setVideoFile($adVideoFile);
            $this->addAdvertisementFile($advertisementFile);
        }

        $this->adVideoFiles = $adVideoFiles;

        return $this;
    }
    
    // End file management

    public function getAudience(): ?string
    {
        return $this->audience;
    }

    public function setAudience(string $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    public function getAppWebMobile(): ?AppWebMobile
    {
        return $this->appWebMobile;
    }

    public function setAppWebMobile(AppWebMobile $appWebMobile): self
    {
        $this->appWebMobile = $appWebMobile;

        // set the owning side of the relation if necessary
        if ($appWebMobile->getAdvertisement() !== $this) {
            $appWebMobile->setAdvertisement($this);
        }

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
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
}
