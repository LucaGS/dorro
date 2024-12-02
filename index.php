<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controller/userController.php';

$conn = getDatabaseConnection();
if ($conn) {
    echo "Datenbankverbindung erfolgreich!";
} else {
    echo "Verbindung fehlgeschlagen.";
}
?>