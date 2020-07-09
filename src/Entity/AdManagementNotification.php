<?php

namespace App\Entity;

use App\Repository\AdManagementNotificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdManagementNotificationRepository::class)
 */
class AdManagementNotification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSender;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isReciever;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sendDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adManagementNotifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getIsSender(): ?bool
    {
        return $this->isSender;
    }

    public function setIsSender(?bool $isSender): self
    {
        $this->isSender = $isSender;

        return $this;
    }

    public function getIsReciever(): ?bool
    {
        return $this->isReciever;
    }

    public function setIsReciever(?bool $isReciever): self
    {
        $this->isReciever = $isReciever;

        return $this;
    }

    public function getSendDate(): ?\DateTimeInterface
    {
        return $this->sendDate;
    }

    public function setSendDate(?\DateTimeInterface $sendDate): self
    {
        $this->sendDate = $sendDate;

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
}
