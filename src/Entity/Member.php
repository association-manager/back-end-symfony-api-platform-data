<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $profile = [];

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?array
    {
        return $this->profile;
    }

    public function setProfile(?array $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
