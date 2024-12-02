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
    public function RegisterUser($username, $email, $password)
    {
        try {
            $user = $this->userModel->addUser($username, $password, $email);
            sendResponse("", "Neuer Benutzer hinzugefügt", json_encode($user));
        } catch (Exception $e) {
            echo "Fehler: " . $e->getMessage();
        }

    }
}
?>