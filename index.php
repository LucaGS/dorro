<?php
// List all directories and files recursively

function listDirectories($path, $level = 0) {
    $indent = str_repeat("  ", $level); // Two spaces per level for indentation
    
    // List directories first
    $directories = glob($path . '/*', GLOB_ONLYDIR);
    foreach ($directories as $dir) {
        echo $indent . "└── 📁 " . basename($dir) . "\n";
        // Recursively list contents of subdirectory
        listDirectories($dir, $level + 1);
    }
    
    // Then list files
    $files = array_filter(glob($path . '/*'), 'is_file');
    foreach ($files as $file) {
        echo $indent . "└── 📄 " . basename($file) . "\n";
    }
}

echo "Directory Structure:\n";
listDirectories(__DIR__);

require_once __DIR__ . '/autoloader.php';
require_once __DIR__ .'/config/database.php';
use app\Controllers\UserController;
use app\Controllers\RoutineController;
use app\Controllers\ActivityController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = getDatabaseConnection2();
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



