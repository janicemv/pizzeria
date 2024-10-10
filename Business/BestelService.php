<?php
// Business/BestelService.php

declare(strict_types=1);

namespace Business;

use Entities\Bestelling;
use Entities\Klant;
use Data\BestellingDAO;
use Business\KlantService;
use Exceptions\BestellingException;

class BestelService
{

    public function bestelFromGuest(Klant $klant, Bestelling $bestelling)
    {
        $bestelDAO = new BestellingDAO;

        return $bestelDAO->saveFromGuest($klant, $bestelling);
    }

    public function confirmOrder($klantId, Bestelling $bestelling)
    {
        $bestelDAO = new BestellingDAO;

        return $bestelDAO->saveBestelling($klantId, $bestelling);
    }

    public function showBestelling($bestelId)
    {
        $bestelDAO = new BestellingDAO;

        return $bestelDAO->getBestellingById($bestelId);
    }

    public function getAllOrders()
    {
        $bestelDAO = new BestellingDAO;

        return $bestelDAO->getBestellingen();
    }
}
