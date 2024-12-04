<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/controller/userController.php';
require_once __DIR__ . '/app/controller/routineController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = getDatabaseConnection();
$userController = new UserController($conn);
$routineController = new RoutineController($conn);
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'ListUser':
            $userController->listUsers();
            break;
        case 'LoginUser':
            $username = $_GET['username'];
            $password = $_GET['password'];
            $userController->LoginUser($username, $password);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'RegisterUser':
            $userController->registerUser();
            break;
        case'addRoutine':
            $routineController->AddUserRoutine();
            break;

    }
}



?>