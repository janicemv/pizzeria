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

    // TO FIX
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
            return new Klant(
                (int)$result['klantId'],
                $result['naam'],
                $result['voornaam'],
                $result['straat'],
                (int)$result['nummer'],
                (int)$result['plaatsId'],
                $result['phone'],
                $result['email'],
                $result['password'],
                (bool)$result['promo_eligible'],
                $result['bemerkingen'] ?? null
            );
        } else {
            return null;
        }
    }
}
