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

if (isset($_GET['pizzaId']) && isset($_GET['quantity'])) {
    $pizzaId = (int)$_GET['pizzaId'];
    $quantity = (int)$_GET['quantity'];

    $pizzaService = new PizzaService();
    $pizza = $pizzaService->getPizza($pizzaId);

    $bestelling = SessionService::getBestelling();

    if ($bestelling === null) {
        $bestelling = new Bestelling();

        if (isset($user)) {
            $bestelling->setDeliveryAddress($user->getStraat() . " " . $user->getNummer());
            $bestelling->setDeliveryPlaatsId($user->getPlaatsId());
            SessionService::addBestelling($bestelling);
        }
    }

    if ($pizza) {
        $bestellijnen = $bestelling->getBestellijnen();
        $found = false;

        foreach ($bestellijnen as $bestellijn) {
            if ($bestellijn->getPizza()->getPizzaId() === $pizzaId) {
                $bestellijn->setQuantity($quantity);
                $found = true;
                break;
            }
        }

        if (!$found) {
            $promoEligible = isset($user) && $user->isPromoEligible();
            $bestellijn = new Bestellijn($pizza, $quantity, $promoEligible);
            $bestelling->addBestellijn($bestellijn);
        }

        SessionService::addBestelling($bestelling);
    }

    header('Location: index.php');
    exit;
}

if (isset($_GET['removeIndex'])) {
    $removeIndex = (int)$_GET['removeIndex'];

    $bestelling = SessionService::getBestelling();

    if ($bestelling !== null) {
        $bestelling->removeBestellijnByIndex($removeIndex);
        SessionService::addBestelling($bestelling);
    }

    header('Location: index.php');
    exit;
}

header('Location: index.php');
exit;
