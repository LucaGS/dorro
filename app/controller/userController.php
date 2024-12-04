<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../Views/response.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    // Methode, um alle Benutzer anzuzeigen
    public function listUsers()
    {
        // Daten aus dem Model abrufen
        $users = $this->userModel->getAllUsers();

        // View laden und Daten übergeben
        sendResponse("usersFound", "hi mom", json_encode($users));
    }
    public function registerUser()
    {
        $data = json_decode($_POST);
        if (!isset($data['username'], $data['email'], $data['password'])) {
            sendResponse("error", "Invalid input", null);
            return;
        }

        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];

        // Benutzer erstellen
        $success = $this->userModel->createUser($username, $email, $password);

        if ($success) {
            sendResponse("success", "User registered successfully", null);
        } else {
            sendResponse("error", "User registration failed", null);
        }
    }


}
?>