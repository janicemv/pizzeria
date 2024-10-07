<?php

declare(strict_types=1);

spl_autoload_register();

use Business\KlantService;
use Business\PizzaService;
use Business\PlaatService;
use Data\KlantDAO;
use Data\PizzaDAO;
use Data\PlaatsDAO;
use Entities\Pizza;
use Entities\Klant;

$pizzaDAO = new PizzaDAO;

$pizzaService = new PizzaService;

$pizzas = $pizzaService->getAllPizzas();

$pizzaId = $pizzaService->getPizza(2);

$plaatsDAO = new PlaatsDAO;

$plaatService = new PlaatService;

$plaatsen = $plaatService->getAllPlaatsen();

$klant = new Klant();
$klant->setVoornaam('Teste');
$klant->setNaam('3');
$klant->setStraat('Lolstraat');
$klant->setNummer('42');
$klant->setPlaatsId(38);
$klant->setPhone('789654123');
$klant->setEmail('teste@oi.com.br');
$klant->setPassword('123456');
$klant->setBemerkingen('oi');

$klantDAO = new KlantDAO;


$klantService = new KlantService;

//$janice = $klantService->addNewKlant($klant);

//print_r($klant);

$getKlant = $klantDAO->getKlantByEmail('teste@oi.com.br');

if ($klant !== null) {
    echo "Cliente encontrado:\n";
    echo "ID: " . $klant->getPlaatsId() . "\n";
    echo "Nome: " . $klant->getNaam() . "\n";
    echo "Sobrenome: " . $klant->getVoornaam() . "\n";
    echo "Rua: " . $klant->getStraat() . "\n";
    echo "Número: " . $klant->getNummer() . "\n";
    echo "Telefone: " . $klant->getPhone() . "\n";
    echo "E-mail: " . $klant->getEmail() . "\n";
    echo "Promo Eligible: " . ($klant->isPromoEligible() ? 'Sim' : 'Não') . "\n"; // Verifica se o cliente é elegível para promoção
} else {
    echo "Cliente não encontrado.\n";
}
