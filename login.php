<?php
//login.php /

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;

$error = $_GET['error'] ?? '';

$bestelling = SessionService::getBestelling();

include("presentation/loginForm.php");
