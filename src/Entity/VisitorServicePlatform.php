<?php

namespace App\Entity;

use App\Repository\VisitorServicePlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitorServicePlatformRepository::class)
 */
class VisitorServicePlatform
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $visitedTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $visitorNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $platform;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $usersAgentInformation;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $ipAddress;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $appScreen;

    /**
     * @ORM\ManyToMany(targetEntity=Advertisement::class, mappedBy="visitorServicePlatforms")
     */
    private $advertisements;

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitedTime(): ?\DateTimeInterface
    {
        return $this->visitedTime;
    }

    public function setVisitedTime(?\DateTimeInterface $visitedTime): self
    {
        $this->visitedTime = $visitedTime;

        return $this;
    }

    public function getVisitorNumber(): ?int
    {
        return $this->visitorNumber;
    }

    public function setVisitorNumber(?int $visitorNumber): self
    {
        $this->visitorNumber = $visitorNumber;

        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getUsersAgentInformation(): ?string
    {
        return $this->usersAgentInformation;
    }

    public function setUsersAgentInformation(?string $usersAgentInformation): self
    {
        $this->usersAgentInformation = $usersAgentInformation;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getAppScreen(): ?string
    {
        return $this->appScreen;
    }

    public function setAppScreen(?string $appScreen): self
    {
        $this->appScreen = $appScreen;

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
            $advertisement->addVisitorServicePlatform($this);
        }

        return $this;
    }

    public function removeAdvertisement(Advertisement $advertisement): self
    {
        if ($this->advertisements->contains($advertisement)) {
            $this->advertisements->removeElement($advertisement);
            $advertisement->removeVisitorServicePlatform($this);
        }

        return $this;
    }
}
