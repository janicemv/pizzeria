<?php
// Entities/Bestelling.php

namespace Entities;

class Bestelling
{
    private ?int $bestelId;
    private ?int $klantId;
    private ?string $datum;
    private ?string $deliveryAddress;
    private int $deliveryPlaatsId;
    private ?string $bemerkingen;
    private ?array $bestellijnen = [];
    private float $totaal = 0;
    private int $status;

    public function __construct() {}

    // Getters
    public function getBestelId(): int
    {
        return $this->bestelId;
    }

    public function getKlantId(): ?int
    {
        return $this->klantId;
    }

    public function getDate(): ?string
    {
        return $this->datum;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function getDeliveryPlaatsId(): ?int
    {
        return $this->deliveryPlaatsId;
    }

    public function getBemerkingen(): ?string
    {
        return $this->bemerkingen;
    }

    public function getBestellijnen(): array
    {
        return $this->bestellijnen;
    }

    public function getTotaal(): float
    {
        $this->calculateTotalPrice();
        return $this->totaal;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    // Setters
    public function setBestelId(int $bestelId): void
    {
        $this->bestelId = $bestelId;
    }

    public function setKlantId(?int $klantId): void
    {
        $this->klantId = $klantId;
    }

    public function setDate(?string $datum): void
    {
        $this->datum = $datum;
    }

    public function setDeliveryAddress(string $address): void
    {
        $this->deliveryAddress = $address;
    }

    public function setDeliveryPlaatsId(?int $plaatsId): void
    {
        $this->deliveryPlaatsId = $plaatsId;
    }

    public function setBemerkingen(?string $bemerkingen): void
    {
        $this->bemerkingen = $bemerkingen;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
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
            $this->bestellijnen = array_values($this->bestellijnen); // reindexação
            $this->calculateTotalPrice();
        }
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
}
