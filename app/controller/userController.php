<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    // Methode, um alle Benutzer anzuzeigen
    public function listUsers() {
        // Daten aus dem Model abrufen
        $users = $this->userModel->getAllUsers();
        echo 'test';
        // View laden und Daten übergeben
        require_once __DIR__ . '/../views/userList.php';
    }
}
?>
