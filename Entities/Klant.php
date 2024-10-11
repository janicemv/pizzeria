<?php

//Entities/Klant.php

declare(strict_types=1);

namespace Entities;


class Klant
{
    private ?int $klantId;
    private string $naam;
    private string $voornaam;
    private string $straat;
    private string $nummer;
    private int $plaatsId;
    private string $phone;
    private ?string $email;
    private ?string $password;
    private bool $promo_eligible = false;
    private ?string $bemerkingen;
    private bool $guest;



    // Getters

    public function getId(): int
    {
        return $this->klantId;
    }
    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function getVollNaam(): string
    {
        return $this->naam . ", " . $this->voornaam;
    }

    public function getStraat(): string
    {
        return $this->straat;
    }

    public function getNummer(): string
    {
        return $this->nummer;
    }

    public function getAdres(): string
    {
        return $this->straat . " " . $this->nummer;
    }

    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function isPromoEligible(): bool
    {
        return $this->promo_eligible;
    }

    public function getBemerkingen(): ?string
    {
        return $this->bemerkingen;
    }

    public function getGuestStatus(): bool
    {
        return $this->guest;
    }

    // Setters

    public function setId(int $klantId): void
    {
        $this->klantId = $klantId;
    }
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function setVoornaam(string $voornaam): void
    {
        $this->voornaam = $voornaam;
    }

    public function setStraat(string $straat): void
    {
        $this->straat = $straat;
    }

    public function setNummer(string $nummer): void
    {
        $this->nummer = $nummer;
    }

    public function setPlaatsId(int $plaatsId): void
    {
        $this->plaatsId = $plaatsId;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setPromoEligible(bool $promo_eligible): void
    {
        $this->promo_eligible = $promo_eligible;
    }

    public function setBemerkingen(?string $bemerkingen): void
    {
        $this->bemerkingen = $bemerkingen;
    }

    public function setGuestStatus(bool $guest): void
    {
        $this->guest = $guest;
    }
}
