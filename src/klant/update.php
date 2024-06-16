<?php

// Functie: update Klant

require '../../vendor/autoload.php';
require '../classes/config.php';

use Bas\classes\Klant;

$klant = new Klant;
$conn = getConnection();

if (isset($_POST["update"]) && $_POST["update"] == "Update Customer") {
    if (isset($_POST['klantId'], $_POST['klantnaam'], $_POST['klantemail'], $_POST['klantadres'], $_POST['klantPostcode'], $_POST['klantWoonplaats'])) {
        $klantData = array(
            'klantId' => $_POST['klantId'],
            'klantNaam' => $_POST['klantnaam'],
            'klantEmail' => $_POST['klantemail'],
            'klantAdres' => $_POST['klantadres'],
            'klantPostcode' => $_POST['klantPostcode'],
            'klantWoonplaats' => $_POST['klantWoonplaats']
        );

        $sql = "UPDATE klant SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";
        $stmt = $conn->prepare($sql);
        $stmt->execute($klantData);
        echo "Klantgegevens succesvol bijgewerkt.";
    } else {
        echo "Vul alle vereiste velden in.";
    }
}

if (isset($_GET['klantId'])) {
    $klantId = $_GET['klantId'];
    $stmt = $conn->prepare("SELECT * FROM klant WHERE klantId = :klantId");
    $stmt->execute(['klantId' => $klantId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <li><a href="../klant/read.php">klanten</a></li>
                <li><a href="../artikel/zieart.php">Artikelen</a></li>
                <li><a href="../verkooporder/verkoop.php">Verkooporders</a></li>
                <li><a href="../inkoop/inkoop.php">Inkooporder</a></li>
            </ul>
        </nav>
    </header>

<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>
<form method="post">
    <input type="hidden" name="klantId" value="<?php if (isset($row)) { echo $row['klantId']; } ?>">klantNaam
    <input type="text" name="klantnaam" required value="<?php if (isset($row)) { echo $row['klantNaam']; } ?>"> klantEmail</br>
    <input type="text" name="klantemail" required value="<?php if (isset($row)) { echo $row['klantEmail']; } ?>"> klantAdres</br>
    <input type="text" name="klantadres" required value="<?php if (isset($row)) { echo $row['klantAdres']; } ?>"> klantPostcode</br>
    <input type="text" name="klantPostcode" required value="<?php if (isset($row)) { echo $row['klantPostcode']; } ?>"> klantWoonplaats</br>
    <input type="text" name="klantWoonplaats" required value="<?php if (isset($row)) { echo $row['klantWoonplaats']; } ?>"> </br>
    </br>
    <button type="submit" name="update" value="Update Customer">Update Customer</button>
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
} else {
    echo "Geen klantId opgegeven<br>";
}
?>
