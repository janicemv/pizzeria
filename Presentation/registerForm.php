<?php
// Presentation/registerForm.php

declare(strict_types=1);

$title = "Account Maken";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php" ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>

        <div class="form-row align-items-center">
            <div class="col-sm-6 my-1">
                <form action="accountController.php" method="post">
                    <div id="accountFields" style="display: block;">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Wachtwoord:</label>
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord" required>
                            <br>
                            <label for="password2">Herhaal Wachtwoord:</label>
                            <input type="password" name="password2" class="form-control" placeholder="Wachtwoord herhalen" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group text-right">
                        <button type="submit" name="step" value="account" class="btn btn-success">Registreren met account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <pre>
            <?php print_r($user); ?>
            <?php print_r($bestelling); ?>
        </pre>
</body>

</html>