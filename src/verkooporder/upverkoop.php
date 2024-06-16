<?php
// auteur: Younes Et-Talby
// functie: update Klant

require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;

// Database connection parameters
$host = 'localhost';
$dbname = 'bas_database';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Instantiate the Verkooporder class with the PDO connection
$verkooporder = new Verkooporder($conn);

if (isset($_POST["update"]) && $_POST["update"] == "Update Customer") {
    if (isset($_POST['verkOrdId'], $_POST['klantNaam'], $_POST['artOmschrijving'], $_POST['verkOrdDatum'], $_POST['verkOrdBestAantal'], $_POST['verkOrdStatus'])) {
        $klantData = array(
            'verkOrdId' => $_POST['verkOrdId'],
            'klantNaam' => $_POST['klantNaam'],
            'artOmschrijving' => $_POST['artOmschrijving'],
            'verkOrdDatum' => $_POST['verkOrdDatum'],
            'verkOrdBestAantal' => $_POST['verkOrdBestAantal'],
            'verkOrdStatus' => $_POST['verkOrdStatus']
        );
        
        $verkooporder->updateVerkoop($klantData);
    } else {
        echo "Vul alle vereiste velden in.";
    }
}

if (isset($_GET['verkOrdId'])) {
    $row = $verkooporder->getVerkoopById($_GET['verkOrdId']);

    if ($row && is_array($row)) {
?>

<!DOCTYPE html>
<html>
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

<h2>Wijzigen</h2>  
<form method="post">
    <input type="hidden" name="verkOrdId" value="<?php echo htmlspecialchars($row['verkOrdId']); ?>"> klantNaam
    <input type="text" name="klantNaam" required value="<?php echo htmlspecialchars($row['klantNaam']); ?>"> artOmschrijving</br>
    <input type="text" name="artOmschrijving" required value="<?php echo htmlspecialchars($row['artOmschrijving']); ?>"> verkOrdDatum</br>
    <input type="text" name="verkOrdDatum" required value="<?php echo htmlspecialchars($row['verkOrdDatum']); ?>"> verkOrdBestAantal</br>
    <input type="text" name="verkOrdBestAantal" required value="<?php echo htmlspecialchars($row['verkOrdBestAantal']); ?>"> verkOrdStatus</br>
    <input type="text" name="verkOrdStatus" required value="<?php echo htmlspecialchars($row['verkOrdStatus']); ?>"></br>
    <?php
        $verkooporder->dropDownVerkoop($row['verkOrdStatus']);
    ?>    
</br><button type="submit" name="update" value="Update Customer">Update Customer</button>
</form></br>

<a href="verkoop.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Verkooporder succesvol bijgewerkt.
.";
    }
}
?>
