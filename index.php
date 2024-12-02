<?php
require_once __DIR__ . '/config/database.php';

$conn = getDatabaseConnection();

if ($conn) {
    echo "Datenbankverbindung erfolgreich!";
    // Hier kannst du mit $conn arbeiten, z. B. Abfragen ausführen
} else {
    echo "Verbindung fehlgeschlagen.";
}
?>
