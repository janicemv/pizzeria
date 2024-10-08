<?php
//registration.php /

declare(strict_types=1);

spl_autoload_register();

use Business\PlaatService;
use Business\SessionService;

$error = $_GET['error'] ?? '';

$plaatService = new PlaatService;

$plaatsen = $plaatService->getAllPlaatsen();

$bestelling = SessionService::getBestelling();

include("presentation/klantGegevens.php");
