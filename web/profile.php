<?php
// Start the session
session_start();
//if not logged in redirect to signin page 
if (!$_SESSION["username"]) {
    header("Location: /signin.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
    <?php

        include "includes/database.php";
        $firstnamedb='';
        $surnamedb='';
        $emaildb='';
        $agedb='';

        // now read from database select id by given username 
        $userid =$_SESSION["userid"];

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //create variables from the form 
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $age = $_POST["age"];
            $email = $_POST["email"];

            $sql = " UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email', age = $age WHERE id=$userid ";

            if (mysqli_query($conn, $sql)) { 
                //continue show the rest of html            
                header("Location: /profile.php?id=".$lastId);
            }
            else {
                 echo "Error: " . $sql . "<br>" .
                 mysqli_error($conn); 
                }  
        } 

        // read values from database
        $sql = "SELECT firstname, lastname, age, email FROM user WHERE id=$userid ";
            $result = $conn->query($sql);
            //result array
            $row = $result->fetch_assoc() ;
            if (!$result) {
                die('Could not query:' . mysql_error());
            }
            $firstnamedb= $row['firstname'];
            $lastnamedb = $row['lastname'];
            $agedb = $row['age'];
            $emaildb = $row['email'];

    ?>

    <div class="sign-in-page">  
        <a href="homepage.php"><img src="images/logo.png" alt=""></a>
    </div>
<form action="#" method="post">
    <div class="profile-container">
        <p>My profile</p>
        <div class="input">
            <span  class="details-input">Name</span>
            <input type="text" placeholder="" name="firstname" value="<?php echo $firstnamedb;?>">
        </div>
        <div class="input">
            <span  class="details-input">Surname</span>
            <input type="text" placeholder="" name="lastname" value="<?php echo $lastnamedb;?>">
        </div>
        <div class="input">
            <span  class="details-input">E-mail</span>
            <input type="text" placeholder="" name="email" value="<?php echo $emaildb;?>">
        </div>
        <div class="input">
            <span  class="details-input">Age</span>
            <input type="text" placeholder="" name="age" value="<?php echo $agedb;?>">
        </div>

        <div class="profile-image">
            <img src="images/image.png" alt="">
        </div>
    </div>

    <div class="profile-button-container">
        <button type="submit" value="change button">Change</button>
    </div>
</form>
</body>

</html>
