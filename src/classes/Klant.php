<?php
// auteur: Younes Et-Talby
// functie: Alle functies van klant defineren
namespace Bas\classes;

use Bas\classes\Database;
use PDO;
use PDOException;

include_once "functions.php";


class Klant extends Database
{
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    private $table_name = "Klant";

    public function toevoegenVerkoop($lijst)
    {
        
        try {
            
            $klantNaam = $lijst['klantNaam'];
            $klantEmail = $lijst['klantEmail'];
            $klantAdres = $lijst['klantAdres'];
            $klantPostcode = $lijst['klantPostcode'];
            $klantWoonplaats = $lijst['klantWoonplaats'];

            $query = "INSERT INTO `klant` (`klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`)
                      VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";

            $stmt = self::$conn->prepare($query);

            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

            if ($stmt->execute()) {
                echo "Klant succesvol toegevoegd.";
            } else {
                echo "Er is een fout opgetreden bij het toevoegen van de klant.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function toevoegenKlant($lijst)
    {
        
        try {
            
            $klantNaam = $lijst['klantnaam'];
            $klantEmail = $lijst['klantemail'];
            $klantAdres = $lijst['klantadres'];
            $klantPostcode = $lijst['klantpostcode'];
            $klantWoonplaats = $lijst['klantwoonplaats'];

            $query = "INSERT INTO `klant` (`klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`)
                      VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";

            $stmt = self::$conn->prepare($query);

            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

            if ($stmt->execute()) {
                echo "Klant succesvol toegevoegd.";
            } else {
                echo "Er is een fout opgetreden bij het toevoegen van de klant.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
    
     * @return void
     */
    public function crudKlant(): void
    {
        $lijst = $this->getKlanten();

        $this->showTable($lijst);
    }

    /**
     * Summary of getKlant
     * @return mixed
     */
    public function getKlanten()
    {
       
        $sql = "SELECT * FROM Klant";
        $result = self::$conn->prepare($sql);
        $result->execute();

        return $result;
    }

    /**
     * Summary of getKlant
     * @param int $klantId
     * @return mixed
     */
 

     public function dropDownKlant($row_selected = -1)
     {

         $lijst = $this->getKlanten();
  
         echo "<label for='Klant'>Kies klant:</label>";
         echo "<select name='klantId'>";
         foreach ($lijst as $row) {
             if ($row_selected == $row["klantId"]) {
                 echo "<option class='changeklantid' data-id'$row[klantId]' data-name='$row[klantNaam]' value='$row[klantId]' selected='selected'> $row[klantNaam]</option>\n";
             } else {
                 echo "<option class='changeklantid' data-id'$row[klantId]' data-name='$row[klantNaam]' value='$row[klantId]'> $row[klantNaam]</option>\n";
             }
         }
         echo "</select>";
     }

    /**
     * Summary of showTable
     * @param mixed $lijst
     * @return void
     */
    public function showTable($lijst): void {
        $txt = "<table>";
        $txt .= "<tr>";
        $txt .= "<th>klantNaam</th>";
        $txt .= "<th>klantEmail</th>";
		$txt .= "<th>klantAdres</th>";
		$txt .= "<th>klantPostcode</th>";
        $txt .= "<th>klantWoonplaats</th>";
        $txt .= "</tr>";
    
        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["klantEmail"] . "</td>";
            $txt .= "<td>" . $row["klantAdres"] . "</td>";
			$txt .= "<td>" . $row["klantPostcode"] . "</td>";
			$txt .= "<td>" . $row["klantWoonplaats"] . "</td>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }
    
        $txt .= "</table>";
        echo $txt;
    }


    /**
     * Summary of deleteKlant
     * Deletes a customer from the database.
     * @param int $klantId The ID of the customer to delete.
     * @return bool True if the deletion was successful, otherwise false.
     */
	public function deleteKlant(int $klantId): bool {
        try {
            
            $query = "DELETE FROM Klant WHERE klantId = :klantId";
            $stmt = self::$conn->prepare($query);

            $stmt->bindParam(':klantId', $klantId);

            if ($stmt->execute()) {

                return true;
            } else {
                
                return false;
            }
        } catch (PDOException $e) {
        
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

/**
     * Update klant
     * Summary: Updates a customer
     * 
     * @param array $row An array containing the updated customer information
     * @return bool True if the update was successful, otherwise false
     */
	
	public function updateKlant(array $row): bool {

		if (!isset($row['klantId']) || empty($row['klantId'])) {
		
			echo "Geen klantId opgegeven.";
			return false;
		}
		
		try {

			$klantId = $row['klantId'];
			$klantNaam = $row['klantNaam'];
			$klantEmail = $row['klantEmail'];
			$klantAdres = $row['klantAdres'];
			$klantPostcode = $row['klantPostcode'];
			$klantWoonplaats = $row['klantWoonplaats'];

			$query = "UPDATE Klant SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";

			$stmt = self::$conn->prepare($query);

			$stmt->bindParam(':klantId', $klantId);
			$stmt->bindParam(':klantNaam', $klantNaam);
			$stmt->bindParam(':klantEmail', $klantEmail);
			$stmt->bindParam(':klantAdres', $klantAdres);
			$stmt->bindParam(':klantPostcode', $klantPostcode);
			$stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

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
}

?>
