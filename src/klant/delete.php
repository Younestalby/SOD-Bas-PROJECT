<?php
// Auteur: Younes Et-Talby
// Functie: delete klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["verwijderen"])) {
    $klantId = $_POST['klantId'];

    if (empty($klantId)) {
        echo '<script>alert("Geen klant ID ontvangen"); location.replace("read.php");</script>';
        exit;
    }

    echo "Klant ID to delete: " . htmlspecialchars($klantId, ENT_QUOTES, 'UTF-8') . "<br>";

    $klant = new Klant();

    if ($klant->deleteKlant($klantId)) {
        echo '<script>alert("Klant verwijderd"); location.replace("read.php");</script>';
    } else {
        echo '<script>alert("Klant verwijderen mislukt"); location.replace("read.php");</script>';
    }
} else {
    echo '<script>alert("Ongeldige aanvraag"); location.replace("read.php");</script>';
}
?>
