<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AssociationProfileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AssociationProfileRepository::class)
 */
class AssociationProfile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $descriptionTitle;

    /**
     * @ORM\OneToOne(targetEntity=Association::class, mappedBy="associationProfile", cascade={"persist", "remove"})
     */
    private $association;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionTitle(): ?string
    {
        return $this->descriptionTitle;
    }

    public function setDescriptionTitle(string $descriptionTitle): self
    {
        $this->descriptionTitle = $descriptionTitle;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        // set (or unset) the owning side of the relation if necessary
        $newAssociationProfile = null === $association ? null : $this;
        if ($association->getAssociationProfile() !== $newAssociationProfile) {
            $association->setAssociationProfile($newAssociationProfile);
        }

        return $this;
    }
}
