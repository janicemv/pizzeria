<?php
// updateStatus.php
declare(strict_types=1);

spl_autoload_register();

use Business\BestelService;
use Exceptions\BestelException;

$bestelId = (int)$_POST['bestelId'];

$bestelService = new BestelService();

try {
    $bestelService->updateStatus($bestelId);

    header('Location: toonBestellingen.php');
    exit;
} catch (BestelException $e) {
    die('Status update error: ' . htmlspecialchars($e->getMessage()));
}
