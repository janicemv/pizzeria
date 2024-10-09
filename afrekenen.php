<?php
// afrekenen.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;
use Business\PlaatService;
use Exceptions\AdresException;

$error = $_GET['error'] ?? '';

$user = SessionService::getUser();
$bestelling = SessionService::getBestelling();

if ($bestelling === null) {
    header("Location: index.php");
    exit();
}

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
    try {
        $deliveryAdres = $bestelling->getDeliveryAddress() ?? $user->getAdres();
        $deliveryPlaatsId = $bestelling->getDeliveryPlaatsId() ?? $user->getPlaatsId();

        $plaatService = new PlaatService();
        $plaatsLijst = $plaatService->getAllPlaatsen();
        $deliveryPlaats = $plaatService->findPlaatsById($deliveryPlaatsId);

        // Verificação de entrega
        if ($deliveryPlaats->getBezorging() === false) {
            throw new AdresException("Dit afleveradres kan niet worden gebruikt. Selecteer alstublieft een ander adres.");
        }
        include("Presentation/checkout.php");
        exit();
    } catch (AdresException $e) {
        $error = "Adres fout: " . htmlspecialchars($e->getMessage());
        include("Presentation/checkout.php");
        exit();
    }
}
