<?php

//Business/PlaatService.php

declare(strict_types=1);

namespace Business;

use Data\PlaatsDAO;

class PlaatService
{
    public function getAllPlaatsen(): array
    {
        $plaatsDAO = new PlaatsDAO();
        return $plaatsDAO->getPlaatsen();
    }
}
