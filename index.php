<?php
// Überprüfen, ob der Parameter 'name' in der URL übergeben wurde
if (isset($_GET['name'])) {
    $name = $_GET['name'];  // Den Wert des Parameters 'name' auslesen
    echo "Hallo, " . htmlspecialchars($name) . "!";
} else {
    echo "Bitte gib deinen Namen in der URL an, z. B. ?name=John";
}
?>
