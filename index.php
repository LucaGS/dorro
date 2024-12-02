<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controller/userController.php';
require_once __DIR__ . '/app/Models/userModel.php';

$conn = getDatabaseConnection();
$userController = new UserController($conn);
if ($conn) {
    echo "Datenbankverbindung erfolgreich!";
    $userController->listUsers();
} else {
    echo "Verbindung fehlgeschlagen.";
}


?>