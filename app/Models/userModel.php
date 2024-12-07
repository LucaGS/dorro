<?php
namespace App\Models;
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
    public function getUserByName($username, $password)
    {
        $query = "SELECT * FROM User WHERE username = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            // Debugging-Ausgabe
            error_log("Benutzer gefunden: " . json_encode($row));
            
            if (isset($row['Password']) && password_verify($password, $row['Password'])) {
                unset($row['Password']);
                return $row;
            }
        }
        error_log("Benutzer oder Passwort nicht korrekt");
        return null;
    }
    




}
?>