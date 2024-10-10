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

            <table class="table table-hover table-sm">
                <thead>
                    <tr class="table-primary">
                        <th>Bestelling Id</th>
                        <th>Klant Id</th>
                        <th>Adres</th>
                        <th>Postcode</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Pizza</th>
                        <th>Aantal</th>
                        <th>Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bestellingen)): ?>
                        <?php foreach ($bestellingen as $bestelling): ?>
                            <?php
                            $bestelId = $bestelling->getBestelId();
                            $klantNummer = $bestelling->getKlantId();
                            $adres = $bestelling->getDeliveryAddress();
                            $plaats = $plaatService->findPlaatsById($bestelling->getDeliveryPlaatsId());
                            $postcode = $plaats->getCode();
                            $datum = $bestelling->getDate();
                            $status = $bestelling->getStatus();


                            $bestellijnen = $bestelling->getBestellijnen();
                            if (!empty($bestellijnen)):
                                foreach ($bestellijnen as $index => $bestellijn): ?>
                                    <tr>
                                        <?php if ($index === 0):
                                        ?>
                                            <td><?= $bestelId; ?> <a class="text-decoration-none" href="bestelDetails.php?bestelId=<?= $bestelId ?>">👁️</a></td>
                                            <td><?= $klantNummer; ?></td>
                                            <td><?= htmlspecialchars($adres); ?></td>
                                            <td><?= $postcode; ?></td>
                                            <td><?= htmlspecialchars($datum); ?></td>
                                            <td><?php switch ($status) {
                                                    case 1:
                                                        echo "Besteld";
                                                        break;
                                                    case 2:
                                                        echo "Gemaakt";
                                                        break;
                                                    default:
                                                        echo "Bezorgd";
                                                        break;
                                                }
                                                ?></td>
                                        <?php else: ?>
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
                                    <th colspan="7"></th>
                                    <th>Totaal</th>
                                    <th>€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9">Geen bestellijnen gevonden voor deze bestelling.</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="9"></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Geen bestellingen gevonden.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php require_once "presentation/components/footer.html"; ?>
        </div>

</body>

</html>