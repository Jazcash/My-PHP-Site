<?php

require_once 'classes/Database.php';

if (isset($_POST["property"])) { 
    echo $_POST["property"];
    $property = $_POST["property"];
    if (substr($property, 0,1) == "p"){
        $table = "projects";
    } else {
        $table = "tasks";
    }
}
echo "</br>";
if (isset($_POST["id"])) {
    echo $_POST["id"];
    $id = $_POST["id"];
}
echo "</br>";
if (isset($_POST["value"])) {
    echo $_POST["value"];
    $value = $_POST["value"];
}
echo "</br>";

function dbConnect(){
    try {
        $database = new Database();
        return $database;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
}

if (isset($id)){
    
    echo $table;
    echo "</br>";
    print_r(array($property=>$value));
    echo "</br>";
    print_r(array(substr($table, 0, -1)."ID"=>$id));

    $database = dbConnect();
    try { 
        $bob = $database->update($table, array($property=>$value), array(substr($table, 0, -1)."ID"=>$id));
        
        if ($property = 'CompletedOn') {
            $bob = $database->update($table, array('CompletedOn'=> date("Y-m-d")), array(substr($table, 0, -1)."ID"=>$id));
        }
        
        $bob = $database->update($table, array('LastModified'=> date("Y-m-d\TH:i:s")), array(substr($table, 0, -1)."ID"=>$id));
    } catch (Exception $e) {
        echo "</br>";
        echo $e->getMessage();
        exit(1);
    }
    
}
echo "</br>";

if ($bob == 0 ) { echo "No database stuff done"; } else { echo "database stuff done!";}

echo "</br>---------------</br>";
//header("Content-type: application/json");
//echo json_encode($jsonReturn);
?>