<?php
// auteur: Younes Et-Talby
// functie: insert  Klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		$Klant = new Klant();
		$Klant->toevoegenKlant($_POST); 
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


    <h1>CRUD Klant</h1>
    <h2>Toevoegen</h2>
    <form method="post">
    <label for="nv">Klantnaam:</label>
    <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
    <label for="an">Klantemail:</label>
    <input type="text" id="an" name="klantemail" placeholder="Klantemail" required/>
    <label for="nv">KlantAdres:</label>
    <input type="text" id="nv" name="klantadres" placeholder="Klantadres" required/>
    <label for="nv">KlantPostcode:</label>
    <input type="text" id="nv" name="klantpostcode" placeholder="KlantPostcode" required/>
    <label for="nv">KlantWoonplaats:</label>
    <input type="text" id="nv" name="klantwoonplaats" placeholder="KlantWoonplaats" required/>
    <input type='submit' name='insert' value='Toevoegen'>
    </form></br>

    <a href='read.php'>Terug</a>

</body>
</html>