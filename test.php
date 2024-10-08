<?php

declare(strict_types=1);

spl_autoload_register();

use Business\BestelService;
use Business\KlantService;
use Business\PizzaService;
use Business\PlaatService;
use Data\KlantDAO;
use Data\PizzaDAO;
use Data\PlaatsDAO;
use Entities\Pizza;
use Entities\Klant;
use Entities\Bestelling;
use Data\BestellingDAO;
use Entities\Bestellijn;

$pizzaDAO = new PizzaDAO;

$pizzaService = new PizzaService;

$pizzas = $pizzaService->getAllPizzas();

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

$klantId = $klantDAO->getKlantById(5);

$klantService = new KlantService;
//
//$addGuest = $klantService->addNewGuest($klant);
//
//print_r($addGuest);

//$getKlant = $klantDAO->getKlantByEmail('teste@oi.com.br');

//$checkLogin = $klantService->checkLogin('oi@oi.com.br', '123456');

$plaats = $plaatService->findPlaatsById(39);

//print_r($plaats);

$currentTime = new DateTime();
$now = $currentTime->format('Y-m-d H:i:s');

$bestelling = new Bestelling();
$bestelling->setDeliveryAddress($klant->getAdres());
$bestelling->setDeliveryPlaatsId($klant->getPlaatsId());
$bestelling->setDate($now);
$bestelling->setBemerkingen("Entrega rápida");

$pizzaId = $pizzaService->getPizza(2);

$bestellijn = new Bestellijn($pizzaId, 2);

$bestelling->addBestellijn($bestellijn);

$bestellingDAO = new BestellingDAO;

$bestelService = new BestelService();

$klant2 = $klantDAO->getKlantById(5);

$klantId = $klant2->getId();

$klant3 = new Klant();
$klant3->setVoornaam('Guest 3');
$klant3->setNaam('confirmOrder');
$klant3->setStraat('ALA');
$klant3->setNummer('221');
$klant3->setPlaatsId(49);
$klant3->setPhone('789654123');
$klant3->setBemerkingen('');

//$bestelId = $bestellingDAO->saveOrder($klantId, $bestelling);

$bestelId1 = $bestelService->bestelFromGuest($klant3, $bestelling);

print_r($bestelId1);
