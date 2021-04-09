<?php
// Start the session
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up Form</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //create variables from the form 

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $passwordPlain = $_POST["password"]; 
            $password = password_hash($passwordPlain, PASSWORD_BCRYPT, ["cost" => 12]);

            include "includes/database.php"; 

            $sql = "INSERT INTO user (firstname, lastname, age, email,username,password) VALUES ('$firstname', '$lastname', '$age', '$email','$username','$password')";
            if (mysqli_query($conn, $sql)) { 
                //continue show the rest of html
            } else {
             echo "Error: " . $sql . "<br>" .
                mysqli_error($conn); 
            }


        };


    ?>


	<div class="sign-in-page">
        <a href="index.php"><img src="images/logo1.png" alt=""></a>
    </div>

	<div class="sign-up-form">
        <div class="title">Sign Up</div>
        <form action="#" method="post" >
            <div class="details">
                <div class="input">
                    <span  class="details-input">First name</span>
                    <input type="text" name="firstname" placeholder="Enter your first name" required="required"> 

                </div>
                <div class="input">
                    <span  class="details-input">Last name</span>
                    <input type="text" name="lastname" placeholder="Enter your last name" required="required">
                </div>
                <div class="input">
                    <span  class="details-input">Age</span>
                    <!-- sepi: 
                        1. changed tyoe to number (htnl 5 )  we had to use HTML Input Types 
                        2. add HTML5  validation min-max for age 
                        3.add HTML5 validation required 
                    -->
                    <input type="number" name="age" placeholder="Enter your age"  min="16" max="110" required="required">
                </div>
                <div class="input">
                    <span  class="details-input">E-mail</span>
                    <input type="email" name="email" placeholder="Enter your e-mail address" required="required">
                </div>
                <div class="input">
                    <span  class="details-input">Username</span>
                    <input type="text" name="username" placeholder="Enter your Username" required="required">
                </div>
                <div class="input">
                    <span  class="details-input">Password</span>
                    <!-- sepi:changed type text to password (html 5 )to hide sensetive data/ we had to use HTML Input Types -->

                    <input type="password" name="password" placeholder="Enter your password" required="required">
                </div>
            </div>



            <div class="register-button">
                <input type="submit"  value="Create Account"> 
            </div>
        </form>

        <p>Do you have an account? <a href="sign in.html">Signin</a></p>
    </div>
	
</body>

</html>
