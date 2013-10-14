<?php

require_once 'classes/Database.php';

$taskID=$_POST["taskID"];

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
    $bob = $database->delete("tasks", array('TaskID'=>$_POST["taskID"]));
} catch (Exception $e) {
    echo "</br>";
    echo $e->getMessage();
    exit(1);
}
?>