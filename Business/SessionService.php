<?php
//Business/SessionService.php

namespace Business;

use Entities\User;
use Entities\Pizza;
use Entities\Bestellijn;
use Entities\Bestelling;
use Exceptions\BestellingException;

session_start();

class SessionService
{

    public static function addUser(User $user)
    {
        $_SESSION['user'] = serialize($user);
    }

    public static function getUser(): ?User
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
}
