<?php
// Entities/Plaats.php

declare(strict_types=1);

namespace Entities;

class Plaats
{
    private int $plaatsId;
    private int $code;
    private string $gemeente;

    public function __construct(int $plaatsId, int $code, string $gemeente)
    {
        $this->plaatsId = $plaatsId;
        $this->code = $code;
        $this->gemeente = $gemeente;
    }

    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getGemeente(): string
    {
        return $this->gemeente;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setGemeente(string $gemeente): void
    {
        $this->gemeente = $gemeente;
    }
}
