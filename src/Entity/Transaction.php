<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransactionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "GET"={"path"="/transactions/lister"},
 *          "POST"={"path"="/transactions/creer"}
 *           },
 *      itemOperations={
 *          "GET"={"path"="/transaction/{id}/afficher"}, 
 *          "PUT"={"path"="/transaction/{id}/modifier"},
 *          "DELETE"={"path"="/transaction/{id}/supprimer"}
 *          },
 *      subresourceOperations={
 *          "api_associations_transactions_get_subresource"={
 *          "normalization_context"={"groups"={"associations_transactions_subresource"}}
 *          } 
 *      }, 
 *      normalizationContext={
 *          "groups"={
 *              "transaction_read"
 *          }
 *      },
 * )
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $details;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4)
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({
     *      "transaction_read", 
     *      "association_read", 
     *      "category_read",
     *      "associations_transactions_subresource"
     * })
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="transactions")
     * @Groups({
     *  "transaction_read", 
     *  "category_read"
     * })
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *  "transaction_read", 
     *  "association_read"
     * })
     */
    private $category;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
