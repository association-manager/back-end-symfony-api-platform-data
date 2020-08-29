<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AssociationProfileRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AssociationProfileRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/associations/profils/lister"},
 *          "POST"={"path"="/associations/profils/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/association/profil/{id}/afficher"}, 
 *          "PUT"={"path"="/association/profil/{id}/modifier"},
 *          "DELETE"={"path"="/association/profil/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "association_profile_read"
 *          }
 *      }
 * )
 */
class AssociationProfile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "association_profile_read", 
     *      "association_read", 
     *      "address_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "association_profile_read", 
     *      "association_read", 
     *      "address_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({
     *      "association_profile_read", 
     *      "association_read", 
     *      "address_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "association_profile_read", 
     *      "association_read", 
     *      "address_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $descriptionTitle;

    /**
     * @ORM\OneToOne(targetEntity=Association::class, mappedBy="associationProfile", cascade={"persist", "remove"})
     * @Groups({
     *      "association_profile_read"
     * })
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
