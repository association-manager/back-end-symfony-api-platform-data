<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FileManagerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FileManagerRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/fichiers/lister"},
 *          "POST"={"path"="/fichiers/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/fichier/{id}/afficher"},
 *          "PUT"={"path"="/fichier/{id}/modifier"},
 *          "DELETE"={"path"="/fichier/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "file_manager_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class FileManager
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "file_manager_read",
     *      "association_read",
     *      "announce_read",
     *      "association_profile_read",
     *      "user_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "file_manager_read",
     *      "association_read",
     *      "announce_read",
     *      "association_profile_read",
     *      "user_read"
     * })
     * @Assert\Type("string", message="Le format du type n'est pas valide")
     * @Assert\Length(
     *      max=45,
     *      maxMessage="Vous ne pouvez pas saisir plus de 45 caractères"
     * )
     * @Assert\NotBlank(message="Le type est obligatoire")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "file_manager_read",
     *      "association_read",
     *      "announce_read",
     *      "association_profile_read",
     *      "user_read"
     * })
     * @Assert\Type("string", message="Le format du texte n'est pas valide")
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Vous ne pouvez pas saisir plus de 255 caractères"
     * )
     * @Assert\NotBlank(message="Le texte est obligatoire")
     */
    private $text;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *      "file_manager_read",
     *      "association_read",
     *      "announce_read",
     *      "association_profile_read",
     *      "user_read"
     * })
     * @Assert\Type("string", message="Le format de l'url n'est pas valide")
     * @Assert\Url(
     *    relativeProtocol = true,
     *    protocols = {"http", "https"},
     *    message = "Cette url '{{ value }}' n'est pas valide"
     * )
     */
    private $url;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Type("integer", message="Le format du statut n'est pas valide")
     * @Assert\Length(
     *      max=6,
     *      maxMessage="Vous ne pouvez pas saisir plus de 6 caractères"
     * )
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fileManagers")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Groups({
     *      "file_manager_read",
     *      "association_read",
     *      "announce_read",
     *      "association_profile_read",
     *      "user_read"
     * })
     * @Assert\Type("string", message="Le format du nom n'est pas valide")
     * @Assert\Length(
     *      max=150,
     *      maxMessage="Vous ne pouvez pas saisir plus de 150 caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\Type("string", message="Le format de la taille n'est pas valide")
     * @Assert\Length(
     *      max=150,
     *      maxMessage="Vous ne pouvez pas saisir plus de 150 caractères"
     * )
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="fileManagers")
     * @Groups({
     *      "file_manager_read"
     * })
     */
    private $association;

    /**
     * Automatically assign the current date
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prePersist() {
        if(empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize($size): self
    {
        $this->size = $size;

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
