<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/categories/lister"},
 *          "POST"={"path"="/categories/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/categorie/{id}/afficher"}, 
 *          "PUT"={"path"="/categorie/{id}/modifier"},
 *          "DELETE"={"path"="/categorie/{id}/supprimer"}
 *          },
 *      normalizationContext={
 *          "groups"={
 *              "category_read"
 *          }
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * 
 * )
 * @UniqueEntity(
 *     fields={"name", "type"},
 *     errorPath="type",
 *     message="Aucune modification, ce type existe déjà pour cette cétagorie."
 * )
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "category_read", 
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "transaction_read",
     *      "projects_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "category_read", 
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "transaction_read",
     *      "projects_subresource"
     * })
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Type("string", message="Le nom de la catégorie n'est pas conforme")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "category_read", 
     *      "planning_read", 
     *      "project_read", 
     *      "work_group_read", 
     *      "association_read", 
     *      "transaction_read",
     *      "projects_subresource"
     * })
     * @Assert\NotBlank(message="Le type est obligatoire")
     * @Assert\Type("string", message="Le type catégorie n'est pas conforme")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="category")
     * @Groups({
     *      "category_read"
     * })
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=Planning::class, mappedBy="category")
     * @Groups({
     *      "category_read"
     * })
     */
    private $plannings;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->plannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setCategory($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getCategory() === $this) {
                $transaction->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setCategory($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->contains($planning)) {
            $this->plannings->removeElement($planning);
            // set the owning side to null (unless already changed)
            if ($planning->getCategory() === $this) {
                $planning->setCategory(null);
            }
        }

        return $this;
    }
}
