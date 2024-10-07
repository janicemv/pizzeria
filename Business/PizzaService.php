<?php

//Business/PizzaService.php

declare(strict_types=1);

namespace Business;

use Data\PizzaDAO;

class PizzaService
{
    public function getAllPizzas(): array
    {
        $pizzaDAO = new PizzaDAO();
        return $pizzaDAO->getPizzas();
    }

    public function getPizza($pizzaId)
    {
        $pizzaDAO = new PizzaDAO();
        return $pizzaDAO->getPizzaById($pizzaId);
    }
}
