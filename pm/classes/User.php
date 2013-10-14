<?php
class User{

    public $userID;
    public $username;
    public $projects;

    public function __construct($userID, $username, $projects = null) {
        $this->userID = $userID;
        $this->username = $username;
        $this->projects = $projects;
    }
        
    public function getUserID(){
        return $this->userID;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getProjects(){
        return $this->projects;
    }
    
    public function setProjects($projects){
        $this->projects = $projects;
    }
}
?>