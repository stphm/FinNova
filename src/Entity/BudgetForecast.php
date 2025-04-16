<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BudgetForecastRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetForecastRepository::class)]
#[ApiResource]
class BudgetForecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $month = null;

    #[ORM\Column]
    private ?float $forecastedIncome = null;

    #[ORM\ManyToOne(inversedBy: 'budgetForecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Account $account = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getForecastedIncome(): ?float
    {
        return $this->forecastedIncome;
    }

    public function setForecastedIncome(float $forecastedIncome): static
    {
        $this->forecastedIncome = $forecastedIncome;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): static
    {
        $this->account = $account;

        return $this;
    }
}
