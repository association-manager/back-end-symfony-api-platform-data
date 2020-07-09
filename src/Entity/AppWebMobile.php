<?php

namespace App\Entity;

use App\Repository\AppWebMobileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppWebMobileRepository::class)
 */
class AppWebMobile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webPageUrl;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $webPageUrlTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile_screen;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $mobileScreenTitle;

    /**
     * @ORM\OneToMany(targetEntity=Advertisement::class, mappedBy="appWebMobile")
     */
    private $advertisements;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateOfDemand;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebPageUrl(): ?string
    {
        return $this->webPageUrl;
    }

    public function setWebPageUrl(?string $webPageUrl): self
    {
        $this->webPageUrl = $webPageUrl;

        return $this;
    }

    public function getMobileScreen(): ?string
    {
        return $this->mobile_screen;
    }

    public function setMobileScreen(?string $mobile_screen): self
    {
        $this->mobile_screen = $mobile_screen;

        return $this;
    }

    /**
     * @return Collection|Advertisement[]
     */
    public function getAdvertisements(): Collection
    {
        return $this->advertisements;
    }

    public function addAdvertisement(Advertisement $advertisement): self
    {
        if (!$this->advertisements->contains($advertisement)) {
            $this->advertisements[] = $advertisement;
            $advertisement->setAppWebMobile($this);
        }

        return $this;
    }

    public function removeAdvertisement(Advertisement $advertisement): self
    {
        if ($this->advertisements->contains($advertisement)) {
            $this->advertisements->removeElement($advertisement);
            // set the owning side to null (unless already changed)
            if ($advertisement->getAppWebMobile() === $this) {
                $advertisement->setAppWebMobile(null);
            }
        }

        return $this;
    }

    public function getDateOfDemand(): ?\DateTimeInterface
    {
        return $this->dateOfDemand;
    }

    public function setDateOfDemand(?\DateTimeInterface $dateOfDemand): self
    {
        $this->dateOfDemand = $dateOfDemand;

        return $this;
    }

    public function getWebPageUrlTitle(): ?string
    {
        return $this->webPageUrlTitle;
    }

    public function setWebPageUrlTitle(?string $webPageUrlTitle): self
    {
        $this->webPageUrlTitle = $webPageUrlTitle;

        return $this;
    }

    public function getMobileScreenTitle(): ?string
    {
        return $this->mobileScreenTitle;
    }

    public function setMobileScreenTitle(?string $mobileScreenTitle): self
    {
        $this->mobileScreenTitle = $mobileScreenTitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
}
