<?php
// Auteur: Younes Et-Talby
// Functie: Verbinding maken met de database
namespace Bas\classes;

use PDO;
use PDOException;

require_once "config.php";

class Database {
    protected static $conn = null;

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "bas_database";

    public function __construct() {
        if (self::$conn === null) {
            $this->connect();
        }
    }

    private function connect() {
        try {
            self::$conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connectie mislukt: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return self::$conn;
    }
}
?>
