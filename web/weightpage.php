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
	<title>Weight information</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
	<?php
	 include "includes/database.php"; 

	if($_SERVER["REQUEST_METHOD"] == "POST")
        {
		$goalWeight= $_POST["goalWeight"];
		$totalLost= $_POST["totalLost"];
		$currenWeight = $_POST["currenWeight"];
		// now read from database select id by given username 
		$userid =$_SESSION["userid"];
		// insert values in the data base and userid 
		
		 $sql = "INSERT INTO weight (goalWeight, currenWeight, userid) VALUES ('$goalWeight','$currenWeight','$userid')";
		 if (mysqli_query($conn, $sql)) { 
                //continue show the rest of html
		 	// get the las id

		 	header("Location: /weightpage.php?id=1");

            } else {
             echo "Error: " . $sql . "<br>" .
                mysqli_error($conn); 
            }
     //if it wasn't post do this        
	} elseif (isset($_GET['id'])) {
		$id = $_GET['id'];
		//read from data base
		$sql = "SELECT 'goalWeight, currenWeight FROM ";
		$result = $conn->query($sql);
            $row = $result->fetch_assoc() ;
            if (!$result) {
                die('Could not query:' . mysql_error());
            }

	} 


	?>


	<form action="#" method="post" >
		<div class="sign-in-page">
	        <a href="homepage.php"><img src="images/logo.png" alt=""></a>
	    </div>
		
		<div class="weight-info-box">
			<p>Weight</p>
			<div class="weight-goal-box">
				<p>Goal weight</p>
				<input type="text" placeholder="" name="goalWeight">
	            <p>Total lost</p>
				<input type="text" placeholder="" name="totalLost">
	            <p>Current weight</p>
				<input type="text" placeholder="" name="currenWeight">      
			</div>
		</div>

	        <div class="weight-update-button">
	            <input type="submit" value="Update">
	        </div>
		</div>
	</form>	
</body>

</html>