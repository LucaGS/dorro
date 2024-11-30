<?php
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Methode, um alle Benutzer aus der Datenbank abzurufen
    public function getAllUsers() {
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
}
?>
