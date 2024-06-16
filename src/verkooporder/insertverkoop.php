<?php
// auteur: Younes Et-Talby
// functie: verkoop

require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Verkooporder;
use Bas\classes\Klant;
use Bas\classes\Artikel;

session_start();

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $database = new Database();
    $db = $database->getConnection();

    
    $verkooporder = new Verkooporder($db); // Instantiate Verkooporder
    $verkooporder->toevoegenVerkoop($_POST);

    if($_SESSION['verkoopordercheck']) {
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <h1>Verkoop</h1>
    <h2>Toevoegen</h2>
    <form method="post">
        <?php
        $klant = new Klant();
        $klant->dropDownKlant();
        ?>
    <br/>
        <?php
        $artikel = new Artikel();
        $artikel->dropDownArtikel();
        ?>
        <br/>
    <label for="nv">verkOrdDatum:</label>
    <input type="text" id="nv" name="verkOrdDatum" placeholder="verkOrdDatum" required/>
    <br>
    <label for="nv">verkOrdBestAantal:</label>
    <input type="text" id="nv" name="verkOrdBestAantal" placeholder="verkOrdBestAantal" required/>
    <br>
    <input type='submit' name='insert' value='Toevoegen'>


    </form>
 
    <a href='verkoop.php'>Terug</a>
</body>
</html>

<script>
    $('.changeklantid').click(function() {
        var klantId = $(this).data('id');
        var klantnaam = $(this).data('name');
        $('#klantId').val(klantId);
        $('#klantnaam').val(klantnaam);
    });
    $('.changeartid').click(function() {
        var klantId = $(this).data('id');
        var klantnaam = $(this).data('name');
        $('#artId').val(klantId);
        $('#artnaam').val(klantnaam);
    });
</script>