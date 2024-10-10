<?php
// accountController.php 

declare(strict_types=1);


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

        try {

            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $password2 = htmlspecialchars(trim($_POST['password2']));

            if ($password !== $password2) {
                throw new RegistrationException("Wachtwoorden zijn niet gelijk!");
            }

            $klant->setEmail($email);
            $klant->setPassword(md5($password));

            $klantService = new KlantService();

            $klantId = $klantService->addNewKlant($klant);
            $klant->setId($klantId);

            SessionService::addUser($klant);

            $_SESSION['loggedin'] = true;

            setcookie('email', $email, time() + (86400 * 30), "/");

            header("Location: afrekenen.php");
            exit();
        } catch (RegistrationException $e) {
            $error = $e->getMessage();
        }
    }
}

include("Presentation/registerForm.php");
exit();
