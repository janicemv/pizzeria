<?php
// menu.php
declare(strict_types=1);

use Business\SessionService;

?>


<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Pizzeria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="toonBestellingen.php">Bestellingen</a>

            </div>
        </div>
        <div>

            <ul class="nav justify-content-end">
                <li><a class="nav-item nav-link" href="afrekenen.php">🛒</a></li>

                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a class="nav-item nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a class="nav-item nav-link" href="login.php">Login</a></li>
                <?php endif; ?>

            </ul>

        </div>

    </nav>
</div>