<?php

require '../../vendor/autoload.php';
require '../classes/config.php';

use Bas\classes\Klant;

// Maak een object Klant
$klant = new Klant();
$conn = getConnection();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Klanten</title>
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
                <li><a href="../inkoop/inkoop.php">Inkooporders</a></li>
            </ul>
        </nav>
    </header>

    <div class="opbar">
        <a href="insert.php">Toevoegen nieuwe klant</a><br><br>
        <div class="search-container">
            <form action="">
                <input type="text" id="myInput" onkeyup="filterTable()" placeholder="Zoeken naar klanten..." title="Type in a name">
            </form>
        </div>
    </div>

    <table id="myTable">
        <tr class="header">
            <th style="width:20%;">Naam</th>
            <th style="width:20%;">Email</th>
            <th style="width:20%;">Adres</th>
            <th style="width:10%;">Postcode</th>
            <th style="width:10%;">Woonplaats</th>
            <th style="width:10%;">Bewerken</th>
            <th style="width:10%;">Verwijderen</th>
        </tr>
        <?php
        try {
            $stmt = $conn->query("SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM klant");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['klantNaam']) . "</td>";
                echo "<td>" . htmlspecialchars($row['klantEmail']) . "</td>";
                echo "<td>" . htmlspecialchars($row['klantAdres']) . "</td>";
                echo "<td>" . htmlspecialchars($row['klantPostcode']) . "</td>";
                echo "<td>" . htmlspecialchars($row['klantWoonplaats']) . "</td>";
                echo "<td>";
                echo "<form method='post' action='delete.php'>";
                echo "<input type='hidden' name='klantId' value='" . htmlspecialchars($row['klantId']) . "'>";
                echo "<button type='submit' name='verwijderen' class='red-button'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='get' action='update.php'>";
                echo "<input type='hidden' name='klantId' value='" . htmlspecialchars($row['klantId']) . "'>";
                echo "<button type='submit' name='update' class='blue-button'>Update</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='7'>Query failed: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
    </table>

    <script>
    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
    </script>
</body>
</html>
