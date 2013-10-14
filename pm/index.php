<?php 
session_start();

if (!isset($_SESSION["log"]) || ($_SESSION["log"] != 'in')) {
	header('Location: login.php');
	exit();
}

if (isset($_GET["log"]) && ($_GET["log"]=="out")) {
	session_destroy();
	header('Location: login.php');
}

require_once 'classes/Database.php';
require_once 'classes/TaskCollection.php';
require_once 'classes/ProjectCollection.php';
require_once 'classes/User.php';
require_once 'classes/Task.php';

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

$currentUser = new User($_SESSION["user"]['UserID'], $_SESSION["user"]['Username']);

$projectList = new ProjectCollection();
$projects = $database->select("SELECT * FROM projects WHERE UserID = ".$currentUser->getUserID());
for ($i=0; $i<count($projects); $i++){
    $tasks = $database->select("SELECT * FROM tasks WHERE ProjectID = ".$projects[$i]["ProjectID"]);
    $taskList = new TaskCollection();
    for ($j=0; $j<count($tasks); $j++){
        $taskList->addItem(new Task($tasks[$j]["TaskID"], $tasks[$j]["ProjectID"], $tasks[$j]["Name"], $tasks[$j]["Description"], $tasks[$j]["Deadline"], $tasks[$j]["Created"], $tasks[$j]["LastModified"], $tasks[$j]["CompletedOn"]));
    }
    $projectList->addItem(new Project($projects[$i]["ProjectID"], $projects[$i]["UserID"], $projects[$i]["Name"], $projects[$i]["Description"], $projects[$i]["Created"], $projects[$i]["LastModified"], $taskList));
}

if($_POST){
    $error = saveData($database, $projectList, $currentUser);
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}

function saveData($database, $projectList, $currentUser){
    if (!empty($_POST["addProjectText"])){
        $project = array('UserID' => $currentUser->getUserID(), 'Name' => $_POST["addProjectText"], 'Created' => date("Y-m-d"), 'LastModified' => date("Y-m-d\TH:i:s"));
        try {
            $database->insert("projects", $project);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit(1);
        }
    }
    for ($i=0; $i<$projectList->length(); $i++) {
        if (!empty($_POST["addTaskText".$i]) && $_POST["addTaskText".$i] !== 'Add New Task') {
            $task = array('ProjectID' => $projectList->getItem($i)->getProjectID(), 'Name' => $_POST["addTaskText".$i], 'Created' => date("Y-m-d"), 'LastModified' => date("Y-m-d\TH:i:s"));
            try {
                $database->insert("tasks", $task);
            } catch (Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>
        <title>Project Manager</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script src="javascript/jquery.min.js"></script>
        <script src="javascript/animations.js"></script>
        <script>
        function clearText(field){
            if (field.defaultValue == field.value) field.value = '';
            else if (field.value == '') field.value = field.defaultValue;
        }
        
        //----------------AJAX (I should really learn how to do this properly some day)---------
        function showTask(taskID){
            if (window.XMLHttpRequest){     // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    var jsonString = JSON.parse(xmlhttp.responseText);
                    document.getElementsByClassName("taskFrame")[0].id=jsonString[0].TaskID;
                    
                    document.getElementById("tasks.Name").value=jsonString[0].Name;
                    document.getElementById("tasks.Deadline").value=jsonString[0].Deadline;
                    document.getElementById("tasks.Created").value=jsonString[0].Created;
                    document.getElementById("tasks.Description").value=jsonString[0].Description;
                    document.getElementById("tasks.LastModified").value=jsonString[0].LastModified;
                    if (jsonString[0].CompletedOn !== null) {
                        document.getElementById("tasks.CompletedDate").value = jsonString[0].CompletedOn;
                    } else {
                        document.getElementById("tasks.CompletedDate").value = ""
                    }
                }
            }
            xmlhttp.open("POST","getTask.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var requestString = "taskID=" + taskID;
            xmlhttp.send(requestString);
        }
        
        function showProject(projectID){
            if (window.XMLHttpRequest){     // code for IE7+, Firefox, Chrome, Opera, Safari
                fish=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                fish=new ActiveXObject("Microsoft.XMLHTTP");
            }
            fish.onreadystatechange=function() {
                if (fish.readyState==4 && fish.status==200) {
                    var jsonString = JSON.parse(fish.responseText);
                    document.getElementsByClassName("projectFrame")[0].id=jsonString[0].ProjectID;
                    
                    document.getElementById("projects.Name").value=jsonString[0].Name;
                    document.getElementById("projects.LastModified").value=jsonString[0].LastModified;
                    document.getElementById("projects.Created").value=jsonString[0].Created;
                    document.getElementById("projects.Description").value=jsonString[0].Description;
                }
            }
            fish.open("POST","getProject.php", true);
            fish.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var requestString = "projectID=" + projectID;
            fish.send(requestString);
        }
        
        function saveInfo(element){
            var property = element.id;
            var objectID = element.parentNode.parentNode.parentNode.id;
            
            var goAhead = true;
            var newValue = element.value;
            
            if (window.XMLHttpRequest && goAhead){     // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlThing=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                xmlThing=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlThing.onreadystatechange=function() {
                if (xmlThing.readyState==4 && xmlThing.status==200) {
                    //document.getElementById("errorBox").innerHTML = xmlThing.responseText;
                }
            }
            xmlThing.open("POST","saveInfo.php", true);
            xmlThing.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            requestString = "id=" + objectID + "&property=" + property + "&value=" + newValue;
            xmlThing.send(requestString);
        }
        
        function refreshList(userID){
            alert(userID);
            
            if (window.XMLHttpRequest){     // code for IE7+, Firefox, Chrome, Opera, Safari
                carrot=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                carrot=new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            carrot.onreadystatechange=function() {
                if (carrot.readyState==4 && carrot.status==200) {
                    var jsonString = JSON.parse(carrot.responseText);
                        return jsonString;
                    //document.getElementById("errorBox").innerHTML = jsonString[0]["Name"];
                }
            }
            
            carrot.open("POST","getProjectsAndTasks.php", true);
            carrot.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var requestString = "userID=" + userID;
            carrot.send(requestString);
        }
        
        function deleteTask(element) {
            var taskID = (element.parentNode.id);
            
            if (window.XMLHttpRequest){     // code for IE7+, Firefox, Chrome, Opera, Safari
                tim=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                tim=new ActiveXObject("Microsoft.XMLHTTP");
            }
            tim.onreadystatechange=function() {
                if (tim.readyState==4 && tim.status==200) {
                    alert("Task deleted!");
                    document.location.reload(true)
                }
            }
            tim.open("POST","deleteTask.php", true);
            tim.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var requestString = "taskID=" + taskID;
            tim.send(requestString);
        }
        
        function deleteProject(element) {
            projectID = element.parentNode.parentNode.id;
            
            if (window.XMLHttpRequest){     // code for IE7+, Firefox, Chrome, Opera, Safari
                tim=new XMLHttpRequest();
            } else {                        // code for IE6, IE5
                tim=new ActiveXObject("Microsoft.XMLHTTP");
            }
            tim.onreadystatechange=function() {
                if (tim.readyState==4 && tim.status==200) {
                    alert("Project deleted!");
                    document.location.reload(true)
                }
            }
            tim.open("POST","deleteProject.php", true);
            tim.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var requestString = "projectID=" + projectID;
            tim.send(requestString);
        }
        //----------------AJAX (I should really learn how to do this properly some day)---------
        </script>
    </head>
    <body>
        <div class="left col">
            <div class="header row left"> <!-- Top Left Panel Start -->
                <p class="centre">Projects</p>
            </div> <!-- Top Left Panel end -->
            <div class="body row scroll-y"> <!-- Bottom Left Panel Start -->
                <ul class="listview">
                    <ul id='sidebar'>
                    <?php for ($p=0; $p<$projectList->length(); $p++) { //Loop through projects ?>
                        <li class='project' id='<?php echo $projectList->getItem($p)->getProjectID() ?>' onclick="showProject(this.id)">
                            <a href='/contact' class='projectOptionsIcon'></a>
                            <div class='arrow'></div>
                            <div class='projectOptions'>
                                <!--<a href='#'><img src='images/modify.png' width='16' height='16' alt='Modify'></a>
                                <a href='#'><img src='images/duplicate.png' width='16' height='16' alt='Duplicate'></a>-->
                                <img src='images/delete.png' width='16' height='16' alt='Delete'>
                                <span class="deleteProject" onclick="deleteProject(this)">Delete Project</span>
                            </div>
                            <p class='projectText'><?php echo $projectList->getItem($p)->getName() ?></p>
                            <ul>
                            <?php for ($t=0; $t<$projectList->getItem($p)->getTasks()->length(); $t++){ //Loop through tasks?>
                                    <li class='task' id='<?php echo $projectList->getItem($p)->getTasks()->getItem($t)->getTaskID() ?>' onclick='showTask(this.id)'>
                                        <img class='calendar' src='images/calendar.png' width='16' height='16' alt='Date'>
                                        <span class='date' onclick="fish(this)"><?php echo $projectList->getItem($p)->getTasks()->getItem($t)->getDeadline("d") ?></span>
                                        <img class='deleteTask' src='images/miniIcons/action_stop.gif' alt='Date' onclick="deleteTask(this)">
                                        <?php if ($projectList->getItem($p)->getTasks()->getItem($t)->getCompletedOn() !== null){
                                            echo "<img class='completedTask' src='images/miniIcons/icon_accept.gif' alt='Completed'>";
                                        }?>
                                        <p class='taskText'><?php echo $projectList->getItem($p)->getTasks()->getItem($t)->getName() ?></p>
                                    </li>
                            <?php } ?>
                            <li class='addTask'>
                                    <form name='addTaskForm' method='post'>
                                        <input class='addTaskText' name='addTaskText<?php echo $p ?>' type='text' value='Add New Task' onFocus="clearText(this)" onBlur="clearText(this)"/>
                                            <!--<img class='calendar' src='images/calendar.png' width='16' height='16' alt='Date'>
                                            <span class='date'><?php //echo date("d") ?></span>-->
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    <?php } ?>
                    <li class='addProject'>
                            <form name='addProjectForm' method='post'>
                                <input class='addProjectText' name='addProjectText' type='text' value='Add New Project' onFocus="clearText(this)" onBlur="clearText(this)"/>
                            </form>
                          </li>
                    </ul>
                </ul>
            </div> <!-- Bottom Left Panel end -->
        </div>
        <div class="right col">
            <div class="header row right"> <!-- Top Right Panel Start -->
                <p class="loginInfo" >Logged in as <span class="bold"><?php if(isset($_SESSION["user"]['Username'])){echo $_SESSION["user"]['Username'];} ?></span> | <a href="?log=out">Log out</a></p>
            </div> <!-- Top Right Panel end -->
            <div id="stripes" class="body row scroll-y"> <!-- Bottom Right Panel Start -->
            
                <div class="projectFrame">
                    <div class="container">
                        <span><strong>Project Name </strong><input class="pText" id="projects.Name" onblur="saveInfo(this)"/></span></br>
                        <span><strong>Project Description </strong><input class="pText" id="projects.Description" onblur="saveInfo(this)"/></span>
                    </div>
                    <div class="container">
                        <span class="alignleft"><strong>Project LastModified: </strong><input type="datetime" id="projects.LastModified" onblur="saveInfo(this)" readonly/></span>
                        <span class="alignright"><strong>Project Created: </strong><input type="date" id="projects.Created" onblur="saveInfo(this)" readonly/></span>
                    </div>
                </div> <!-- Project & Task Name End -->
                
                <div class="taskFrame"> <!-- Project & Task Content Start -->
                    <div class="container">
                        <span><strong>Task Name </strong><input class="pText" id="tasks.Name" onblur="saveInfo(this)"/></span></br>
                        <span><strong>Task Description </strong><input class="pText" id="tasks.Description" onblur="saveInfo(this)"/></span>
                    </div>
                    <div class="container">
                        <span class="alignleft"><strong>Last Modified: </strong><input type="datetime" id="tasks.LastModified"  readonly/></span>
                        <span class="alignright"><strong>Task Created: </strong><input type="date" id="tasks.Created" readonly/></span>
                    </div>
                    <div class="container">
                        <span class="alignleft"><strong>Task Deadline: </strong><input type="date" id="tasks.Deadline" onblur="saveInfo(this)" min="<?php echo date("Y-m-d") ?>"/></span>
                        <span class="alignright"><strong>Completed: </strong><input type="checkbox" id="tasks.CompletedOn" onblur="saveInfo(this)"/></span>
                        <span class="alignright"><strong>Completed Date: </strong><input type="date" id="tasks.CompletedDate"/></span>
                    </div>
                    <div class="dashedLine"></div>
                    <textarea id="contentText"></textarea>
                </div> <!-- Project & Task Content End -->
                
                </br><div id="errorBox" onclick="refreshList(<?php echo $projectList->getItem(0)->getUserID() ?>)"></div>
                
            </div> <!-- Bottom Right Panel end -->
        </div>
    </body>
</html>