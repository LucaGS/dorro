<?php
namespace App\Controllers;
use App\Models\RoutineModel;
use App\Views\Response;


class RoutineController
{
    private $routineModel;
    private $response;
    public function __construct($db)
    {
        $this->routineModel = new RoutineModel($db);
        $this->response = new Response();
    }
    public function AddUserRoutine(){
        // First verify all required parameters are present
        if (!isset($_POST['routine_name']) || !isset($_POST['routine_type']) || 
            !isset($_POST['description']) || !isset($_POST['user_id'])) {
            $this->response->sendResponse("error", "Missing required parameters");
            return;
        }

        $routine_name = $_POST['routine_name'];
        $routine_type = $_POST['routine_type'];
        $description = $_POST['description'];
        $user_id = $_POST["user_id"];
        
        $routineid = $this->routineModel->createRoutine($routine_name, $routine_type, $user_id, $description);
        if($routineid) {
            $this->response->sendResponse("success", "Created routine with ID: " . $routineid);
        } else {
            // Add error message from database
            $this->response->sendResponse("error", "Failed to create routine: " . mysqli_error($this->routineModel->db));
        }
    }
    public function GetUserRoutines(){
        $user_id = $_GET["user_id"];
       $routines = $this->routineModel->getRoutinesByUserId($user_id);
       if($routines){
        $this->response->sendResponse("success","received User Routines", $routines);
       }else{
        $this->response->sendResponse("Failed","");
       }
    }
}