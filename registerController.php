<?php
// registerController.php 

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;
use Entities\Klant;
use Exceptions\RegistrationException;

// TO CHANGE

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = htmlspecialchars(trim($_POST['voornaam']));
    $naam = htmlspecialchars(trim($_POST['naam']));
    $straat = htmlspecialchars(trim($_POST['straat']));
    $nummer = htmlspecialchars(trim($_POST['nummer']));
    $plaatsId = (int)$_POST['plaatsId'];
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $bemerkingen = isset($_POST['bemerkingen']) ? htmlspecialchars(trim($_POST['bemerkingen'])) : null;

    // Validação de campos obrigatórios
    if (empty($voornaam) || empty($naam) || empty($straat) || empty($nummer) || empty($plaatsId) || empty($phone) || empty($email) || empty($password) || empty($password2)) {
        $error = 'Preencha todos os campos obrigatórios!';
    } elseif ($password !== $password2) {
        $error = 'As senhas não coincidem!';
    } else {
        $klant = new Klant();
        $klant->setVoornaam($voornaam);
        $klant->setNaam($naam);
        $klant->setStraat($straat);
        $klant->setNummer($nummer);
        $klant->setPlaatsId($plaatsId);
        $klant->setPhone($phone);
        $klant->setEmail($email);
        $klant->setPassword($password); // A senha será criptografada no DAO
        $klant->setBemerkingen($bemerkingen);

        $klantService = new KlantService();
        try {
            $klantId = $klantService->addNewKlant($klant);
            header("Location: success.php?id={$klantId}");
            exit();
        } catch (RegistrationException $e) {
            $error = $e->getMessage();
        }
    }
}

require_once 'presentation/registerForm.php';
