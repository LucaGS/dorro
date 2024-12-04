<?php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Methode, um alle Benutzer aus der Datenbank abzurufen
    public function getAllUsers()
    {

        $query = "SELECT * FROM User";
        $result = mysqli_query($this->db, $query);

        $users = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        return $users;
    }
    public function createUser($username, $email, $password)
    {
        // Passwort hashen
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO User (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }



}
?>