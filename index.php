<?php
// List all subdirectories recursively
function listDirectories($path, $level = 0) {
    $indent = str_repeat("  ", $level); // Two spaces per level for indentation
    $directories = glob($path . '/*', GLOB_ONLYDIR);
    
    foreach ($directories as $dir) {
        echo $indent . "└── " . basename($dir) . "\n";
        // Recursively list subdirectories
        listDirectories($dir, $level + 1);
    }
}

echo "Directory Structure:\n";
listDirectories(__DIR__);

require_once __DIR__ . '/autoloader.php';
require_once __DIR__ .'/config/database.php';
use App\Controllers\UserController;
use App\Controllers\RoutineController;
use App\Controllers\ActivityController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = getDatabaseConnection();
$userController = new UserController($conn);
$routineController = new RoutineController($conn);
$activityController = new ActivityController($conn);
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'ListUser':
            $userController->listUsers();
            break;
        case 'ListRoutineActivitys':
            $activityController->GetRoutineActivitys();
            break;
        case 'ListUserRoutines':
            $routineController->GetUserRoutines();
            break;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'RegisterUser':
            $userController->registerUser();
            break;
        case 'addRoutine':
            $routineController->AddUserRoutine();
            break;
        case 'addActivity':
            $activityController->AddActivityToRoutine();
            break;
        case 'LoginUser':
            $userController->LoginUser();
            break;
        case 'UpdateActivityPositions':
                $activityController->UpdateActivityPositions();
                break;
        case'UpdateUserPoints':
            $userController->updatePoints();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'DeleteActivity':
            $activityController->DeleteActivity();
            break;
        case 'DeleteRoutine':
            $routineController->DeleteRoutine(); 
            break;
    }
}



