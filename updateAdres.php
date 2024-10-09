<?php

// updateAdres.php

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\SessionService;
use Business\PlaatService;

$plaatService = new PlaatService;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newAddress = htmlspecialchars(trim($_POST['delivery_address']));
    $newPlaatsId = (int)$_POST['plaatsId'];

    if ($newPlaatsId <= 0) {
        header("Location: afrekenen.php?error=Invalid+plaats&plaats=$newPlaatsId");
        exit();
    }

    $bestelling = SessionService::getBestelling();

    $bestelling->setDeliveryAddress($newAddress);
    $bestelling->setDeliveryPlaatsId($newPlaatsId);

    SessionService::addBestelling($bestelling);

    header("Location: afrekenen.php");
    exit();
}
