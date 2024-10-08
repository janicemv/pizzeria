<?php
//account.php /

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;

$error = $_GET['error'] ?? '';

$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();


include("presentation/registerForm.php");
