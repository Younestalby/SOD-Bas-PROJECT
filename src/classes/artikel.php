<?php
// Auteur: Younes Et-Talby
// Functie: Alle functies van artikel definiëren

namespace Bas\classes;

use PDO;
use PDOException;
use Exception;

class Artikel {
    private $conn;
    private $table = 'artikel';

    public function __construct() {
        $this->conn = getConnection();
    }

    public function crudArtikel(): void {
        $artikelen = $this->getArtikelen();
        $this->toonTabel($artikelen);
    }

    public function toonTabel(array $artikelen): void {
        $html = "<table id='dataTable'>";
        $html .= "<tr>
                    <th>artOmschrijving</th>
                    <th>artInkoop</th>
                    <th>artVerkoop</th>
                    <th>artVoorraad</th>
                    <th>artMinVoorraad</th>
                    <th>artMaxVoorraad</th>
                    <th>artLocatie</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                  </tr>";

        foreach ($artikelen as $artikel) {
            $html .= "<tr>
                        <td>" . htmlspecialchars($artikel["artOmschrijving"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artInkoop"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artVerkoop"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artVoorraad"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artMinVoorraad"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artMaxVoorraad"]) . "</td>
                        <td>" . htmlspecialchars($artikel["artLocatie"]) . "</td>
                        <td>
                            <form method='get' action='updart.php'>
                                <input type='hidden' name='artId' value='" . htmlspecialchars($artikel['artId']) . "'>
                                <button type='submit' name='update'>Update</button>
                            </form>
                        </td>
                        <td>
                            <form method='post' action='delart.php'>
                                <input type='hidden' name='artId' value='" . htmlspecialchars($artikel['artId']) . "'>
                                <button type='submit' name='verwijderen'>Verwijderen</button>
                            </form>
                        </td>
                      </tr>";
        }

        $html .= "</table>";
        echo $html;
    }

    public function getArtikelen(): array {
        try {
            $sql = "SELECT * FROM artikel";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getArtikelById(int $artId): ?array {
        try {
            $sql = "SELECT * FROM artikel WHERE artId = :artId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':artId', $artId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function toevoegenArtikel(array $gegevens): void {
        try {
            $sql = "INSERT INTO artikel (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                    VALUES (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':artOmschrijving', $gegevens['artOmschrijving']);
            $stmt->bindParam(':artInkoop', $gegevens['artInkoop']);
            $stmt->bindParam(':artVerkoop', $gegevens['artVerkoop']);
            $stmt->bindParam(':artVoorraad', $gegevens['artVoorraad']);
            $stmt->bindParam(':artMinVoorraad', $gegevens['artMinVoorraad']);
            $stmt->bindParam(':artMaxVoorraad', $gegevens['artMaxVoorraad']);
            $stmt->bindParam(':artLocatie', $gegevens['artLocatie']);

            if ($stmt->execute()) {
                echo "Artikel succesvol toegevoegd.";
            } else {
                throw new PDOException("Data insertion failed.");
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteArtikel(int $artId): bool {
        try {
            $sql = "DELETE FROM artikel WHERE artId = :artId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':artId', $artId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Artikel succesvol verwijderd.";
                return true;
            } else {
                throw new Exception("Failed to delete row from artikel: " . implode(":", $stmt->errorInfo()));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function updateArtikel(array $gegevens): bool {
        try {
            $sql = "UPDATE artikel SET 
                      artOmschrijving = :artOmschrijving, 
                      artInkoop = :artInkoop, 
                      artVerkoop = :artVerkoop, 
                      artVoorraad = :artVoorraad, 
                      artMinVoorraad = :artMinVoorraad, 
                      artMaxVoorraad = :artMaxVoorraad, 
                      artLocatie = :artLocatie
                    WHERE artId = :artId";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':artOmschrijving', $gegevens['artOmschrijving']);
            $stmt->bindParam(':artInkoop', $gegevens['artInkoop']);
            $stmt->bindParam(':artVerkoop', $gegevens['artVerkoop']);
            $stmt->bindParam(':artVoorraad', $gegevens['artVoorraad']);
            $stmt->bindParam(':artMinVoorraad', $gegevens['artMinVoorraad']);
            $stmt->bindParam(':artMaxVoorraad', $gegevens['artMaxVoorraad']);
            $stmt->bindParam(':artLocatie', $gegevens['artLocatie']);
            $stmt->bindParam(':artId', $gegevens['artId'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Artikel succesvol bijgewerkt.";
                return true;
            } else {
                throw new PDOException("Data update failed.");
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
