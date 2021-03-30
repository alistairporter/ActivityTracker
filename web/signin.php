<?php
// Start the session
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign in Form</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $username = $_POST["username"];
            $passwordPlain = $_POST["password"]; 

            include "includes/database.php"; 
            
            // select from user where username = $username
            // get password if password in db = $password
            // save session 
            $sql = "SELECT password, firstname, username FROM user WHERE username = '$username'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc() ;
            if (!$result) {
                die('Could not query:' . mysql_error());
            }
            $passwordFromDb = $row['password'];
            $firstname = $row['firstname'];
            $username = $row['username'];
            if (password_verify ($passwordPlain, $passwordFromDb ) == true)
            {
                echo "Hello " . $firstname ;
                $_SESSION["username"] = $username;
                $_SESSION["firstname"] = $firstname;


            }
            else 
            {
                echo "wrong password";
            }

        }


    ?>
	<div class="sign-in-page">
        <a href="index.html"><img src="images/logo.png" alt=""></a>
        <h1>Welcome Back</h1>
    </div>
	
    <div class="sign-in-form">
        <form action="#" method="post">
            <div class="details">
                <div class="input">
                    <span  class="details-input">Username: </span>
                    <input name="username" type="text" placeholder="" >
                </div>
                <div class="input">
                    <span  class="details-input">Password: </span>
                    <input type="text" name="password" placeholder="">
                </div>
            </div>

            <div class="sign-in-button">
                <input type="submit" value="Sign in">
            </div>
        </form>
    </div>

    <div class="reset-register">
        <a href="reset.html">Forgot your Password? </a>
        <a href="signup.php">Don't have an account? Get start</a>
    </div>
</body>

</html>
