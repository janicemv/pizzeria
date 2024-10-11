<?php

//Data/BroodDAO

declare(strict_types=1);

namespace Data;

use \PDO;
use PDOException;
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

    public function saveBestelling($klantId, Bestelling $bestelling)
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
                ':bemerkingen' => $bestelling->getBemerkingen() ?? '',
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

    public function getBestellingById($bestelId)
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql1 = "SELECT * FROM bestellingen WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql1);
            $stmt->execute([':bestelId' => $bestelId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $bestelling = new Bestelling();

                $bestelling->setBestelId((int)$bestelId);
                $bestelling->setKlantId($result["klantId"]);
                $bestelling->setDate($result["datum"]);
                $bestelling->setDeliveryAddress($result["delivery_address"]);
                $bestelling->setDeliveryPlaatsId($result["delivery_plaatsId"]);
                $bestelling->setBemerkingen($result["bemerkingen"]);
                $bestelling->setStatus((int)$result["status"]);
            } else {
                return null;
            }

            $sql2 = "SELECT b.*, p.* FROM bestellijnen b LEFT JOIN pizzas p ON b.pizzaId = p.pizzaId WHERE bestelId = :bestelId";
            $stmt = $dbh->prepare($sql2);
            $stmt->execute([':bestelId' => $bestelId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {

                foreach ($result as $lijn) {

                    $pizza = new Pizza($lijn["pizzaId"], $lijn["naam"], $lijn["omschrijving"], (float)$lijn["prijs"], (float)$lijn["promo_prijs"], (bool)$lijn["beschikbaar"]);

                    $bestellijn = new Bestellijn($pizza, (int)$lijn["hoeveel"]);

                    $bestelling->addBestellijn($bestellijn);
                }
            }
            return $bestelling;
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return null;
        } finally {
            $dbh = null;
        }
    }

    public function getBestellingen()
    {
        $bestellingen = [];

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql1 = "SELECT * FROM bestellingen ORDER BY status, datum";
            $stmt = $dbh->prepare($sql1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $bestelling = new Bestelling();
                $bestelling->setBestelId((int)$row["bestelId"]);
                $bestelling->setKlantId($row["klantId"]);
                $bestelling->setDate($row["datum"]);
                $bestelling->setDeliveryAddress($row["delivery_address"]);
                $bestelling->setDeliveryPlaatsId($row["delivery_plaatsId"]);
                $bestelling->setBemerkingen($row["bemerkingen"]);
                $bestelling->setStatus((int)$row["status"]);

                $sql2 = "SELECT b.*, p.* FROM bestellijnen b LEFT JOIN pizzas p ON b.pizzaId = p.pizzaId WHERE bestelId = :bestelId";
                $stmt2 = $dbh->prepare($sql2);
                $stmt2->execute([':bestelId' => $bestelling->getBestelId()]);
                $lijnen = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                if ($lijnen) {
                    foreach ($lijnen as $lijn) {
                        $pizza = new Pizza($lijn["pizzaId"], $lijn["naam"], $lijn["omschrijving"], (float)$lijn["prijs"], (float)$lijn["promo_prijs"], (bool)$lijn["beschikbaar"]);
                        $bestellijn = new Bestellijn($pizza, (int)$lijn["hoeveel"]);
                        $bestelling->addBestellijn($bestellijn);
                    }
                }

                $bestellingen[] = $bestelling;
            }

            return $bestellingen;
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return null;
        } finally {
            if (isset($dbh)) {
                $dbh = null;
            }
        }
    }

    public function changeStatus($bestelId)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "UPDATE bestellingen 
        SET status = CASE 
            WHEN status < 3 THEN status + 1
            ELSE status
        END
        WHERE bestelId = :bestelId";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':bestelId', $bestelId, PDO::PARAM_INT);
        $stmt->execute();

        $dbh = null;
    }
}
