<?php
// bevestigenController.php 

declare(strict_types=1);

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

$currentTime = new DateTime();
$date = $currentTime->format('Y-m-d H:i:s');

$bestelling->setDate($date);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bestelBemerkingen = isset($_POST['bemerkingen']) ? htmlspecialchars(trim($_POST['bemerkingen'])) : null;

    $bestelling->setBemerkingen($bestelBemerkingen);

    SessionService::addBestelling($bestelling);


    if ($user->getId() === 0) {

        try {
            $klantId = $klantService->addNewGuest($user);

            $user->setId($klantId);

            SessionService::addUser($user);

            $bestelId = $bestelService->confirmOrder($klantId, $bestelling);

            SessionService::removeBestelling();
            SessionService::removeUser();
            $_SESSION['loggedin'] = false;

            header("Location: confirmation.php?bestelId=$bestelId");
            exit();
        } catch (BestellingException $e) {
            $error = $e->getMessage();
            header("Location: afrekenen.php?error=" . urlencode($error));
            exit();
        }
    } else {
        $klantId = $user->getId();

        try {
            $bestelId = $bestelService->confirmOrder($klantId, $bestelling);

            SessionService::removeBestelling();

            header("Location: confirmation.php?bestelId=$bestelId");
            exit();
        } catch (BestellingException $e) {
            $error = $e->getMessage();
            header("Location: afrekenen.php?error=" . urlencode($error));
            exit();
        }
    }
}
