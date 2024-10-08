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
$klant->setVoornaam('Guest 2');
$klant->setNaam('test');
$klant->setStraat('Lolstraat');
$klant->setNummer('21');
$klant->setPlaatsId(49);
$klant->setPhone('789654123');
$klant->setBemerkingen('');


$klantDAO = new KlantDAO;

//$klantId = $klantDAO->getKlantById(5);

$klantService = new KlantService;

$addGuest = $klantService->addNewGuest($klant);

print_r($addGuest);

//$getKlant = $klantDAO->getKlantByEmail('teste@oi.com.br');
//print_r($getKlant);

//
//if ($klant !== null) {
//    echo "Cliente encontrado:\n";
//    echo "ID: " . $klant->getPlaatsId() . "\n";
//    echo "Nome: " . $klant->getNaam() . "\n";
//    echo "Sobrenome: " . $klant->getVoornaam() . "\n";
//    echo "Rua: " . $klant->getStraat() . "\n";
//    echo "Número: " . $klant->getNummer() . "\n";
//    echo "Telefone: " . $klant->getPhone() . "\n";
//    echo "E-mail: " . $klant->getEmail() . "\n";
//    echo "Promo Eligible: " . ($klant->isPromoEligible() ? 'Sim' : 'Não') . "\n"; // Verifica se o cliente é elegível para promoção
//} else {
//    echo "Cliente não encontrado.\n";
//}
//