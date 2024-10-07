<?php
// Entities/Bestellijn.php

namespace Entities;

class Bestellijn
{
    private int $lijnId;
    private int $bestelId;
    private Pizza $pizza;
    private float $prijs;

    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
        $this->prijs = $pizza->getPrijs();
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

    public function getPrijs(): float
    {
        return $this->prijs;
    }
}
