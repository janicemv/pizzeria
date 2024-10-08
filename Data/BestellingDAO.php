<?php

//Data/BroodDAO

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Exceptions\BestellingException;
use Entities\Bestelling;
use Entities\Bestellijn;
use Entities\Klant;
use Entities\Pizza;


class BestellingDAO
{

    public function saveFromGuest(Klant $klant, Bestelling $bestelling)
    {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbh->beginTransaction();

            $sql = "INSERT INTO klanten (naam, voornaam, straat, nummer, plaatsId, phone, bemerkingen)
                        VALUES (:naam, :voornaam, :straat, :nummer, :plaatsId, :phone, :bemerkingen)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':naam' => $klant->getNaam(),
                ':voornaam' => $klant->getVoornaam(),
                ':straat' => $klant->getStraat(),
                ':nummer' => $klant->getNummer(),
                ':plaatsId' => $klant->getPlaatsId(),
                ':phone' => $klant->getPhone(),
                ':bemerkingen' => $klant->getBemerkingen()
            ]);
            if (!$stmt->rowCount()) {
                throw new BestellingException("Fout bij Klant bewaren");
            }

            $klantId = (int)$dbh->lastInsertId();
            $bestelling->setKlantId($klantId);

            $sqlBestelling = "INSERT INTO bestellingen (klantId, datum, delivery_address, delivery_plaatsId, bemerkingen)
                              VALUES (:klantId, :datum, :delivery_address, :delivery_plaatsId, :bemerkingen)";
            $stmtBestelling = $dbh->prepare($sqlBestelling);
            $stmtBestelling->execute([
                ':klantId' => $klantId,
                ':datum' => $bestelling->getDate(),
                ':delivery_address' => $bestelling->getDeliveryAddress(),
                ':delivery_plaatsId' => $bestelling->getDeliveryPlaatsId(),
                ':bemerkingen' => $bestelling->getBemerkingen(),
            ]);
            if (!$stmtBestelling->rowCount()) {
                throw new BestellingException("Fout bij Bestelling bewaren");
            }

            $bestelId = (int)$dbh->lastInsertId();
            $bestelling->setBestelId($bestelId);


            foreach ($bestelling->getBestellijnen() as $bestellijn) {

                $sql = "INSERT INTO bestellijnen (bestelId, pizzaId, prijs, hoeveel)
       VALUES (:bestelId, :pizzaId, :prijs, :hoeveel)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([
                    ':bestelId' => $bestelId,
                    ':pizzaId' => $bestellijn->getPizza()->getPizzaId(),
                    ':prijs' => $bestellijn->getPrijs(),
                    ':hoeveel' => $bestellijn->getQuantity()
                ]);
                if (!$stmt->rowCount()) {
                    throw new BestellingException("Fout bij bestellijn bewaren");
                }
            }


            $dbh->commit();
            $dbh = null;

            return $bestelId;
        } catch (BestellingException $e) {
            if ($dbh) {
                $dbh->rollBack();
            }
            throw new BestellingException("Bestelling was niet bewaard: " . $e->getMessage());
        }
    }

    public function saveOrder($klantId, Bestelling $bestelling)
    {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbh->beginTransaction();

            $sqlBestelling = "INSERT INTO bestellingen (klantId, datum, delivery_address, delivery_plaatsId, bemerkingen)
                              VALUES (:klantId, :datum, :delivery_address, :delivery_plaatsId, :bemerkingen)";
            $stmtBestelling = $dbh->prepare($sqlBestelling);
            $stmtBestelling->execute([
                ':klantId' => $klantId,
                ':datum' => $bestelling->getDate(),
                ':delivery_address' => $bestelling->getDeliveryAddress(),
                ':delivery_plaatsId' => $bestelling->getDeliveryPlaatsId(),
                ':bemerkingen' => $bestelling->getBemerkingen(),
            ]);
            if (!$stmtBestelling->rowCount()) {
                throw new BestellingException("Fout bij Bestelling bewaren");
            }

            $bestelId = (int)$dbh->lastInsertId();
            $bestelling->setBestelId($bestelId);


            foreach ($bestelling->getBestellijnen() as $bestellijn) {

                $sql = "INSERT INTO bestellijnen (bestelId, pizzaId, prijs, hoeveel)
       VALUES (:bestelId, :pizzaId, :prijs, :hoeveel)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([
                    ':bestelId' => $bestelId,
                    ':pizzaId' => $bestellijn->getPizza()->getPizzaId(),
                    ':prijs' => $bestellijn->getPrijs(),
                    ':hoeveel' => $bestellijn->getQuantity()
                ]);
                if (!$stmt->rowCount()) {
                    throw new BestellingException("Fout bij bestellijn bewaren");
                }
            }


            $dbh->commit();
            $dbh = null;

            return $bestelId;
        } catch (BestellingException $e) {
            if ($dbh) {
                $dbh->rollBack();
            }
            throw new BestellingException("Bestelling was niet bewaard: " . $e->getMessage());
        }
    }
}
