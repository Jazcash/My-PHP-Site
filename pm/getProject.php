<?php

require_once 'classes/Database.php';

$projectID=$_POST["projectID"];

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

$sql = $database->select("SELECT * FROM projects WHERE ProjectID = ".$projectID);
    
$jsonReturn = array();
for ($i=0; $i<count($sql); $i++) {
    $jsonReturn[] = $sql[$i];
}
header("Content-type: application/json");
echo json_encode($jsonReturn);
?>