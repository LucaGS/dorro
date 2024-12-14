<?php
namespace App\Models;
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
    
}