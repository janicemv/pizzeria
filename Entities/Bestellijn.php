<?php
// Entities/Bestellijn.php

namespace Entities;

class Bestellijn
{
    private int $lijnId;
    private int $bestelId;
    private Pizza $pizza;
    private int $hoeveel;
    private float $prijs;

    public function __construct(Pizza $pizza, int $hoeveel, bool $promoEligible = false)
    {
        $this->pizza = $pizza;
        $this->prijs = $promoEligible && $pizza->getPromoPrijs() !== null ? $pizza->getPromoPrijs() : $pizza->getPrijs();
        $this->hoeveel = $hoeveel;
    }

    // Getters e Setters

    public function getLijnId(): int
    {
        return $this->lijnId;
    }

    public function getBestelId(): int
    {
        return $this->bestelId;
    }

    public function setBestelId(int $bestelId): void
    {
        $this->bestelId = $bestelId;
    }

    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

    public function getQuantity(): int
    {
        return $this->hoeveel;
    }

    public function setQuantity(int $hoeveel): void
    {
        $this->hoeveel = $hoeveel;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }

    public function getTotalPrijs(): float
    {
        return $this->prijs * $this->hoeveel;
    }
}
