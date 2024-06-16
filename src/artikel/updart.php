<?php

// Functie: update Artikel

require '../../vendor/autoload.php';
require '../classes/config.php';

use Bas\classes\Artikel;

$artikel = new Artikel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && $_POST['update'] === 'Update Artikel') {
    $requiredFields = ['artId', 'artOmschrijving', 'artInkoop', 'artVerkoop', 'artVoorraad', 'artMinVoorraad', 'artMaxVoorraad', 'artLocatie'];
    $artikelData = [];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            echo "Vul alle vereiste velden in.";
            exit;
        }
        $artikelData[$field] = $_POST[$field];
    }

    if ($artikel->updateArtikel($artikelData)) {
        echo "Artikel succesvol bijgewerkt.";
    } else {
        echo "Er is een fout opgetreden bij het bijwerken van het artikel.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['artId'])) {
    $artId = $_GET['artId'];
    $row = $artikel->getArtikelById($artId);
    if ($row) {
        ?>
        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CRUD</title>
            <link rel="stylesheet" href="../style.css">
        </head>
        <body>

        <header>
            <nav>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../klant/read.php">Klanten</a></li>
                    <li><a href="../artikel/zieart.php">Artikelen</a></li>
                    <li><a href="../verkooporder/verkoop.php">Verkooporders</a></li>
                    <li><a href="../inkoop/inkoop.php">Inkooporder</a></li>
                </ul>
            </nav>
        </header>

        <h2>Wijzigen</h2>
        <form method="post">
            <input type="hidden" name="artId" value="<?= htmlspecialchars($row['artId']); ?>">
            <label>artOmschrijving</label>
            <input type="text" name="artOmschrijving" required value="<?= htmlspecialchars($row['artOmschrijving']); ?>"><br>
            <label>artInkoop</label>
            <input type="text" name="artInkoop" required value="<?= htmlspecialchars($row['artInkoop']); ?>"><br>
            <label>artVerkoop</label>
            <input type="text" name="artVerkoop" required value="<?= htmlspecialchars($row['artVerkoop']); ?>"><br>
            <label>artVoorraad</label>
            <input type="text" name="artVoorraad" required value="<?= htmlspecialchars($row['artVoorraad']); ?>"><br>
            <label>artMinVoorraad</label>
            <input type="text" name="artMinVoorraad" required value="<?= htmlspecialchars($row['artMinVoorraad']); ?>"><br>
            <label>artMaxVoorraad</label>
            <input type="text" name="artMaxVoorraad" required value="<?= htmlspecialchars($row['artMaxVoorraad']); ?>"><br>
            <label>artLocatie</label>
            <input type="text" name="artLocatie" required value="<?= htmlspecialchars($row['artLocatie']); ?>"><br><br>
            <button type="submit" name="update" value="Update Artikel">Update Artikel</button>
        </form><br>

        <a href="zieart.php">Terug</a>

        </body>
        </html>
        <?php
    } else {
        echo "Artikel niet gevonden.";
    }
} else {
    echo "Geen artId opgegeven<br>";
}
?>
