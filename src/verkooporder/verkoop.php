<!--
    Auteur: Younes Et-Talby
    Function: verkoop crud
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

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

<body>
<div class="opbar">
    <a href='insertverkoop.php'>Toevoegen nieuw Verkoop Order</a><br><br>
</div>    

<?php

require '../../vendor/autoload.php';
require '../classes/config.php';

use Bas\classes\Verkooporder;

$conn = getConnection();

try {
    $verkooporder = new Verkooporder($conn);
    $verkooporder->crudVerkoop();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
</body>
</html>
