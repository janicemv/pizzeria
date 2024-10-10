<?php
//Business/SessionService.php

namespace Business;

use Entities\Klant;
use Entities\Pizza;
use Entities\Bestellijn;
use Entities\Bestelling;
use Exceptions\BestellingException;

session_start();

class SessionService
{

    public static function addUser(Klant $klant)
    {
        $_SESSION['user'] = serialize($klant);
    }

    public static function getUser(): ?Klant
    {
        return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
    }

    public static function addBestelling(Bestelling $bestelling)
    {
        $_SESSION['bestelling'] = serialize($bestelling);
    }

    public static function getBestelling(): ?Bestelling
    {
        return isset($_SESSION['bestelling']) ? unserialize($_SESSION['bestelling']) : null;
    }

    public static function removeBestelling(): void
    {
        unset($_SESSION['bestelling']);
    }

    public static function removeUser(): void
    {
        unset($_SESSION['user']);
    }

    public static function logout(): void
    {
        session_destroy();
    }
}
