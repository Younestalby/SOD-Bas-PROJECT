<?php

// Functie: Verwijder Artikel

require '../../vendor/autoload.php';
require '../classes/config.php';

use Bas\classes\Artikel;

$artikelObject = new Artikel();

if (!empty($_POST['artId'])) {
    $artikelId = $_POST['artId'];
    if ($artikelObject->deleteArtikel($artikelId)) {
        echo "Artikel succesvol verwijderd.";
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het artikel.";
    }
} else {
    echo "Geen artId opgegeven.";
}
?>
