<?php

// confirmation.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\PlaatService;
use Business\BestelService;

$error = $_GET['error'] ?? '';

$bestelId = $_GET['bestelId'];

$user = SessionService::getUser();

$bestelService = new BestelService;

$bestelling = $bestelService->showBestelling($bestelId);

$plaatService = new PlaatService;

$deliveryPlaats = $plaatService->findPlaatsById($bestelling->getDeliveryPlaatsId());

include("Presentation/bestelling.php");
