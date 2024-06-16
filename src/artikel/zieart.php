<!--
    Auteur: Younes Et-Talby
    Functie: home page CRUD Klant
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
                <li><a href="../klant/read.php">Klanten</a></li>
                <li><a href="../artikel/zieart.php">Artikelen</a></li>
                <li><a href="../verkooporder/verkoop.php">Verkooporders</a></li>
                <li><a href="../inkoop/inkoop.php">Inkooporder</a></li>
            </ul>
        </nav>
    </header>

    <div class="opbar">
        <a href='../artikel/insertart.php'>Toevoegen nieuwe artikel</a><br><br>
    </div>    

    <?php
    require '../../vendor/autoload.php';
    require '../classes/config.php';

    use Bas\classes\Artikel;

    $artikel = new Artikel();
    $artikel->crudartikel();
    ?>
</body>
</html>
