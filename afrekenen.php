<?php
// afrekenen.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;
use Business\PlaatService;

$error = $_GET['error'] ?? '';

$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();

if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
}


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    if (!isset($_COOKIE['email'])) {
        include("Presentation/loginOpties.php");
        exit();
    } else {
        header("Location: login.php?email=" . urlencode($_COOKIE['email']));
        exit();
    }
}


if ($user === null) {
    include("Presentation/loginOpties.php");
    exit();
} else {

    $deliveryAdres = $bestelling->getDeliveryAddress() ?? $user->getAdres();
    $deliveryPlaatsId = $bestelling->getDeliveryPlaatsId() ?? $user->getPlaatsId();

    $plaatService = new PlaatService();
    $plaatsLijst = $plaatService->getAllPlaatsen();
    $deliveryPlaats = $plaatService->findPlaatsById($deliveryPlaatsId);

    include("Presentation/checkout.php");
    exit();
}
