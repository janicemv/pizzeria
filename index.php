<?php
// index.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;

if (isset($_SESSION['email'])) {
    setcookie("user_email", $_SESSION['email'], time() + (30 * 24 * 60 * 60), "/"); // 30 dagen cookie
}

include("toonpizzas.php");
