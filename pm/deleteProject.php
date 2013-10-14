<?php

require_once 'classes/Database.php';

$taskID=$_POST["projectID"];

$database = dbConnect();
function dbConnect(){
    try {
        $database = new Database();
        return $database;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
}

try { 
    $bob = $database->delete("projects", array('ProjectID'=>$_POST["projectID"]));
} catch (Exception $e) {
    echo "</br>";
    echo $e->getMessage();
    exit(1);
}
?>