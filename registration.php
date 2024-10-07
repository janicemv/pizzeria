<?php
//registration.php /

declare(strict_types=1);

spl_autoload_register();

use Business\PlaatService;

$error = $_GET['error'] ?? '';

$plaatService = new PlaatService;

$plaatsen = $plaatService->getAllPlaatsen();

include("presentation/registerForm.php");
