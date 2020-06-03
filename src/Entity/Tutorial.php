<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/tutoriels/lister"},
 *          "POST"={"path"="/tutoriels/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/tutoriel/{id}/afficher"}, 
 *          "PUT"={"path"="/tutoriel/{id}/modifier"},
 *          "DELETE"={"path"="/tutoriel/{id}/supprimer"}
 *          }
 * )
 */
class Tutorial
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
}
