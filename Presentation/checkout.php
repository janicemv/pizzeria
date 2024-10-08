<?php
// Presentation/checkout.php

declare(strict_types=1);

$title = "Checkout";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <pre>
        <?php print_r($user); ?>
    </pre>

    <pre>
        <?php print_r($bestelling); ?>
    </pre>
    <h1><?= $title ?></h1>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Winkelmandje</h2>

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
                <div class="container">
                    <div class="row text-right">
                        <a class="btn btn-primary" href="toonpizzas.php">Pizza's bewerken</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mandje bg-light">
                <h2>Bezorging</h2>

                <p><?= $user->getVollNaam(); ?></p>
                <p><?= $user->getAdres(); ?></p>
                <p><?= $plaats->getCode(); ?> <?= $plaats->getGemeente(); ?></p>
                <p><b>Telefoonnummer:</b> <?= $user->getPhone(); ?></p>

            </div>
            <br>

        </div>
        <br>
        <div class="container">
            <div class="row text-right">

                <button class="btn btn-success">Beslissen</button>
            </div>
        </div>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>