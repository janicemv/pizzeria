<?php

// afrekenen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;

$user = SessionService::getUser();

if ($user !== null) {
    header('Location: checkout.php');
    exit;
} else {
    include("Presentation/loginOpties.php");
    exit;
}
