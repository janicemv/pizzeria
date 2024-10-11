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

    <div class="container">
        <h1><?= $title ?></h1>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

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

                <p><?= htmlspecialchars($user->getVollNaam()); ?></p>
                <p><?= htmlspecialchars($bestelling->getDeliveryAddress()); ?></p>
                <?php if (isset($deliveryPlaats)): ?>
                    <p><?= $deliveryPlaats->getCode(); ?> <?= htmlspecialchars($deliveryPlaats->getGemeente()); ?></p>
                <?php else: ?>
                    <p><mark>Adres niet gevonden of niet geldig.</mark></p>
                <?php endif; ?>
                <p><b>Telefoonnummer:</b> <?= htmlspecialchars($user->getPhone()); ?></p>

                <div class="container">
                    <div class="row text-right">
                        <a class="btn btn-info" href="afrekenen.php?editAddress=1">Bezorging adres bewerken</a>
                    </div>
                </div>

                <?php if ((isset($_GET['editAddress'])) && $_GET['editAddress'] == 1): ?>
                    <div id="editAddressForm" class="mt-3">
                        <form action="updateAdres.php" method="POST">
                            <div class="form-group">
                                <label for="delivery_address">Nieuw afleveradres:</label>
                                <div class="form-group">
                                    <label for="straat">Straat:</label>
                                    <input type="text" name="delivery_straat" class="form-control" placeholder="Straat" required>
                                    <label for="straat">Nummer:</label>
                                    <input type="text" name="delivery_nummer" class="form-control" placeholder="Nummer" required>


                                </div>
                            </div>
                            <div class="form-group">
                                <label for="delivery_plaatsId">Plaats:</label>
                                <select name="plaatsId" class="form-control" required>
                                    <option value="">Selecteer Plaats</option>
                                    <?php foreach ($plaatsLijst as $plaatsKeuze): ?>
                                        <?php if ($plaatsKeuze->getBezorging() === true): ?>
                                            <option value="<?= $plaatsKeuze->getPlaatsId(); ?>"><?= $plaatsKeuze->getCode(); ?> - <?= htmlspecialchars($plaatsKeuze->getGemeente()); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Opslaan</button>
                        </form>
                    </div>
                <?php endif; ?>
                <br>
                <?php if (empty($error)): ?>
                    <div class="container">
                        <div class="row text-center">
                            <form action="bevestigenController.php" method="post">
                                <label for="bemerkingen">Bemerkingen:</label>
                                <input type="text" name="bemerkingen"><br><br>
                                <button type="submit" class="btn btn-success">Bestelling Bevestigen</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


        </div>

        <br>

    </div>
    <br>

    </div>

    <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>