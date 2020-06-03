<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FileManagerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

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
 * )
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
     */
    private $url;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $s3key;

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
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $size;

    /**
     * @ORM\OneToMany(targetEntity=Announce::class, mappedBy="fileManager")
     * @Groups({
     *      "file_manager_read", 
     *      "association_read"
     * })
     */
    private $announces;

    public function __construct()
    {
        $this->announces = new ArrayCollection();
    }
    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="fileManagers")
     * @Groups({
     *      "file_manager_read"
     * })
     */
    private $association;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getS3key(): ?string
    {
        return $this->s3key;
    }

    public function setS3key(?string $s3key): self
    {
        $this->s3key = $s3key;

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

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection|Announce[]
     */
    public function getAnnounces(): Collection
    {
        return $this->announces;
    }

    public function addAnnounce(Announce $announce): self
    {
        if (!$this->announces->contains($announce)) {
            $this->announces[] = $announce;
            $announce->setFileManager($this);
        }

        return $this;
    }

    public function removeAnnounce(Announce $announce): self
    {
        if ($this->announces->contains($announce)) {
            $this->announces->removeElement($announce);
            // set the owning side to null (unless already changed)
            if ($announce->getFileManager() === $this) {
                $announce->setFileManager(null);
            }
        }
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
