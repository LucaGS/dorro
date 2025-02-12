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

    // Insert-Query mit LAST_INSERT_ID
    $query = "INSERT INTO User (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($this->db, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPassword);

    if (!mysqli_stmt_execute($stmt)) {
        return false;
    }

    // Direkt die zuletzt eingefügte ID abrufen
    $userId = mysqli_insert_id($this->db);
    return ['userid' => $userId];
    }
    public function createUserPointCount($userId){
        $userStartingPointCount = 0;
        $query = "INSERT INTO user_points(user_id,count)VALUES(?,?)";
        $stmt = mysqli_prepare($this->db,$query);
        mysqli_stmt_bind_param($stmt,'ii',$userId,$userStartingPointCount);
        mysqli_stmt_execute($stmt);
    }
    public function updateUserPointCount($userId, $points){
        $query = "UPDATE userpoints SET count = count + (?) WHERE userid = (?)";
        $stmt = mysqli_prepare($this->db,$query);
        mysqli_stmt_bind_param($stmt,'ii',$userId,$points);
        if(!mysqli_stmt_execute($stmt)){
            return false;
        }
    }

    public function getUserByEmail($email, $password)
    {
        $query = "SELECT * FROM User WHERE email = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            // Debugging-Ausgabe
            error_log("Benutzer gefunden rr: " . json_encode($row));
            
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