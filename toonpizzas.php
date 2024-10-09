<?php
//toonpizzas.php /

declare(strict_types=1);

spl_autoload_register();

use Business\PizzaService;
use Business\SessionService;
use Entities\Bestelling;

$pizzaService = new PizzaService();

$pizzas = $pizzaService->getAllPizzas();

$bestelling = SessionService::getBestelling();

$user = SessionService::getUser();


include("presentation/pizzalijst.php");
