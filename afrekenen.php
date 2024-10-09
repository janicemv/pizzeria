<?php

// afrekenen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\PlaatService;

$error = $_GET['error'] ?? '';

$user = SessionService::getUser();


if ($user !== null) {

    $bestelling = SessionService::getBestelling();

    $deliveryAdres = $bestelling->getDeliveryAddress();
    $deliveryPlaatsId = $bestelling->getDeliveryPlaatsId();

    if ($deliveryAdres === null) {
        $deliveryAdres = $user->getAdres();
    } else {
        $deliveryAdres = $bestelling->getDeliveryAddress();
    }

    if ($deliveryPlaatsId === null) {
        $deliveryPlaatsId = $user->getPlaatsId();
    } else {
        $deliveryPlaatsId = $bestelling->getDeliveryPlaatsId();
    }

    $plaatService = new PlaatService;
    $plaatsLijst = $plaatService->getAllPlaatsen();

    $deliveryPlaats = $plaatService->findPlaatsById($deliveryPlaatsId);

    include("Presentation/checkout.php");
    exit;
} else {
    include("Presentation/loginOpties.php");
    exit;
}
