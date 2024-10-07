<?php
// cartController.php

declare(strict_types=1);


spl_autoload_register();

use Business\PizzaService;
use Business\SessionService;
use Entities\Bestelling;
use Entities\Bestellijn;

$user = SessionService::getUser();

$currentTime = new DateTime();
$formattedDate = $currentTime->format('Y-m-d H:i:s');

if (isset($_GET['pizzaId'])) {
    $pizzaId = (int)$_GET['pizzaId'];

    $pizzaService = new PizzaService();
    $pizza = $pizzaService->getPizza($pizzaId);

    $bestelling = SessionService::getBestelling();

    if ($bestelling === null) {
        $bestelling = new Bestelling();
    }

    if ($pizza) {

        $bestellijn = new Bestellijn($pizza);
        $bestelling->addBestellijn($bestellijn);

        SessionService::addBestelling($bestelling);

        header('Location: index.php');
        exit;
    }
}
