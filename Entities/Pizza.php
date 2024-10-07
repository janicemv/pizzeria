<?php
// Entities/Pizza.php

declare(strict_types=1);

namespace Entities;

class Pizza
{
    private int $pizzaId;
    private string $naam;
    private string $omschrijving;
    private float $prijs;
    private ?float $promoPrijs;
    private bool $beschikbaar;

    public function __construct(int $pizzaId, string $naam, string $omschrijving, float $prijs, ?float $promoPrijs, bool $beschikbaar)
    {
        $this->pizzaId = $pizzaId;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
        $this->promoPrijs = $promoPrijs;
        $this->beschikbaar = $beschikbaar;
    }

    public function getPizzaId(): int
    {
        return $this->pizzaId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }

    public function getPromoPrijs(): ?float
    {
        return $this->promoPrijs;
    }

    public function isBeschikbaar(): bool
    {
        return $this->beschikbaar;
    }
}
