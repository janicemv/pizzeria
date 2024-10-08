<?php

// afrekenen.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;

$user = SessionService::getUser();

$bestelling = SessionService::getBestelling();


if ($user !== null) {
    print_r($user);
    print_r($bestelling);
} else {
    include("Presentation/loginOpties.php");
    exit;
}
