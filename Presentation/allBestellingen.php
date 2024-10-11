<?php
// Presentation/allBestellingen.php

declare(strict_types=1);

$title = "Bestellingen";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <div class="container">
        <h1><?= $title ?></h1>

        <?php if (isset($error) && $error): ?>
            <div class="alert alert-danger">
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

        <div class="row">

            <?php if (!empty($bestellingen)): ?>

                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="table-primary">
                            <th>Bestelling Id</th>
                            <th>Klant Id</th>
                            <th>Adres</th>
                            <th>Postcode</th>
                            <th>Bemerkingen</th>
                            <th>Datum</th>
                            <th>Status</th>
                            <th class="text-center">🔄</th>
                            <th>Pizza</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bestellingen as $bestelling): ?>
                            <?php
                            $bestelId = $bestelling->getBestelId();
                            $klantNummer = $bestelling->getKlantId();
                            $adres = $bestelling->getDeliveryAddress();
                            $plaats = $plaatService->findPlaatsById($bestelling->getDeliveryPlaatsId());
                            $postcode = $plaats->getCode();
                            $datum = $bestelling->getDate();
                            $status = $bestelling->getStatus();
                            $bemerkingen = $bestelling->getBemerkingen();
                            $klant = $klantService->findKlantById($bestelling->getKlantId());



                            $bestellijnen = $bestelling->getBestellijnen();
                            if (!empty($bestellijnen)):
                                foreach ($bestellijnen as $index => $bestellijn): ?>
                                    <tr>
                                        <?php if ($index === 0):
                                        ?>
                                            <td><a class="text-decoration-none" href="bestelDetails.php?bestelId=<?= $bestelId ?>"><?= $bestelId; ?> 👁️</a></td>
                                            <td><?= $klantNummer; ?></td>
                                            <td><?= htmlspecialchars($adres); ?></td>
                                            <td><?= $postcode; ?></td>
                                            <td>
                                                <?= htmlspecialchars($bestelling->getBemerkingen()); ?>
                                                <p><?= htmlspecialchars($klant->getBemerkingen()); ?></p>
                                            </td>
                                            <td><?= htmlspecialchars($datum); ?></td>
                                            <?php switch ($status):
                                                case 1: ?>
                                                    <td class="text-info">Besteld</td>
                                                <?php break;
                                                case 2: ?>
                                                    <td class="text-warning">Gemaakt</td>
                                                <?php break;
                                                case 3: ?>
                                                    <td class="text-success">Bezorgd</td>
                                            <?php break;
                                            endswitch; ?>
                                            <td class="text-center">
                                                <form action="updateStatus.php" method="POST">
                                                    <input type="hidden" name="bestelId" value="<?= $bestelId; ?>">
                                                    <button type="submit" class="btn btn-sm">🔄</button>
                                                </form>
                                            </td>



                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                        <td><?= htmlspecialchars($bestellijn->getPizza()->getNaam()); ?></td>
                                        <td><?= (int)$bestellijn->getQuantity(); ?></td>
                                        <td>€ <?= number_format($bestellijn->getPrijs(), 2); ?></td>
                                    </tr>

                                <?php endforeach; ?>
                                <tr class="table-secondary">
                                    <th colspan="9"></th>
                                    <th>Totaal</th>
                                    <th>€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11">Geen bestellijnen gevonden voor deze bestelling.</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="11"></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <p>Geen bestellingen gevonden.</p>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

                <?php require_once "presentation/components/footer.html"; ?>
        </div>

</body>

</html>