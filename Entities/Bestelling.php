<?php
// Entities/Bestelling.php

namespace Entities;

class Bestelling
{
    private ?int $bestelId;
    private ?int $klantId;
    private ?string $datum;
    private string $deliveryAddress;
    private int $deliveryPlaatsId;
    private ?string $bemerkingen;
    private ?array $bestellijnen = [];
    private float $totaal = 0;

    public function __construct() {}

    public function getBestelId(): int
    {
        return $this->bestelId;
    }

    public function setBestelId(int $bestelId): void
    {
        $this->bestelId = $bestelId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
    }

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function getDate(): ?string
    {
        return $this->datum;
    }

    public function setDate(?string $datum): void
    {
        $this->datum = $datum;
    }

    public function setDeliveryAddress(string $address): void
    {
        $this->deliveryAddress = $address;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryPlaatsId(?int $plaatsId): void
    {
        $this->deliveryPlaatsId = $plaatsId;
    }

    public function getDeliveryPlaatsId(): ?int
    {
        return $this->deliveryPlaatsId;
    }

    public function setBemerkingen(?string $bemerkingen): void
    {
        $this->bemerkingen = $bemerkingen;
    }

    public function getBemerkingen(): ?string
    {
        return $this->bemerkingen;
    }

    public function addBestellijn(Bestellijn $bestellijn): void
    {
        $this->bestellijnen[] = $bestellijn;
        $this->calculateTotalPrice();
    }

    public function removeBestellijnByIndex(int $index): void
    {
        if (isset($this->bestellijnen[$index])) {
            unset($this->bestellijnen[$index]);
            $this->bestellijnen = array_values($this->bestellijnen); //reindexation
            $this->calculateTotalPrice();
        }
    }

    public function getBestellijnen(): array
    {
        return $this->bestellijnen;
    }

    private function calculateTotalPrice()
    {
        $total = 0;

        if (is_array($this->bestellijnen)) {
            foreach ($this->bestellijnen as $bestellijn) {
                $total += $bestellijn->getTotalPrijs();
            }
        }

        $this->totaal = $total;
    }

    public function getTotaal(): float
    {
        $this->calculateTotalPrice();
        return $this->totaal;
    }
}
