<?php
// Presentation/bestelling.php

declare(strict_types=1);

$title = "Bestelling";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <div class="container">
        <h1>Bestelling # <?= $bestelling->getBestelId(); ?></h1>

        <?php
        if ($error): ?>
            <div class="alert alert-danger">
                <p class="error"><?php echo $error; ?></p>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">

                <table class="table table-hover">
                    <thead>
                        <tr class="table-info">
                            <th>Pizza</th>
                            <th>Hoeveel</th>
                            <th>Prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bestelling)): ?>
                            <?php foreach ($bestelling->getBestellijnen() as $index => $bestellijn): ?>
                                <tr>
                                    <td><?= htmlspecialchars($bestellijn->getPizza()->getNaam()); ?></td>
                                    <td><?= $bestellijn->getQuantity(); ?></td>
                                    <td>€ <?= number_format($bestellijn->getTotalPrijs(), 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-secondary">
                                <th>Totaal</th>
                                <th></th>
                                <th>€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Geen bestellingen gevonden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <p><b>Bemerkingen:</b> <?= htmlspecialchars($bestelling->getBemerkingen() ?: 'geen bemerkingen'); ?></p>

            </div>

            <div class="col-md-4 mandje bg-light">
                <h4>Bezorging</h4>

                <p><?= htmlspecialchars($klant->getVollNaam()); ?></p>
                <p><?= htmlspecialchars($bestelling->getDeliveryAddress()); ?></p>
                <p><?= $deliveryPlaats->getCode(); ?> <?= htmlspecialchars($deliveryPlaats->getGemeente()); ?></p>
                <p><b>Telefoonnummer:</b> <?= htmlspecialchars($klant->getPhone()); ?></p>
                <p><b>Bemerkingen:</b> <?= htmlspecialchars($klant->getBemerkingen() ?: 'geen bemerkingen'); ?></p>



            </div>


        </div>

        <br>





        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>


</html>