<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Running</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
    <?php
		include "includes/database.php"; 
		$durationMindb = '';
		$burntCaloriesdb = '';
		$typedb = '';

		// now read from database select id by given username 
		$userid =$_SESSION["userid"];

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$durationMin= $_POST["durationMin"];
		$burntCalories = $durationMin * 9.5;
		$type="running";
		
	// insert values in the data base and userid 
		$sql = "INSERT INTO activity(durationMin, burntCalories, userid, type) VALUE ($durationMin, $burntCalories, $userid,'$type') ";

		if (mysqli_query($conn, $sql)) { 
	        //continue show the rest of html
	 		// get the las id
	 		$lastId = $conn->insert_id;
	 		header("Location: /running.php?id=".$lastId);
		}
	
		else {
	         echo "Error: " . $sql . "<br>" .
	         mysqli_error($conn); 
	        }
	    }
	        elseif (isset($_GET['id'])) {
				$id = $_GET['id'];
				//read from data base
				$sql = "SELECT durationMin, burntCalories FROM activity where id=$id and userid = $userid ";
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

    <div class="running-container">
        <h1>GPS</h1>
    </div>
    
    <div class="running-button-container">
        <button type="button" value="Start GPS Record">Start GPS Record</button>
        <button type="button" value="Stop GPS Record">Stop GPS Record</button>
    </div>
    <form action="#" method="post">
    <div class="running-duration-container">
      <div class="duration">
        <p>Duration: </p>
        <input type="text" placeholder="" name="durationMin">
        <p>minutes</p>
      </div>
      <div class="calories-burnt">
        <p>Calorie burnt:</p>
        <input type="text" placeholder="" value="<?php echo $burntCaloriesdb;?>">
        <p>cal</p>
      </div>
      <div class="submit-button">
        <imput type="submit" value="submit">
      </div>
    </div>
    </form>
</body>

</html>
