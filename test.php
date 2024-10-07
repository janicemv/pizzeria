<?php

declare(strict_types=1);

spl_autoload_register();

use Business\PizzaService;
use Data\PizzaDAO;
use Entities\Pizza;

$pizzaDAO = new PizzaDAO;

$pizzaService = new PizzaService;

$pizzas = $pizzaService->getAllPizzas();

$pizzaId = $pizzaService->getPizza(2);

print_r($pizzaId);
