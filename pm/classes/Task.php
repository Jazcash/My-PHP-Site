<?php
class Task
{
    public $taskID;
    public $projectID;
    public $name;
    public $description;
    public $deadline;
    public $created;
    public $lastModified;
    public $completedOn;

    public function __construct($taskID, $projectID, $name, $description, $deadline, $created, $lastModified, $completedOn) {
        $this->taskID = $taskID;
        $this->projectID = $projectID;
        $this->name = $name;
        $this->description = $description;
        $this->deadline = $deadline;
        $this->created = $created;
        $this->lastModified = $lastModified;
        $this->completedOn = $completedOn;
    }
        
    public function getTaskID(){
        return $this->taskID;
    }
    
    public function getProjectID(){
        return $this->projectID;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getDeadline($part = null){
        if (isset($part) && $this->deadline !== null) {
            return date($part, strtotime($this->deadline));
        } else {
            return $this->deadline;
        }
    }
    
    public function getCreated(){
        return $this->created;
    }
    
    public function getLastModified(){
        return $this->lastModified;
    }
    
    public function getCompletedOn(){
        return $this->completedOn;
    }
}
?>