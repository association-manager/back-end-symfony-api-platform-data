<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductWebsiteRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductWebsiteRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/produits/site/vitrine/lister"},
 *          "POST"={"path"="/produits/site/vitrine/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/produit/site/vitrine/{id}/afficher"},
 *          "PUT"={"path"="/produit/site/vitrine/{id}/modifier"},
 *          "DELETE"={"path"="/produit/site/vitrine/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "product_read"
 *          }
 *      }
 * )
 */
class ProductWebsite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "product_read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "product_read"
     * })
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *      "product_read"
     * })
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "product_read"
     * })
     */
    private $logo;

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
