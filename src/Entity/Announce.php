<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnnounceRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AnnounceRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/annonces/lister"},
 *          "POST"={"path"="/annonces/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/annonce/{id}/afficher"}, 
 *          "PUT"={"path"="/annonce/{id}/modifier"},
 *          "DELETE"={"path"="/annonce/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "announce_read"
 *          }
 *      },
 * )
 */
class Announce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "announce_read", 
     *      "file_manager_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({
     *      "announce_read"
     * })
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({
     *      "announce_read", 
     *      "file_manager_read"
     * })
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({
     *      "announce_read"
     * })
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *      "announce_read"
     * })
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *      "announce_read"
     * })
     */
    private $adUnitId;

    /**
     * @ORM\ManyToOne(targetEntity=FileManager::class, inversedBy="announces")
     * @Groups({
     *      "announce_read"
     * })
     */
    private $fileManager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAdUnitId(): ?string
    {
        return $this->adUnitId;
    }

    public function setAdUnitId(string $adUnitId): self
    {
        $this->adUnitId = $adUnitId;

        return $this;
    }

    public function getFileManager(): ?FileManager
    {
        return $this->fileManager;
    }

    public function setFileManager(?FileManager $fileManager): self
    {
        $this->fileManager = $fileManager;

        return $this;
    }
}
