<?php
require_once __DIR__ . '/config/database.php';


$conn = getDatabaseConnection();
if ($conn) {
    echo "Datenbankverbindung erfolgreich!";
} else {
    echo "Verbindung fehlgeschlagen.";
}
?>