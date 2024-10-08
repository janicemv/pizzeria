<?php
// loginController.php /

declare(strict_types=1);

session_start();

spl_autoload_register();

use Exceptions\LoginException;
use Business\KlantService;
use Business\SessionService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            throw new LoginException('E-mail en/of wachtwoord mag niet leeg zijn!');
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userService = new KlantService();

            if ($userService->checkLogin($email, $password)) {
                $user = $userService->findKlantByEmail($email);
                SessionService::addUser($user);

                $_SESSION['loggedin'] = true;

                header("Location: afrekenen.php");
                exit(0);
            } else {
                throw new LoginException('E-mail bestaat niet of het wachtwoord is onjuist!');
            }
        } else {
            throw new LoginException('Ongeldig e-mailadres!');
        }
    } catch (LoginException $e) {
        $error = urlencode($e->getMessage());
        header("Location: login.php?error=$error");
        exit(0);
    }
}
