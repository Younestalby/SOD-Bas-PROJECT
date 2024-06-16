<!--
	Auteur: Younes Et-Talby
	Function: html van de inkoop page
-->
<!DOCTYPE html>
<html lang="nl">
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


<div class="opbar">	
		<a href='insertink.php'>Toevoegen nieuwe artikel</a><br><br>
	
</div>	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Inkoop;

// Maak een object Klant
$inkoop = new Inkoop;

// Start CRUD
$inkoop->crudinkoop();

?>
</body>
</html>