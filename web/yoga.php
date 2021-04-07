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
	<title>Yoga</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
<?php
	include "includes/database.php"; 
	$durationMindb = '';
	$burntCaloriesdb = '';


	// now read from database select id by given username 
	$userid =$_SESSION["userid"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$durationMin= $_POST["durationMin"];
	$burntCalories = $durationMin * 4;

// insert values in the data base and userid 
	$sql = "INSERT INTO yoga(durationMin, burntCalories, userid) VALUE ($durationMin, $burntCalories, $userid) ";
	if (mysqli_query($conn, $sql)) { 
		//continue show the rest of html
		// get the las id
		$lastId = $conn->insert_id;
		header("Location: /yoga.php?id=".$lastId);
	}

	else {
         echo "Error: " . $sql . "<br>" .
            mysqli_error($conn); 
        }
    }
        elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
			//read from data base
			$sql = "SELECT durationMin, burntCalories FROM yoga where id=$id and userid = $userid ";
			$result = $conn->query($sql);
			//result array
	        $row = $result->fetch_assoc() ;
        	if (!$result) {
            die('Could not query:' . mysql_error());
        	}
        $durationMindb = $row['durationMin'];
		$burntCaloriesdb = $row['burntCalories'];
	}
?>
    <div class="sign-in-page">
        <a href="homepage.php"><img src="images/logo.png" alt=""></a>
    </div>

    <div class="yoga-container">
        <p>Yoga</p>
        <div class="yoga-image-container">
            <img src="images/yoga.jpg" alt="">
        </div>
    </div>

    <div class="yoga-duration-container">
        <div class="duration">
			<p>Duration: </p>
			<input type="text" placeholder="" name="durationMin">
			<p>minutes</p>
		</div>
	
		<div class="calories-burnt">
			<p>Calorie burnt:</p>
			<input type="text" placeholder="" value="<?php echo $burntCaloriesdb; ?>">
			<p>cal</p>
		</div>

        <div class="submit-button">
            <input type="submit" value="Submit">
        </div>
    </div>
</body>

</html>