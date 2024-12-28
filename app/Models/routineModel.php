<?php 
namespace App\Models;

use FFI\Exception;
class RoutineModel{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getDb(){
        return $this->db;
    }
    public function createRoutine($routine_name, $routine_type, $user_id, $description = "description") {
        $query = "INSERT INTO routines(routine_name, type, user_id, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'ssis', $routine_name, $routine_type, $user_id, $description);
        if (mysqli_stmt_execute($stmt)) {
            return mysqli_insert_id($this->db);
        } else {
            return false;
        }
    }
    
    public function getRoutinesByUserId($user_id): array{
        $query = 'SELECT * FROM routines WHERE user_id = ?';
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception('Failed to execute the statement: ' . mysqli_stmt_error($stmt));
        }
        $result = mysqli_stmt_get_result($stmt);
        $routines = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $routines[] = $row;
            }
        }
        return $routines;
    }
    public function DeleteUserRoutine($routine_id): bool{
        $query = 'DELETE * FROM routines WHERE routine_id = ?';
        $stmt = mysqli_prepare($this->db, $query);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i',$routine_id);
            mysqli_stmt_execute($stmt); 
             $result = mysqli_stmt_get_result($stmt);
              if($result){
                return true;
              }
             
        }
        return false;
    }
    
}