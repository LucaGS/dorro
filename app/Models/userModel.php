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
    public function addUser($username, $password, $email)
    {
        // Escape die Eingabewerte, um SQL-Injections zu verhindern
        $username = mysqli_real_escape_string($this->db, $username);
        $password = mysqli_real_escape_string($this->db, $password);
        $email = mysqli_real_escape_string($this->db, $email);

        // Passwort verschlüsseln (empfohlen: password_hash verwenden)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert Query
        $query = "INSERT INTO User (username, password, email) 
                  VALUES ('$username', '$hashedPassword', '$email')";

        $result = mysqli_query($this->db, $query);

        if (!$result) {
            // Fehlerbehandlung bei SQL-Fehler
            throw new Exception("Fehler beim Hinzufügen des Benutzers: " . mysqli_error($this->db));
        }

        // Die zuletzt eingefügte ID abrufen
        $userId = mysqli_insert_id($this->db);

        // Den vollständigen Benutzer aus der Datenbank abrufen
        $query = "SELECT * FROM User WHERE id = $userId";
        $result = mysqli_query($this->db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            throw new Exception("Fehler beim Abrufen des neuen Benutzers.");
        }
    }

}
?>