<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controller/userController.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = getDatabaseConnection();
$userController = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'ListUser':
            $userController->listUsers();
            break;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'RegisterUser':
            $userController->registerUser();
            break;
    }
}



?>