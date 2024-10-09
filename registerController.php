<?php
// registerController.php 

declare(strict_types=1);

spl_autoload_register();

use Business\KlantService;
use Entities\Klant;
use Exceptions\RegistrationException;
use Business\SessionService;

$bestelling = SessionService::getBestelling();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step = $_POST['step'] ?? null;

    $voornaam = htmlspecialchars(trim($_POST['voornaam']));
    $naam = htmlspecialchars(trim($_POST['naam']));
    $straat = htmlspecialchars(trim($_POST['straat']));
    $nummer = htmlspecialchars(trim($_POST['nummer']));
    $plaatsId = (int)$_POST['plaatsId'];
    $phone = htmlspecialchars(trim($_POST['phone']));
    $bemerkingen = isset($_POST['bemerkingen']) ? htmlspecialchars(trim($_POST['bemerkingen'])) : null;

    if (empty($voornaam) || empty($naam) || empty($straat) || empty($nummer) || empty($plaatsId) || empty($phone)) {
        $error = 'Vul alle verplichte velden in!';
        header("Location: klantGegevens.php?error=" . urlencode($error));
    } else {
        $klant = new Klant();
        $klant->setVoornaam($voornaam);
        $klant->setNaam($naam);
        $klant->setStraat($straat);
        $klant->setNummer($nummer);
        $klant->setPlaatsId($plaatsId);
        $klant->setPhone($phone);
        $klant->setBemerkingen($bemerkingen);

        $bestelling->setDeliveryAddress($straat . " " . $nummer);
        $bestelling->setDeliveryPlaatsId($plaatsId);

        SessionService::addBestelling($bestelling);

        SessionService::addUser($klant);

        if ($step === 'basic') {

            $klant->setGuestStatus(true);
            $klant->setId(0);

            SessionService::addUser($klant);

            header("Location: afrekenen.php");
            exit();
        } else if ($step === 'account') {
            header("Location: account.php");
            exit();
        }
    }
}
