<?php

// updateAdres.php

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\SessionService;
use Business\PlaatService;
use Exceptions\AdresException;

$plaatService = new PlaatService;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $straat = htmlspecialchars(trim($_POST['delivery_straat']));
        $nummer = htmlspecialchars(trim($_POST['delivery_nummer']));
        $newPlaatsId = (int)$_POST['plaatsId'];

        if ($newPlaatsId <= 0) {
            throw new AdresException("Ongeldige plaats");
        }

        if (empty($straat) || empty($nummer) || empty($newPlaatsId)) {
            throw new AdresException("Adres velden moeten niet leeg zijn!");
        }

        $newAddress = $straat . " " . $nummer;

        $bestelling = SessionService::getBestelling();

        $bestelling->setDeliveryAddress($newAddress);
        $bestelling->setDeliveryPlaatsId($newPlaatsId);

        SessionService::addBestelling($bestelling);

        header("Location: afrekenen.php");
        exit();
    } catch (AdresException $e) {
        $error = urlencode($e->getMessage());
        header("Location: afrekenen.php?error=$error");
        exit();
    }
}
