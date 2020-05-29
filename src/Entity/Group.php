<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=association::class, inversedBy="groups")
     */
    private $assocationId;

    public function __construct()
    {
        $this->assocationId = new ArrayCollection();
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

    /**
     * @return Collection|association[]
     */
    public function getAssocationId(): Collection
    {
        return $this->assocationId;
    }

    public function addAssocationId(association $assocationId): self
    {
        if (!$this->assocationId->contains($assocationId)) {
            $this->assocationId[] = $assocationId;
        }

        return $this;
    }

    public function removeAssocationId(association $assocationId): self
    {
        if ($this->assocationId->contains($assocationId)) {
            $this->assocationId->removeElement($assocationId);
        }

        return $this;
    }
}
