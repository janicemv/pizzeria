<?php
//login.php /

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;

$email = isset($_COOKIE['user_email']) ? htmlspecialchars($_COOKIE['user_email']) : '';

$error = $_GET['error'] ?? '';

$bestelling = SessionService::getBestelling();

include("presentation/loginForm.php");
