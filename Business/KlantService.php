<?php

//Business/KlantService.php

declare(strict_types=1);

namespace Business;

use Data\KlantDAO;
use Entities\Klant;
use Exceptions\RegistrationException;

class KlantService
{
    public function addNewKlant(Klant $klant): int
    {
        $klantDAO = new KlantDAO;
        if ($klantDAO->isKlant($klant->getEmail()) === null) {

            return $klantDAO->addKlant($klant);
        } else {
            throw new RegistrationException('E-mail bestaat!');
        }
    }
}
