<?php
// Presentation/klantGegevens.php

declare(strict_types=1);

$title = "Klant gegevens";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php" ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>
        <div class="form-row align-items-center">

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <div class="col-sm-6 my-1">
                <form action="registerController.php" method="post">
                    <div class="form-group">
                        <label for="voornaam">Voornaam:</label>
                        <input type="text" name="voornaam" class="form-control" placeholder="Voornaam" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="naam">Naam:</label>
                        <input type="text" name="naam" class="form-control" placeholder="Naam" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="straat">Straat:</label>
                        <input type="text" name="straat" class="form-control" placeholder="Straat" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nummer">Huisnummer:</label>
                        <input type="text" name="nummer" class="form-control" placeholder="Nummer" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="plaatsId">Plaats:</label>
                        <select name="plaatsId" class="form-control" required>
                            <option value="">Selecteer Plaats</option>
                            <?php foreach ($plaatsen as $plaats): ?>
                                <option value="<?= $plaats->getPlaatsId() ?>"><?= $plaats->getCode() ?> - <?= htmlspecialchars($plaats->getGemeente()); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="phone">Telefoonnummer:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Telefoon" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="bemerkingen">Bemerkingen:</label>
                        <input type="text" name="bemerkingen" class="form-control" placeholder="Bemerkingen">
                    </div>
                    <br>

                    <div class="row form-group text-right">
                        <button type="submit" name="step" value="basic" class="btn btn-secondary">Afrekenen as Gast</button>
                    </div>
                    <br>
                    <div class="row form-group text-right">

                        <button type="submit" name="step" value="account" class="btn btn-success">Account Maken</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    </div>
</body>

</html>