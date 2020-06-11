<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AssoManagerEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AssoManagerEventRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/evenements/lister"},
 *          "POST"={"path"="/evenements/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/evenement/{id}/afficher"}, 
 *          "PUT"={"path"="/evenement/{id}/modifier"},
 *          "DELETE"={"path"="/evenement/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "asso_manager_event_read"
 *          }
 *      }
 * )
 */
class AssoManagerEvent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "asso_manager_event_read", 
     *      "planning_read", 
     *      "category_read",
     *      "associations_plannings_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "asso_manager_event_read", 
     *      "planning_read", 
     *      "category_read",
     *      "associations_plannings_subresource"
     * })
     * @Assert\Length(
     *  min = 2,
     *  max = 45,
     *  minMessage = "Votre titre doit être superieur à {{ limit }} caractères",
     *  maxMessage = "Votre titre doit être inferieur à {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "asso_manager_event_read", 
     *      "planning_read",
     *      "associations_plannings_subresource"
     * })
     * @Assert\DateTime
     * @var string A "J/m/Y H:i:s" formatted value
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "asso_manager_event_read", 
     *      "planning_read",
     *      "associations_plannings_subresource"
     * })
     * @Assert\DateTime
     * @var string A "J/m/Y H:i:s" formatted value
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity=Planning::class, inversedBy="assoManagerEvents")
     * @Groups({
     *      "asso_manager_event_read"
     * })
     */
    private $planning;

    public function __construct()
    {
        $this->planning = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlanning(): Collection
    {
        return $this->planning;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->planning->contains($planning)) {
            $this->planning[] = $planning;
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->planning->contains($planning)) {
            $this->planning->removeElement($planning);
        }

        return $this;
    }
}
