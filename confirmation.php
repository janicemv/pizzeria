<?php

// afrekenen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\PlaatService;

$error = $_GET['error'] ?? '';

$bestelId = $_GET['bestelId'];

$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();

$plaatService = new PlaatService;

//$deliveryPlaats = $plaatService->findPlaatsById($bestelling->getDeliveryPlaatsId());

var_dump($bestelling);


//include("Presentation/bestelling.php");
