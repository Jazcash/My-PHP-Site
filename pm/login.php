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

if(isset($_POST["login"])){
    $username = $database->escapeString(htmlentities($_POST['user']));
	$password = SHA1($_POST["pass"]);
    $userIDresults = $database->select("SELECT UserID, Username FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
	if(count($userIDresults) == 1){
        session_start();
		$_SESSION["log"] = 'in';
        $_SESSION["user"] = $userIDresults[0];
		header('Location: index.php');
	} else {
		$error = 'Invalid Login';
	}
} elseif (isset($_GET["success"])){
    $error = "<script type='text/javascript'>alert('Account successfully created, you may now login');</script>";
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--[if IE]>
        <meta http-equiv="refresh" content="0;url=https://www.google.com/intl/en/chrome/browser/"> 
        <script language="javascript">
            window.location.href = "https://www.google.com/intl/en/chrome/browser/"
        </script>
        <![endif]-->
        <title>Project Manager | Login</title>
        <link href="loginStyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="cell">
                <div class="content">
                    <div id="floater">
                        <div id="content">
                            <h1>Login</h1>
                            <form method="post" action="">
                                <p>Username</p><input type="text" name="user" value=""></br>
                                <p>Password</p><input type="password" name="pass" value=""></br>
                                <input type="submit" id="button" name="login" value="Login"/></br>
                            </form>
                            <a href="register.php"><p>Register an account</p></a>
                            <div id="loggedin"><p><?php if(isset($error)){echo $error;}  ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>