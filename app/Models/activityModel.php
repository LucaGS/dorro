<?php
namespace App\Models;

use Exception;
class activityModel{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create($activity_name,$activity_description, $routine_id, $position, $duration,$min_duration,$points){
        $query = "INSERT INTO activitys(activity_name,activity_description,routine_id,position,duration,min_duration,points) values(?,?,?,?,?,?,?)";  
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'ssiissi', $activity_name, $activity_description, $routine_id, $position, $duration,$min_duration,$points);
         if (mysqli_stmt_execute($stmt)) {
             return true;
         } else {
             return false;
         }
     }
     public function GetAllRoutineActivitys($routine_id):array {
        $activitys = [];
        $query = 'SELECT * FROM activitys WHERE routine_id = ? ORDER BY position';
        $stmt = mysqli_prepare($this->db, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $routine_id);
            mysqli_stmt_execute($stmt); // Statement ausführen
            $result = mysqli_stmt_get_result($stmt); // Ergebnis abrufen  
            
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $activitys[] = $row; // Ergebnisse sammeln
                }
            }
            
            mysqli_stmt_close($stmt); // Statement schließen
        }
        
        return $activitys;
    }
    public function DeleteRoutineActivity($activity_id){
        // Remove the * after DELETE
        $query = 'DELETE FROM activitys WHERE activity_id = ?';
        $stmt = mysqli_prepare($this->db, $query);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $activity_id);
            mysqli_stmt_execute($stmt); 
            // For DELETE queries, we don't need to get a result
            // Just check if the execution was successful
            if(mysqli_stmt_affected_rows($stmt) > 0){
                return true;
            }
        }
        return false; // Add explicit return false for error cases
    }
    public function UpdateRoutineActivityPositions($routine_id,$positions){
         // Start transaction
    mysqli_begin_transaction($this->db);
    
    try {
        $query = "UPDATE activitys SET position = ? WHERE activity_id = ? AND routine_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        
        foreach ($positions as $position) {
                mysqli_stmt_bind_param($stmt, 'iii', 
                    $position['new_position'],
                $position['activity_id'],
                $routine_id
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Failed to update position");
            }
        }
        
        // If we get here, all updates were successful
        mysqli_commit($this->db);
        return true;
        
    } catch (Exception $e) {
        // If anything fails, rollback all changes
        mysqli_rollback($this->db);
        return false;
    } finally {
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
    }
    }
    
}