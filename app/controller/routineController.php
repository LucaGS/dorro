<?php
require_once(__DIR__ ."/../Models/routineModel.php");

class RoutineController
{
    private $routineModel;

    public function __construct($db)
    {
        $this->routineModel = new RoutineModel($db);
    }
    public function AddUserRoutine(){
        #$routine_name,$routine_type, $user_id, $description = "description"
        $routine_name = $_POST['routine_name'];
        $routine_type = $_POST['routine_type'];
        $description = $_POST['description'];
        $user_id = $_POST["user_id"];
        $routine = $this->routineModel->createRoutine($routine_name, $routine_type, $user_id, $description);
        if($routine){
            sendResponse("success","Creaated:".$routine_name);
        }
    }
}