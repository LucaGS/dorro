<?php
namespace app\Controllers;
use app\Models\ActivityModel;
use app\Views\Response;
class ActivityController
{
    private $activityModel;
    private $response;
    public function __construct($db)
    {
        $this->activityModel = new ActivityModel($db);
        $this->response = new Response();
    }
    public function AddActivityToRoutine(){
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
    public function DeleteActivity(){
        $activity_id = $_GET['activity_id'];
        $result = $this->activityModel->DeleteRoutineActivity($activity_id);
        if($result){
            $this->response->sendResponse('success','Deleted the activity with the id '.$activity_id);
        }else{
            $this->response->sendResponse('error','could not delete the acitiviy:'. $activity_id, $activity_id);
        }
        
    }
    public function UpdateActivityPositions() {
        // Ensure required POST parameters exist
        if (!isset($_POST['routine_id']) || !isset($_POST['positions'])) {
            $this->response->sendResponse('error', 'Missing required parameters');
            return;
        }
    
        $routine_id = $_POST['routine_id'];
        $positions = json_decode($_POST['positions'], true);
    
        // Validate JSON decoding
        if (!$positions) {
            $this->response->sendResponse('error', 'Invalid positions data format');
            return;
        }
    
        // If positions is a single object, wrap it in an array
        if (isset($positions['activity_id'])) {
            $positions = [$positions];
        }
    
        $result = $this->activityModel->UpdateRoutineActivityPositions($routine_id, $positions);
        
        if ($result) {
            $this->response->sendResponse('success', 'Positions updated successfully');
        } else {
            $this->response->sendResponse('error', 'Failed to update positions');
        }
    }
    

}
