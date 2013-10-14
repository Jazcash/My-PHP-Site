<?php   
require_once 'classes/Database.php';

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

if($_POST){
    $msg = register($database);
    if ($msg == "Success") {
        header('Location: login.php?reg=suc');
        exit();
    }
}

function register($database) {
    if(isset($_POST["register"])){
        $userRegExp = "/^(?=.{1,15}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/";
        $passRegExp = "//";
        $userNames = $database->select("SELECT Username FROM users;");
        
        $taken = false;
        for ($i=0; $i<count($userNames); $i++){
            if ($userNames[$i]["Username"] == $_POST['user']) {
                $taken = true;
            }
        }
        
        if ($taken) {
            return "Username is taken";
        } elseif (!preg_match($userRegExp, $_POST['user'])) {
            return "Choose a different Username";
        } elseif (!preg_match($passRegExp, $_POST['pass'])) {
            return "Choose a different Password";
        } else {
            $username = $_POST['user'];
            $password = SHA1($_POST["pass"]);
                $user = array('Username' => $username, 'Password' => $password);
                try {
                    $database->insert("users", $user);
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            return "Success";
        }       
    }
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Project Manager | Register</title>
        <link href="loginStyle.css" rel="stylesheet" type="text/css" />
        <link href="validation.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="cell">
                <div class="content">
                    <div id="floater">
                        <div id="content">
                            <h1>Register</h1>
                            <form method="post" action="">
                                <p>Desired Username</p><input type="text" name="user" value="" onkeydown="changed(this.value)"></br>
                                <p>Desired Password</p><input type="password" name="pass" value="" onkeydown="changed(this.value)"></br>
                                <input type="submit" id="button" name="register" value="Register"/></br>
                            </form>
                            <div id="loggedin"><p><?php if(isset($msg)){echo $msg;} ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>