<?php 
namespace App\Models;
class RoutineModel{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function createRoutine($routine_name,$routine_type, $user_id, $description = "description"){
       $query = "INSERT INTO routines(routine_name,type,user_id,description) values(?,?,?,?)";  
       $stmt = mysqli_prepare($this->db, $query);
       mysqli_stmt_bind_param($stmt, 'ssis', $routine_name, $routine_type, $user_id, $description);
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
    public function getRoutinesByUserId($user_id){
        $query = 'SELECT * FROM routines WHERE user_id = ?';
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        $result = mysqli_stmt_get_result($stmt);
        $routines = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $routines[] = $row;
            }
        }
        return $routines;
    }
}