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

            $email = strtolower(htmlspecialchars(trim($_POST['email'])));
            $password = htmlspecialchars(trim($_POST['password']));
            $password2 = htmlspecialchars(trim($_POST['password2']));

            if (empty($email) || empty($password) || empty($password2)) {
                throw new RegistrationException('Vul alle verplichte velden in!');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new RegistrationException("Ongelidg email adres!");
            }

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
            $error = urlencode($e->getMessage());
            header("Location: account.php?error=" . $error);
        }
    }
}

include("Presentation/registerForm.php");
exit();
