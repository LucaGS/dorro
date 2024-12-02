<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controller/userController.php';
require_once __DIR__ . '/app/Models/userModel.php';

$conn = getDatabaseConnection();
if ($conn) {
    echo "Datenbankverbindung erfolgreich!";
} else {
    echo "Verbindung fehlgeschlagen.";
}
?>