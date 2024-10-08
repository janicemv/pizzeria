<?php

//Data/KlantDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Klant;

class KlantDAO

{
    public function isKlant(string $email): ?int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT klantId FROM klanten WHERE email =:email";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;

        return $result ? (int) $result['klantId'] : null;
    }

    public function addKlant(Klant $klant, bool $promoEligible = false): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO klanten (naam, voornaam, straat, nummer, plaatsId, phone, email, password, promo_eligible, bemerkingen) 
        VALUES (:naam, :voornaam, :straat, :nummer, :plaatsId, :phone, :email, :password, :promo_eligible, :bemerkingen)";

        $stmt = $dbh->prepare($sql);

        $stmt->execute([
            ':naam' => $klant->getNaam(),
            ':voornaam' => $klant->getVoornaam(),
            ':straat' => $klant->getStraat(),
            ':nummer' => $klant->getNummer(),
            ':plaatsId' => $klant->getPlaatsId(),
            ':phone' => $klant->getPhone(),
            ':email' => $klant->getEmail(),
            ':password' => md5($klant->getPassword()),
            ':promo_eligible' => $promoEligible ? '1' : '0',
            ':bemerkingen' => $klant->getBemerkingen() ?? ''
        ]);

        $klantId = $dbh->lastInsertId();
        $dbh = null;

        return (int) $klantId;
    }

    public function addGuest(Klant $klant, bool $promoEligible = false): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO klanten (naam, voornaam, straat, nummer, plaatsId, phone, promo_eligible, bemerkingen) 
        VALUES (:naam, :voornaam, :straat, :nummer, :plaatsId, :phone, :promo_eligible, :bemerkingen)";

        $stmt = $dbh->prepare($sql);

        $stmt->execute([
            ':naam' => $klant->getNaam(),
            ':voornaam' => $klant->getVoornaam(),
            ':straat' => $klant->getStraat(),
            ':nummer' => $klant->getNummer(),
            ':plaatsId' => $klant->getPlaatsId(),
            ':phone' => $klant->getPhone(),
            ':promo_eligible' => $promoEligible ? '1' : '0',
            ':bemerkingen' => $klant->getBemerkingen() ?? ''
        ]);

        $klantId = $dbh->lastInsertId();
        $dbh = null;

        return (int) $klantId;
    }

    public function getKlantByEmail(string $email): ?Klant
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT klantId, naam, voornaam, straat, nummer, plaatsId, phone, email, password, promo_eligible, bemerkingen 
                    FROM klanten WHERE email = :email";

        $stmt = $dbh->prepare($sql);
        $stmt->execute([':email' => $email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        if ($result) {
            $klant = new Klant();

            $klant->setNaam($result['naam']);
            $klant->setVoornaam($result['voornaam']);
            $klant->setStraat($result['straat']);
            $klant->setNummer($result['nummer']);
            $klant->setPlaatsId((int)$result['plaatsId']);
            $klant->setPhone($result['phone']);
            $klant->setEmail($result['email']);
            $klant->setPassword($result['password']);
            $klant->setPromoEligible((bool)$result['promo_eligible']);
            $klant->setBemerkingen($result['bemerkingen'] ?? null);
            return $klant;
        } else {
            return null;
        }
    }

    public function getKlantById(int $klantId): ?Klant
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT klantId, naam, voornaam, straat, nummer, plaatsId, phone, email, password, promo_eligible, bemerkingen 
                    FROM klanten WHERE klantId = :klantId";

        $stmt = $dbh->prepare($sql);
        $stmt->execute([':klantId' => $klantId]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        if ($result) {
            $klant = new Klant();

            $klant->setNaam($result['naam']);
            $klant->setVoornaam($result['voornaam']);
            $klant->setStraat($result['straat']);
            $klant->setNummer($result['nummer']);
            $klant->setPlaatsId((int)$result['plaatsId']);
            $klant->setPhone($result['phone']);
            $klant->setEmail($result['email']);
            $klant->setPassword($result['password']);
            $klant->setPromoEligible((bool)$result['promo_eligible']);
            $klant->setBemerkingen($result['bemerkingen'] ?? null);
            return $klant;
        } else {
            return null;
        }
    }
}
