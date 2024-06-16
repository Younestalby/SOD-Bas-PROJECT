<?php
// auteur: Younes Et-Talby
// functie: Alle functies van verkooporder definiëren

namespace Bas\classes;

use PDO;
use PDOException;
use Exception;

class Verkooporder {
    private $conn;
    private $table = 'verkoop';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crudVerkoop(): void {
        $lijst = $this->getVerkoop();
        $this->showTable($lijst);
    }

    public function showTable($lijst): void {
        $txt = "<table id='dataTable'>"; // Add an id to the table for easier JavaScript manipulation
        $txt .= "<tr>";
        $txt .= "<th>klantNaam</th>";
        $txt .= "<th>artOmschrijving</th>";
        $txt .= "<th>verkOrdDatum</th>";
        $txt .= "<th>verkOrdBestAantal</th>";
        $txt .= "<th>verkOrdStatus</th>";
        $txt .= "<th>Bewerken</th>";
        $txt .= "<th>Verwijderen</th>";
        $txt .= "</tr>";

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . htmlspecialchars($row["klantNaam"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["artOmschrijving"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["verkOrdDatum"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["verkOrdBestAantal"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["verkOrdStatus"]) . "</td>";
            $txt .= "<td>";
            $txt .= "<form method='post' action='upverkoop.php?verkOrdId=" . htmlspecialchars($row['verkOrdId']) . "'>";
            $txt .= "<input type='hidden' name='verkOrdId' value='" . htmlspecialchars($row['verkOrdId']) . "'>";
            $txt .= "<button type='submit' name='update'>Update</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "<td>";
            $txt .= "<form method='post' action='../verkooporder/delverkoop.php'>";
            $txt .= "<input type='hidden' name='verkOrdId' value='" . htmlspecialchars($row['verkOrdId']) . "'>";
            $txt .= "<button type='submit' name='verwijderen'>Verwijderen</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    public function getVerkoop() {
        try {
            $sql = "SELECT verkoop.*, klant.klantNaam, artikel.artOmschrijving
                    FROM verkoop
                    INNER JOIN klant ON klant.klantId = verkoop.klantId
                    INNER JOIN artikel ON artikel.artId = verkoop.artId"; // Added missing space
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getVerkoopById($verkOrdId) {
        try {
            $sql = "SELECT verkoop.*, klant.klantNaam, artikel.artOmschrijving
                    FROM verkoop 
                    JOIN klant ON verkoop.klantId = klant.klantId 
                    JOIN artikel ON verkoop.artId = artikel.artId
                    WHERE verkOrdId = :verkOrdId;";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':verkOrdId', $verkOrdId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function toevoegenVerkoop($lijst) {
        try {
            $query = "INSERT INTO `verkoop` (`klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`)
                      VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':klantId', $lijst['klantId'], PDO::PARAM_INT);
            $stmt->bindParam(':artId', $lijst['artId'], PDO::PARAM_INT);
            $stmt->bindParam(':verkOrdDatum', $lijst['verkOrdDatum']);
            $stmt->bindParam(':verkOrdBestAantal', $lijst['verkOrdBestAantal'], PDO::PARAM_INT);
            $stmt->bindParam(':verkOrdStatus', $lijst['verkOrdStatus'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Verkooporder succesvol toegevoegd.";
            } else {
                throw new PDOException("Data insertion failed.");
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteVerkoop($verkOrdId) {
        try {
            $this->conn->beginTransaction();

            $stmt1 = $this->conn->prepare("DELETE FROM verkoop WHERE verkOrdId = :verkOrdId");
            $stmt1->bindParam(':verkOrdId', $verkOrdId, PDO::PARAM_INT);

            if ($stmt1->execute()) {
                $this->conn->commit();
                return true;
            } else {
                throw new Exception("Failed to delete row from verkoop: " . implode(":", $stmt1->errorInfo()));
            }
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function updateVerkoop(array $row): bool {
        if (!isset($row['verkOrdId']) || empty($row['verkOrdId'])) {
            echo "Geen verkOrdId opgegeven.";
            return false;
        }

        try {
            $query = "UPDATE verkoop SET 
                      klantId = :klantId, 
                      artId = :artId, 
                      verkOrdDatum = :verkOrdDatum, 
                      verkOrdBestAantal = :verkOrdBestAantal, 
                      verkOrdStatus = :verkOrdStatus 
                      WHERE verkOrdId = :verkOrdId";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':klantId', $row['klantId'], PDO::PARAM_INT);
            $stmt->bindParam(':artId', $row['artId'], PDO::PARAM_INT);
            $stmt->bindParam(':verkOrdDatum', $row['verkOrdDatum']);
            $stmt->bindParam(':verkOrdBestAantal', $row['verkOrdBestAantal'], PDO::PARAM_INT);
            $stmt->bindParam(':verkOrdStatus', $row['verkOrdStatus'], PDO::PARAM_INT);
            $stmt->bindParam(':verkOrdId', $row['verkOrdId'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Er is een fout opgetreden bij het uitvoeren van de update.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function dropDownVerkoop($row_selected = -1) {
        try {
            $sql = "SELECT DISTINCT verkOrdStatus FROM verkoop";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $statusList = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<select name="verkOrdStatus" id="verkOrdStatus" required>';
            foreach ($statusList as $status) {
                $selected = ($status["verkOrdStatus"] == $row_selected) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($status['verkOrdStatus']) . "' $selected>" . htmlspecialchars($status['verkOrdStatus']) . "</option>";
            }
            echo '</select><br>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
