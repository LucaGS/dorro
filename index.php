<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controllers/UserController.php';

// Datenbankverbindung herstellen
$db = getDatabaseConnection();

// Controller initialisieren
$userController = new UserController($db);

// Benutzerliste anzeigen
$userController->listUsers();
?>
