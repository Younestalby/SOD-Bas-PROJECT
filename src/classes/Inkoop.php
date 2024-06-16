<?php
// auteur: Younes Et-Talby
// functie: Alle functies voor inkoop defineren
namespace Bas\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Inkoop extends Database {
    private $table = "inkoop";

    public $inkOrdDatum;
    public $inkOrdBestAantal;
    public $inkOrdStatus;

    public function __construct() {
        parent::__construct();
    }

    public function getInkoopen() {
        $sql = "SELECT * FROM inkoop
                INNER JOIN leveranciers ON leveranciers.levId = inkoop.levId
                INNER JOIN artikel ON artikel.artId = inkoop.artId";
        $result = self::$conn->prepare($sql);
        $result->execute();
        $data = $result->fetchAll();
        return $data;
    }

    public function getInkoopById($id) {
        $query = "SELECT * FROM " . $this->table . " 
                  INNER JOIN leveranciers ON leveranciers.levId = inkoop.levId
                  INNER JOIN artikel ON artikel.artId = inkoop.artId
                  WHERE inkOrdId = :id";
        $stmt = self::$conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInkoop($data) {
        try {
            $query = "UPDATE " . $this->table . " 
                      SET levId = :levId, artId = :artId, inkOrdDatum = :inkOrdDatum, 
                          inkOrdBestAantal = :inkOrdBestAantal, inkOrdStatus = :inkOrdStatus 
                      WHERE inkOrdId = :inkOrdId";

            $stmt = self::$conn->prepare($query);
            $stmt->bindParam(':levId', $data["levId"]);
            $stmt->bindParam(':artId', $data["artId"]);
            $stmt->bindParam(':inkOrdDatum', $data["inkOrdDatum"]);
            $stmt->bindParam(':inkOrdBestAantal', $data["inkOrdBestAantal"]);
            $stmt->bindParam(':inkOrdStatus', $data["inkOrdStatus"]);
            $stmt->bindParam(':inkOrdId', $data["inkOrdId"]);

            if ($stmt->execute()) {
                return true;
            } else {
                printf("Error: %s.\n", $stmt->errorInfo()[2]);
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteInkoop($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE inkOrdId = :id";
            $stmt = self::$conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                printf("Error: %s.\n", $stmt->errorInfo()[2]);
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function toevoegenInkopen($data) {
        $query = "INSERT INTO inkoop (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) 
                  VALUES (:levId, :artId, :inkOrdDatum, :inkOrdBestAantal, :inkOrdStatus)";
         
        $stmt = self::$conn->prepare($query);
        $stmt->bindParam(':levId', $data["levId"]);
        $stmt->bindParam(':artId', $data["artId"]);
        $stmt->bindParam(':inkOrdDatum', $data["inkOrdDatum"]);
        $stmt->bindParam(':inkOrdBestAantal', $data["inkOrdBestAantal"]);
        $stmt->bindParam(':inkOrdStatus', $data["inkOrdStatus"]);
        
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }

    public function showTable($lijst) {
        $txt = "<table>";
        $txt .= "<th>levNaam</th>";
        $txt .= "<th>artOmschrijving</th>";
        $txt .= "<th>inkOrdDatum</th>";
        $txt .= "<th>inkOrdBestAantal</th>";
        $txt .= "<th>inkOrdStatus</th>";
        $txt .= "<th>Bewerken</th>";
        $txt .= "<th>Verwijderen</th>";
        $txt .= "</tr>";

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["levNaam"] . "</td>";
            $txt .= "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .= "<td>" . $row["inkOrdDatum"] . "</td>";
            $txt .= "<td>" . $row["inkOrdBestAantal"] . "</td>";
            $txt .= "<td>" . $row["inkOrdStatus"] . "</td>";
            $txt .= "<td>";
            $txt .= "<form method='get' action='updateink.php'>";
            $txt .= "<input type='hidden' name='id' value='" . $row['inkOrdId'] . "'>";
            $txt .= "<button type='submit' name='update'>Update</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "<td>";
            $txt .= "<form method='post' action='deleteink.php'>";
            $txt .= "<input type='hidden' name='id' value='" . $row['inkOrdId'] . "'>";
            $txt .= "<button type='submit' name='verwijderen'>Verwijderen</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    public function crudinkoop(): void {
        $lijst = $this->getInkoopen();
        $this->showTable($lijst);
    }
}
?>
