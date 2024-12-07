<?php
namespace App\Controllers;
use App\Models\activityModel;
use app\Views\Response;
class ActivityController
{
    private $activityModel;
    private $response;
    public function __construct($db)
    {
        $this->activityModel = new activityModel($db);
        $this->response = new Response();
    }
    public function AddActivityToRoutine(){
        #$activity_name, $activity_description, $routine_id, $position, $duration,$min_duration,$points
        $activity_name = $_POST["activity_name"];
        $activity_description = $_POST["activity_description"];
        $routine_id = $_POST["routine_id"];
        $position = $_POST["position"];
        $duration = $_POST["duration"];
        $min_duration = $_POST["min_duration"];
        $points =$_POST["points"];

        $activity = $this->activityModel->create($activity_name,$activity_description,$routine_id,$position,$duration,$min_duration,$points);
        if($activity){
            $this->response->sendResponse("success","Creaated:".$activity_name);
        }
        else {
            $this->response->sendResponse("error", "Adding activity Failed", $activity);
        }
    }
    public function GetRoutineActivitys(){
        $routine_id = $_GET["routine_id"];
        $activitys = $this->activityModel->GetAllRoutineActivitys($routine_id);
        if($activitys){
            $this->response->sendResponse("success","amount of activitys:".sizeof($activitys), $activitys);
        }
    }
}