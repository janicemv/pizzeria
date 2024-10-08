<?php
// Presentation/login.php

declare(strict_types=1);

$title = "Login opties";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <h1>Kies een optie:</h1>
    <br>

    <div class="col-sm-6 my-1">
        <div class="row text-right">
            <a href="login.php" class="btn btn-success">Ik heb een account</a>
        </div>
        <br>
        <div class="row text-right">
            <a href="registration.php" class="btn btn-secondary">Ik heb geen account</a>
        </div>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>

</html>