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
        sendResponse("usersFound", "hi mom", ($users));
    }

    public function registerUser()
    {
        // Daten validieren
        if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            sendResponse("error", "Invalid input", null);
            return;
        }
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Benutzer erstellen
        $success = $this->userModel->createUser($username, $email, $password);

        if ($success) {
            sendResponse("success", "User registered successfully", null);
        } else {
            sendResponse("error", "User registration failed", null);
        }
    }
    public function LoginUser($username, $password){
        $user = $this->userModel->getUserByName($username, $password);
        if ($user) {
            sendResponse("success","", $user);
        }


    }


}
?>