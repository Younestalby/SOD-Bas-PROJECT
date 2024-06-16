<?php
// auteur: Younes Et-Talby
// functie: insert inkoop

require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Inkoop;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $database = new Database();
    $db = $database->getConnection();

    $inkopen = new Inkoop($db);
    if($inkopen->toevoegenInkopen($_POST)) {
        echo "<script> alert('Data Inserted successfully'); </script>";
    } else {
        echo "<script> alert('Data Insertion failed'); </script>";
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

    <h1>Inkoop toevoegen</h1>
    <form method="post">
        <label for="nv">leverancier id:</label>
        <input type="text" id="nv" name="levId" placeholder="leverancier id" required/>
        <br>
        <label for="nv">artikel id:</label>
        <input type="text" id="nv" name="artId" placeholder="artikel Id" required/>
        <br>   
        <label for="an">inkOrdDatum:</label>
        <input type="text" id="an" name="inkOrdDatum" placeholder="inkOrdDatum" required/>
        <br>
        <label for="av">inkOrdBestAantal:</label>
        <input type="text" id="av" name="inkOrdBestAantal" placeholder="inkOrdBestAantal" required/>
        <br>
        <label for="af">inkOrdStatus:</label>
        <input type="text" id="af" name="inkOrdStatus" placeholder="inkOrdStatus" required/>
        <br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>
    <a href="inkoop.php">Terug</a>
</body>
</html>

