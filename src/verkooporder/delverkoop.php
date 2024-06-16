<?php 
// auteur: Younes Et-Talby
// functie: Artikel verwijderen
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;

// Initialize PDO connection
$dsn = 'mysql:host=localhost;dbname=bas_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pass the PDO object to the Verkooporder class constructor
    $verkooporder = new Verkooporder($pdo);

    if (isset($_POST['verwijderen'])) {
        $verkOrdId = $_POST['verkOrdId'];

        if (empty($verkOrdId)) {
            echo '<script>alert("Geen Artikel ID ontvangen")</script>';
            exit;
        }

        echo "Artikel ID to delete: " . $verkOrdId . "<br>";

        // Call the deleteVerkoop method
        $success = $verkooporder->deleteVerkoop($verkOrdId);

        // Check the result of the delete operation
        if ($success) {
            echo '<script>alert("Artikel verwijderd")</script>';
        } else {
            echo '<script>alert("Artikel verwijderen mislukt")</script>';
        }

        echo "<script> location.replace('../verkooporder/verkoop.php'); </script>";
    } else {
        echo 'Invalid request';
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
