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
        #$routine_name,$routine_type, $user_id, $description = "description"
        $routine_name = $_POST['routine_name'];
        $routine_type = $_POST['routine_type'];
        $description = $_POST['description'];
        $user_id = $_POST["user_id"];
        $routine = $this->routineModel->createRoutine($routine_name, $routine_type, $user_id, $description);
        if($routine){
            $this->response->sendResponse("success","Creaated:".$routine_name);
        }
    }
    public function GetUserRoutines($user_id){
       
    }
}