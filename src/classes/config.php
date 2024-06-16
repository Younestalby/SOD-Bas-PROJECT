<?php

// Functie: connecten met de database
define("DATABASE", "bas_database");
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

function getConnection() {
    try {
        $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
        // Zet de PDO foutmodus op uitzondering
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}
?>
