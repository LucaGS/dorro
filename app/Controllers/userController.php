<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Views\Response;

class UserController
{
    private $response;
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
        $this->response = new Response();
    }

    // Method to list users
    public function listUsers()
    {
        // Daten aus dem Model abrufen
        $users = $this->userModel->getAllUsers();

        // View laden und Daten übergeben
        $this->response->sendResponse("usersFound", "hi mom", ($users));
    }

    public function registerUser()
    {
        // Daten validieren
        if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $this->response->sendResponse("error", "Invalid input", null);
            return;
        }
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Benutzer erstellen
        $userid = $this->userModel->createUser($username, $email, $password);

        if ($userid) {
            $this->userModel->createUserPointCount($userid);
            $this->response->sendResponse("success", "User registered successfully", $userid);
        } else {
            $this->response->sendResponse("error", "User registration failed", null);
        }
    }
    public function LoginUser(){
        if (!isset($_POST["email"], $_POST["password"])) {
            $this->response->sendResponse("error", "Invalid input", null);
            return;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->userModel->getUserByEmail($email, $password);
        if ($user) {
            $this->response->sendResponse("success","", $user);
        }


    }
    public function updatePoints() {
        if (!isset($_POST["userId"], $_POST["points"])) {
            $this->response->sendResponse("error", "Missing arguments", null);
            return;
        }
        
        $userId = $_POST["userId"];
        $points = $_POST["points"];
        
        if ($this->userModel->updateUserPointCount($userId, $points)) {
            $this->response->sendResponse("success", "Points updated successfully", null);
        } else {
            $this->response->sendResponse("error", "Failed to update points", null);
        }
    }


}
?>