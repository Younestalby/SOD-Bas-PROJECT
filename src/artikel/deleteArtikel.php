<?php
// Auteur: Younes Et-Talby
// Functie: Artikel verwijderen

require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if (isset($_POST['verwijderen'])) {

    $artikelId = $_POST['artId'];
    
    if (empty($artikelId)) {
        echo '<script>alert("Geen Artikel ID ontvangen")</script>';
        exit;
    }

    echo "Artikel ID om te verwijderen: " . $artikelId . "<br>";

    $artikelObject = new Artikel();
    $isVerwijderd = $artikelObject->deleteArtikel($artikelId);

    if ($isVerwijderd) {
        echo '<script>alert("Artikel succesvol verwijderd")</script>';
    } else {
        echo '<script>alert("Artikel verwijderen mislukt")</script>';
    }

    echo "<script>location.replace('../artikel/zieart.php');</script>";
} else {
    echo 'Ongeldig verzoek';
}
?>
