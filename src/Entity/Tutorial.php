<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
 *          },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @UniqueEntity(
 *     fields={"title"},
 *     message="Ce titre {{ value }} est déjà utilisé."
 * )
 * @UniqueEntity(
 *     fields={"title", "description"},
 *     errorPath="description",
 *     message="Aucune modification, cette description existe déjà."
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
     * @Assert\Type("string", message="Le titre n'est pas conforme")
     * @Assert\NotBlank(message="Le titre est obligatoire")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Type("string", message="La description n'est pas conforme")
     * @Assert\Length(
     *      min=30, 
     *      minMessage="La description doit faire au minimum 30"
     * )
     * @Assert\NotBlank(message="La description est obligatoire")
     * @Assert\Regex(
     *     pattern="/^\w+/",
     *     match=true,
     *     message="Des caractères non autorisée dans la saisie"
     * )
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

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }
}
