<?php

namespace App\Entity;

use App\Repository\AdvertisementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdvertisementRepository::class)
 */
class Advertisement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="advertisements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="advertisements")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=VisitorServicePlatform::class, inversedBy="advertisements")
     */
    private $visitorServicePlatforms;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=AppWebMobile::class, inversedBy="advertisements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appWebMobile;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->visitorServicePlatforms = new ArrayCollection();
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

    public function getAppWebMobile(): ?AppWebMobile
    {
        return $this->appWebMobile;
    }

    public function setAppWebMobile(?AppWebMobile $appWebMobile): self
    {
        $this->appWebMobile = $appWebMobile;

        return $this;
    }
}
