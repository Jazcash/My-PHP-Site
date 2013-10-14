<?php
require_once 'classes/Database.php';

function dbConnect(){
    try {
        $database = new Database();
        return $database;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
}
$database = dbConnect();

$userID = $_POST["userID"];

$projects = $database->select("select p.ProjectID, p.Name, p.Description, p.Deadline from projects p where UserID = $userID");

$tasks = $database->select("select t.TaskID, t.ProjectID, t.Name, t.Description, t.Deadline from users u left join projects p on u.userid = p.userid left join tasks t on p.projectid = t.projectid where u.userid = $userID and t.projectid IS NOT NULL");

for ($p=0; $p<count($projects); $p++){
    
    $taskList = array();
    for ($t=0; $t<count($tasks); $t++){
        if ($tasks[$t]["ProjectID"] == $projects[$p]["ProjectID"]) {
            $taskList[] = $tasks[$t];
        }
    }
    $projects[$p]["Tasks"] = $taskList;
}

header("Content-type: application/json");
echo json_encode($projects);


?>