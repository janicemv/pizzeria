<?php

//Business/KlantService.php

declare(strict_types=1);

namespace Business;

use Data\KlantDAO;
use Entities\Klant;
use Exceptions\RegistrationException;
use Exceptions\LoginException;

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

    public function addNewGuest(Klant $klant): int
    {
        $klantDAO = new KlantDAO;

        return $klantDAO->addGuest($klant);
    }

    public function checkLogin($email, $password): bool
    {
        $klantDAO = new KlantDAO;
        $klant = $klantDAO->getKlantByEmail($email);

        if ($klant instanceof Klant) return $klant && $klant->getPassword() === md5($password);

        return false;
    }

    public function findKlantByEmail(string $email): Klant
    {
        $klantDAO = new KlantDAO;

        if ($klantDAO->getKlantByEmail($email) !== null) {

            return $klantDAO->getKlantByEmail($email);
        } else {
            throw new LoginException('E-mail bestaat niet!');
        }
    }

    public function findKlantById(int $klantId)
    {
        $klantDAO = new KlantDAO;

        return $klantDAO->getKlantById($klantId);
    }
}
