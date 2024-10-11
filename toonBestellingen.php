<?php

// toonBestellingen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\PlaatService;
use Business\BestelService;
use Business\KlantService;

$error = $_GET['error'] ?? '';

$user = SessionService::getUser();

$bestelService = new BestelService;

$bestellingen = $bestelService->getAllOrders();

$plaatService = new PlaatService;

$klantService = new KlantService;

include("Presentation/allBestellingen.php");
