<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Account>
     */
    #[ORM\OneToMany(targetEntity: Account::class, mappedBy: 'transaction')]
    private Collection $account;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?\DateTime $transactionAt = null;

    public function __construct()
    {
        $this->account = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getAccount(): Collection
    {
        return $this->account;
    }

    public function addAccount(Account $account): static
    {
        if (!$this->account->contains($account)) {
            $this->account->add($account);
            $account->setTransaction($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): static
    {
        if ($this->account->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getTransaction() === $this) {
                $account->setTransaction(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function gettransactionAt(): ?\DateTime
    {
        return $this->transactionAt;
    }

    public function settransactionAt(\DateTime $transactionAt): static
    {
        $this->transactionAt = $transactionAt;

        return $this;
    }
}
