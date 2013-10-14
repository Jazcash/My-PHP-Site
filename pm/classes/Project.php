<?php
class Project{

    public $projectID;
    public $userID;
    public $name;
    public $description;
    public $created;
    public $lastModified;
    public $tasks;

    public function __construct($projectID, $userID, $name, $description, $created, $lastModified, $tasks = null) {
        $this->projectID = $projectID;
        $this->userID = $userID;
        $this->name = $name;
        $this->description = $description;
        $this->created = $created;
        $this->lastModified = $lastModified;
        $this->tasks = $tasks;
    }
        
    public function getProjectID(){
        return $this->projectID;
    }
    
    public function getUserID(){
        return $this->userID;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getDeadline($part = null){
        if (isset($part)) {
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
    
    public function getTasks(){
        return $this->tasks;
    }
    
    public function setTasks($tasks){
        $this->tasks = $tasks;
    }
}
?>