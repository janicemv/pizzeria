<?php
// Presentation/pizzalijst.php

declare(strict_types=1);

$title = "Pizzalijst";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9 pizzamenu">
                <h1><?= $title ?></h1>

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Pizza</th>
                            <th>Omschrijving</th>
                            <th>Prijs</th>
                            <th>Toevoegen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pizzas)): ?>
                            <?php foreach ($pizzas as $pizza): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pizza->getNaam()); ?></td>
                                    <td><?= htmlspecialchars($pizza->getOmschrijving()); ?></td>
                                    <td><?= number_format($pizza->getPrijs(), 2); ?>€</td>
                                    <td><a class="text-decoration-none" href="cartController.php?pizzaId=<?= $pizza->getPizzaId(); ?>">➕</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Geen pizza's gevonden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3 mandje bg-light">
                <h1>Winkelmandje</h1>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-info">
                            <th>Pizza</th>
                            <th>Prijs</th>
                            <th>🗑️</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bestelling)):
                            foreach ($bestelling->getBestellijnen() as $bestellijn): ?>
                                <tr>
                                    <td><?= htmlspecialchars($bestellijn->GetPizza()->getNaam()); ?></td>
                                    <td>€ <?= number_format($bestellijn->getPrijs(), 2); ?></td>
                                    <td>🗑️</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-secondary">
                                <th>Totaal</th>
                                <th colspan="2">€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Geen bestellingen gevonden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button class="btn btn-success">Afrekenen</button>
            </div>
        </div>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>