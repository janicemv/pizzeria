<?php
// accountController.php 

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;
use Business\SessionService;
use Exceptions\RegistrationException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step = $_POST['step'] ?? null;

    if ($step === 'account') {
        $klant = SessionService::getUser();

        if (!$klant) {
            header("Location: afrekenen.php");
            exit();
        }

        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $password2 = htmlspecialchars(trim($_POST['password2']));

        if ($password !== $password2) {
            $error = 'As senhas não correspondem!';
            header("Location: registerForm.php?error=" . urlencode($error));
            exit();
        }

        $klant->setEmail($email);
        $klant->setPassword(md5($password));

        $klantService = new KlantService();
        try {
            $klantId = $klantService->addNewKlant($klant);
            $klant->setId($klantId);

            SessionService::addUser($klant);
            header("Location: afrekenen.php");
            exit();
        } catch (RegistrationException $e) {
            $error = $e->getMessage();
            header("Location: registerForm.php?error=" . urlencode($error));
            exit();
        }
    }
}
