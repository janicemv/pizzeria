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

        <?php if ($user !== null) : ?>
            <h3>Hallo, <?= $user->getVoornaam(); ?></h3>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8 pizzamenu">
                <h1><?= $title ?></h1>



                <table class="table">
                    <thead class="table-info">
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
                                    <td><a class="text-decoration-none" href="cartController.php?pizzaId=<?= $pizza->getPizzaId(); ?>&quantity=1">➕</a></td>
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

            <div class="col-md-4 mandje bg-light">
                <h1>Winkelmandje</h1>

                <table class="table table-hover">
                    <thead>
                        <tr class="table-info">
                            <th>Pizza</th>
                            <th>Hoeveel</th>
                            <th>Prijs</th>
                            <th>🗑️</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bestelling)): ?>
                            <?php foreach ($bestelling->getBestellijnen() as $index => $bestellijn): ?>
                                <tr>
                                    <td><?= htmlspecialchars($bestellijn->getPizza()->getNaam()); ?></td>
                                    <td>
                                        <form action="cartController.php" method="get">
                                            <input type="hidden" name="pizzaId" value="<?= $bestellijn->getPizza()->getPizzaId(); ?>">
                                            <input type="number" name="quantity" value="<?= $bestellijn->getQuantity(); ?>" min="1">
                                            <button type="submit" class="btn btn-sm">🔄</button>
                                        </form>
                                    </td>
                                    <td>€ <?= number_format(($bestellijn->getPrijs() * $bestellijn->getQuantity()), 2); ?></td>
                                    <td>
                                        <a class="text-decoration-none" href="cartController.php?removeIndex=<?= $index; ?>" class="text-danger">🗑️</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-secondary">
                                <th>Totaal</th>
                                <th></th>
                                <th></th>
                                <th colspan="2">€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Geen bestellingen gevonden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <form action="afrekenen.php">
                    <button class="btn btn-success">Afrekenen</button>
                </form>
            </div>
        </div>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>