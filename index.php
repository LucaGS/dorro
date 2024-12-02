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
        case 'register':
            if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userController->RegisterUser($username, $email, $password);
            } else {
                echo 'Fehlende Eingabedaten';
            }
            break;
    }
}

?>