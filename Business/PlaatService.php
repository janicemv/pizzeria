<?php

//Business/PlaatService.php

declare(strict_types=1);

namespace Business;

use Data\PlaatsDAO;
use Entities\Plaats;

class PlaatService
{
    public function getAllPlaatsen(): array
    {
        $plaatsDAO = new PlaatsDAO();
        return $plaatsDAO->getPlaatsen();
    }

    public function findPlaatsById($plaatsId): Plaats
    {
        $plaatsDAO = new PlaatsDAO();
        return $plaatsDAO->getPlaatsById($plaatsId);
    }
}
