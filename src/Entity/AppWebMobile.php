<?php

namespace App\Entity;

use App\Repository\AppWebMobileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppWebMobileRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="L'url de la page web ne peut pas contenir plus de 255 caractères"
     * )
     * @Assert\Url(
     *    relativeProtocol = true,
     *    protocols = {"http", "https"},
     *    message = "Cette url '{{ value }}' n'est pas valide"
     * )
     */
    private $webPageUrl;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Le titre de la page web ne peut pas contenir plus de 45 caractères"
     * )
     */
    private $webPageUrlTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="Le profil mobile ne peut pas contenir plus de 255 caractères"
     * )
     */
    private $mobile_screen;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Le titre du profil mobile ne peut pas contenir plus de 45 caractères"
     * )
     */
    private $mobileScreenTitle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateOfDemand;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max=255, 
     *      maxMessage="La description ne peut pas contenir plus de 255 caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(
     *      max=45, 
     *      maxMessage="Le statut ne peut pas contenir plus de 45 caractères"
     * )
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=Advertisement::class, inversedBy="appWebMobile", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $advertisement;

    public function __construct()
    {
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
        if(empty($this->dateOfDemand)) {
            $this->dateOfDemand = new \DateTime();
        }
        if(empty($this->status)) {
            $this->status = "En attente de validation";
        }
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

    public function getAdvertisement(): ?Advertisement
    {
        return $this->advertisement;
    }

    public function setAdvertisement(Advertisement $advertisement): self
    {
        $this->advertisement = $advertisement;

        return $this;
    }
}
