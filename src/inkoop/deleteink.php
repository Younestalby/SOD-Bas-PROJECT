<?php
// Auteur: Younes Et-Talby
// Functie: Verwijder inkooporder

require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Inkoop;

$database = new Database();
$db = $database->getConnection();
$inkoop = new Inkoop($db);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($inkoop->deleteInkoop($id)) {
        echo "<script>alert('Inkoop order deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete inkoop order');</script>";
    }
    echo "<script>window.location.href='inkoop.php';</script>";
} else {
    die("ID is not provided.");
}
?>
