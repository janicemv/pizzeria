<?php

// confirmation.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;
use Business\PlaatService;
use Business\BestelService;
use Business\KlantService;

$user = SessionService::getUser();

$error = $_GET['error'] ?? '';

$bestelId = $_GET['bestelId'];

$bestelService = new BestelService;

$bestelling = $bestelService->showBestelling($bestelId);

$klantService = new KlantService;

$klant = $klantService->findKlantById($bestelling->getKlantId());

$plaatService = new PlaatService;

$deliveryPlaats = $plaatService->findPlaatsById($bestelling->getDeliveryPlaatsId());

include("Presentation/bestelling.php");
