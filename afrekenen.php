<?php

// afrekenen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\PlaatService;


$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();


if ($user !== null) {
    $plaatService = new PlaatService;

    $plaats = $plaatService->findPlaatsById($user->getPlaatsId());

    include("Presentation/checkout.php");
    exit;
} else {
    include("Presentation/loginOpties.php");
    exit;
}
