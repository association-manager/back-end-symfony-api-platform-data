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
     * @ORM\OneToOne(targetEntity=FileManager::class, inversedBy="mainImage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "product_read"
     * })
     */
    private $mainImage;

    /**
     * @ORM\OneToOne(targetEntity=FileManager::class, inversedBy="mainImageThumbnail", cascade={"persist", "remove"})
     * @Groups({
     *      "product_read"
     * })
     */
    private $mainImageThumbnail;

    /**
     * @ORM\OneToMany(targetEntity=FileManager::class, mappedBy="productImages")
     * @Groups({
     *      "product_read"
     * })
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    public function getMainImage(): ?FileManager
    {
        return $this->mainImage;
    }

    public function setMainImage(FileManager $mainImage): self
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function getMainImageThumbnail(): ?FileManager
    {
        return $this->mainImageThumbnail;
    }

    public function setMainImageThumbnail(?FileManager $mainImageThumbnail): self
    {
        $this->mainImageThumbnail = $mainImageThumbnail;

        return $this;
    }

    /**
     * @return Collection|FileManager[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(FileManager $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProductImages($this);
        }

        return $this;
    }

    public function removeImage(FileManager $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProductImages() === $this) {
                $image->setProductImages(null);
            }
        }

        return $this;
    }
}
