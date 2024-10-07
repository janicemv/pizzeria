<?php

//Data/PizzaDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Pizza;

class PizzaDAO
{
    public function getPizzas(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT pizzaId, naam, omschrijving, prijs, promo_prijs, beschikbaar FROM pizzas ORDER BY naam";
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $pizza = new Pizza((int) $rij["pizzaId"], $rij["naam"], $rij["omschrijving"], (float) $rij["prijs"], (float) $rij["promo_prijs"], (bool) $rij["beschikbaar"]);
            array_push($lijst, $pizza);
        }

        $dbh = null;
        return $lijst;
    }

    public function getPizzaById(int $pizzaId): Pizza
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT pizzaId, naam, omschrijving, prijs, promo_prijs, beschikbaar FROM pizzas WHERE pizzaId = :pizzaId";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':pizzaId' => $pizzaId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $pizza = new Pizza((int) $rij["pizzaId"], $rij["naam"], $rij["omschrijving"], (float) $rij["prijs"], (float) $rij["promo_prijs"], (bool) $rij["beschikbaar"]);

        $dbh = null;

        return $pizza;
    }
}
