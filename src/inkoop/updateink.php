<?php
// Auteur: Younes Et-Talby
// Functie: Update inkooporder

require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Inkoop;

// Database connection
$database = new Database();
$db = $database->getConnection();
$inkoop = new Inkoop($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $inkoopData = $inkoop->getInkoopById($id);
} else {
    die("ID is not provided.");
}

if (isset($_POST['update'])) {
    $updateData = [
        'inkOrdId' => $_POST['inkOrdId'],
        'levId' => $_POST['levId'],
        'artId' => $_POST['artId'],
        'inkOrdDatum' => $_POST['inkOrdDatum'],
        'inkOrdBestAantal' => $_POST['inkOrdBestAantal'],
        'inkOrdStatus' => $_POST['inkOrdStatus']
    ];

    if ($inkoop->updateInkoop($updateData)) {
        echo "<script>alert('Inkoop order updated successfully');</script>";
        echo "<script>window.location.href='inkoop.php';</script>";
    } else {
        echo "<script>alert('Failed to update inkoop order');</script>";
    }
}

// Fetch lists of leveranciers and artikelen for dropdowns
$leveranciers = $db->query("SELECT levId, levNaam FROM leveranciers")->fetchAll(PDO::FETCH_ASSOC);
$artikelen = $db->query("SELECT artId, artOmschrijving FROM artikel")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inkoop</title>
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

    <div class="container">
        <h1>Update Inkoop Order</h1>
        <form method="post">
            <input type="hidden" name="inkOrdId" value="<?php echo $inkoopData['inkOrdId']; ?>">
            
            <label for="levId">Leverancier:</label>
            <select id="levId" name="levId" required>
                <?php foreach ($leveranciers as $leverancier): ?>
                    <option value="<?php echo $leverancier['levId']; ?>" <?php if ($leverancier['levId'] == $inkoopData['levId']) echo 'selected'; ?>>
                        <?php echo $leverancier['levNaam']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <label for="artId">Artikel:</label>
            <select id="artId" name="artId" required>
                <?php foreach ($artikelen as $artikel): ?>
                    <option value="<?php echo $artikel['artId']; ?>" <?php if ($artikel['artId'] == $inkoopData['artId']) echo 'selected'; ?>>
                        <?php echo $artikel['artOmschrijving']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <label for="inkOrdDatum">Datum:</label>
            <input type="date" id="inkOrdDatum" name="inkOrdDatum" value="<?php echo $inkoopData['inkOrdDatum']; ?>" required>
            <br>
            
            <label for="inkOrdBestAantal">Bestel Aantal:</label>
            <input type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" value="<?php echo $inkoopData['inkOrdBestAantal']; ?>" required>
            <br>
            
            <label for="inkOrdStatus">Status:</label>
            <input type="text" id="inkOrdStatus" name="inkOrdStatus" value="<?php echo $inkoopData['inkOrdStatus']; ?>" required>
            <br>
            
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
