<?php
// beslissenController.php 

declare(strict_types=1);

session_start();

spl_autoload_register();

use Exceptions\RegistrationException;
use Exceptions\BestellingException;
use Business\SessionService;
use Business\KlantService;
use Business\BestelService;

$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();

$klantService = new KlantService();
$bestelService = new BestelService();

try {
    $bestelId = $bestelService->bestelFromGuest($user, $date, $bestelling);

    SessionService::addUser($klant);

    header("Location: confirmation.php");
    exit();
} catch (RegistrationException $e) {
    $error = $e->getMessage();
    header("Location: afrekenen.php?error=" . urlencode($error));
    exit();
}
