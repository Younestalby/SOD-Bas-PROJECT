<?php
// Auteur: Younes Et-Talby
// Functie: unit tests class Klant

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;
use Bas\classes\Database;

// Filename moet gelijk zijn aan de classname KlantTest
class KlantTest extends TestCase {

    protected $klant;
    protected $conn;

    protected function setUp(): void {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->klant = new Klant($this->conn);
    }

    protected function tearDown(): void {
        $this->klant = null;
        $this->conn = null;
    }

    // Methods moeten starten met de naam test....
    public function testGetKlanten() {
        $klanten = $this->klant->getKlanten();
        $this->assertIsArray($klanten, "getKlanten moet een array retourneren.");
        $this->assertGreaterThan(0, count($klanten), "Aantal klanten moet groter dan 0 zijn.");
    }

    public function testGetKlant() {
        $klantId = 1; // Zorg ervoor dat dit ID echt in de database bestaat!
        $klant = $this->klant->getKlant($klantId);
        $this->assertIsArray($klant, "getKlant moet een array retourneren.");
        $this->assertEquals($klantId, $klant['klantId'], "Klant ID moet overeenkomen met het opgegeven ID.");
    }

    public function testGetKlantWithNonExistingId() {
        $klantId = 99999; // Zorg ervoor dat dit ID niet in de database bestaat
        $klant = $this->klant->getKlant($klantId);
        $this->assertNull($klant, "getKlant moet null retourneren voor een niet-bestaand ID.");
    }
}
?>
