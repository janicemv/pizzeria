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
//$addGuest1 = $klantService->addNewGuest($klant);
//
//print_r($addGuest);

//$getKlant = $klantDAO->getKlantByEmail('teste@oi.com.br');

//$checkLogin = $klantService->checkLogin('oi@oi.com.br', '123456');

$plaats = $plaatService->findPlaatsById(39);

//print_r($plaats);

$currentTime = new DateTime();
$now = $currentTime->format('Y-m-d H:i:s');

//$bestelling = new Bestelling();
//$bestelling->setDeliveryAddress($klant->getAdres());
//$bestelling->setDeliveryPlaatsId($klant->getPlaatsId());
//$bestelling->setDate($now);
//$bestelling->setBemerkingen("Entrega rápida");
//
//$pizzaId = $pizzaService->getPizza(2);
//$pizzaId1 = $pizzaService->getPizza(2);
//
//$bestellijn = new Bestellijn($pizzaId, 2);
//$bestelling->addBestellijn($bestellijn);
//
//$bestellijn = new Bestellijn($pizzaId1, 1);
//$bestelling->addBestellijn($bestellijn);

$bestellingDAO = new BestellingDAO;

$bestelService = new BestelService();
//
//$klant2 = $klantDAO->getKlantById(6);
//
//$klantId = $klant2->getId();
//
//$klant3 = new Klant();
//$klant3->setVoornaam('Guest5');
//$klant3->setNaam('confirmOrder');
//$klant3->setStraat('ALA');
//$klant3->setNummer('221');
//$klant3->setPlaatsId(49);
//$klant3->setPhone('789654123');
//$klant3->setBemerkingen('teste com guest');

//$klantId3 = $klantService->addNewGuest($klant3);

//$klantId3 = $klantDAO->addGuest($klant3);


//$bestelId = $bestellingDAO->saveFromKlant($klantId, $bestelling);

//$bestelId1 = $bestelService->bestelFromGuest($klant3, $bestelling);
//$bestelId2 = $bestelService->confirmOrder(6, $bestelling);

//$bestelId3 = $bestellingDAO->saveBestelling(5, $bestelling);

//$klant4 = new Klant();
//$klant4->setVoornaam('Guest5');
//$klant4->setNaam('confirmOrder');
//$klant4->setStraat('ALA');
//$klant4->setNummer('221');
//$klant4->setPlaatsId(49);
//$klant4->setEmail('ada1s@sdfc.com');
//$klant4->setPassword('123456');
//$klant4->setPhone('789654123');
//$klant4->setBemerkingen('teste com klant');

//$klantId4 = $klantDAO->addKlant($klant4);

//$klantId = $klantService->addNewGuest($klant3);

//$klantId4 = $klantService->addNewKlant($klant4);

//$guest = new Klant();
//$guest->setVoornaam('bevestigen');
//$guest->setNaam('test');
//$guest->setStraat('ALA');
//$guest->setNummer('221');
//$guest->setPlaatsId(49);
//$guest->setPhone('789654123');
//$guest->setBemerkingen('teste bevestigen controller');
//
//$bestelling1 = new Bestelling();
//$bestelling1->setDeliveryAddress($guest->getAdres());
//$bestelling1->setDeliveryPlaatsId($guest->getPlaatsId());
//$bestelling1->setDate($now);
//$bestelling1->setBemerkingen("Bevestigen Controller test");
//
//$pizzaId = $pizzaService->getPizza(3);
//$pizzaId1 = $pizzaService->getPizza(5);
//
//$bestellijn1 = new Bestellijn($pizzaId, 2);
//$bestelling1->addBestellijn($bestellijn1);
//
//$bestellijn2 = new Bestellijn($pizzaId1, 1);
//$bestelling1->addBestellijn($bestellijn2);
//
//$bestelId = $bestelService->confirmOrder(6, $bestelling1);

// $bestel = $bestelService->showBestelling(36);

//$bestellingen = $bestellingDAO->getBestellingen();

//$bestellingen = $bestelService->getAllOrders();

$status = $bestelService->updateStatus(75);
