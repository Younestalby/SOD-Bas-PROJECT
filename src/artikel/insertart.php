<?php
// auteur: Younes Et-Talby
// functie: insert class Artikel

require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Artikel;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $database = new Database();
    $db = $database->getConnection();

    $artikel = new Artikel($db);
    if($artikel->toevoegenArtikel($_POST)) {
        echo "<script> alert('Data Inserted successfully'); </script>";
    } else {
        echo "<script> alert('Data Inserted successfully'); </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
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

    <h1>Artikelen toevoegen</h1>
    <form method="post">
        <label for="nv">Artikelomschrijving:</label>
        <input type="text" id="nv" name="artOmschrijving" placeholder="artikelomschrijving" required/>
        <label for="an">Artikelinkoop:</label>
        <input type="text" id="an" name="artInkoop" placeholder="artikelinkoop" required/>
        <label for="av">Artikelverkoop:</label>
        <input type="text" id="av" name="artVerkoop" placeholder="artikelverkoop" required/>
        <label for="af">Artikelvoorraad:</label>
        <input type="text" id="af" name="artVoorraad" placeholder="artikelvoorraad" required/>
        <label for="amv">Artikel Min Voorraad:</label>
        <input type="text" id="amv" name="artMinVoorraad" placeholder="artikelMinVoorraad" required/>
        <label for="amxv">Artikel Max Voorraad:</label>
        <input type="text" id="amxv" name="artMaxVoorraad" placeholder="artikelMaxVoorraad" required/>
        <label for="al">Artikel Locatie:</label>
        <input type="text" id="al" name="artLocatie" placeholder="artikelLocatie" required/>
        <br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>
    <a href="../artikel/zieart.php">Terug</a>
</body>
</html>
