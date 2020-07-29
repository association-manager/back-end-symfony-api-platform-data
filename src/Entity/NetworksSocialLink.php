<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NetworksSocialLinkRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NetworksSocialLinkRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET",
 *          "POST"
 *           },
 *      itemOperations={
 *          "GET", 
 *          "PUT",
 *          "DELETE"
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "network_social_link_read"
 *          }
 *      }
 * )
 */
class NetworksSocialLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "network_social_link_read", 
     *      "association_read", 
     *      "association_profile_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "network_social_link_read", 
     *      "association_read", 
     *      "association_profile_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "network_social_link_read", 
     *      "association_read", 
     *      "association_profile_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "network_social_link_read", 
     *      "association_read", 
     *      "association_profile_read", 
     *      "donation_read", 
     *      "staff_read"
     * })
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="networksSocialLinks")
     */
    private $association;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

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
