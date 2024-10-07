<?php

//Data/PlaatsDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Plaats;

class PlaatsDAO
{
    public function getPlaatsen(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT plaatsId, code, gemeente FROM plaats ORDER BY code";
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $plaats = new Plaats((int) $rij["plaatsId"], $rij["code"], $rij["gemeente"]);
            array_push($lijst, $plaats);
        }

        $dbh = null;
        return $lijst;
    }
}
