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
	<!-- <script src="js/js.js"></script> -->
</head>

<body>
	<?php
	 include "includes/database.php"; 
	 //create variable
	 $goalWeightdb = '';
	 $totalLostdb = '';
	 $currentWeightdb = '';

	// now read from database select id by given username 
	$userid =$_SESSION["userid"];


	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$goalWeight= $_POST["goalWeight"];
		//$totalLost= $_POST["totalLost"];
		$currentWeight = $_POST["currentWeight"];
		
		// insert values in the data base and userid 
		
		 $sql = "INSERT INTO weight (goalWeight, currentWeight, userid) VALUES ('$goalWeight','$currentWeight','$userid')";
		 if (mysqli_query($conn, $sql)) { 
            //continue show the rest of html
	 		// get the las id
	 		$lastId = $conn->insert_id;
	 		header("Location: /weightpage.php?id=".$lastId);
        } else {
         echo "Error: " . $sql . "<br>" .
            mysqli_error($conn); 
        }
     //if it wasn't post do this          
	} elseif (isset($_GET['id'])) {
		$id = $_GET['id'];
		//read from data base
		$sql = "SELECT goalWeight, currentWeight FROM weight where id=$id and userid = $userid ";
		$result = $conn->query($sql);
		//result array
        $row = $result->fetch_assoc() ;
        if (!$result) {
            die('Could not query:' . mysql_error());
        }
        $sqlOld = "SELECT goalWeight, currentWeight FROM weight where userid = $userid order by id asc limit 1";
		$resultOld = $conn->query($sqlOld);
		//result array
        $rowOld = $resultOld->fetch_assoc() ;
        if (!$resultOld) {
            die('Could not query:' . mysql_error());
        }

        $currentWeightdbOld = $rowOld['currentWeight'];
	 	$currentWeightdb = $row['currentWeight'];
	 	$goalWeightdb = $row['goalWeight'];

	 	$totalLostdb = $currentWeightdb-$currentWeightdbOld;


	} 
	?>


	<form action="#" method="post" >
		<div class="sign-in-page">
	        <a href="homepage.php"><img src="images/logo1.png" alt=""></a>
	    </div>
		
		<div class="weight-info-box">
			<p>Weight</p>
			<div class="weight-goal-box">
				<p>Goal weight</p>
				<input type="text" placeholder="" value="<?php echo $goalWeightdb; ?>" readonly >
	            <p>Total lost</p>
				<input type="text" placeholder="" value="<?php echo $totalLostdb; ?>" readonly>
	            <p>Current weight</p>
				<input type="text" placeholder="" value="<?php echo $currentWeightdb; ?>" >      
			</div>
		</div>
		
		
	        <div class="current-weight-box">
		<div class="current-weight">
			<p>Current weight</p>
			<input type="text" placeholder="" name="currentWeight">
		</div>

        <div class="goal-weight-box">
			<p>Goal weight</p>
			<input type="text" placeholder="" name="goalWeight" value="<?php echo $goalWeightdb; ?>">
		</div>

        <div class="weight-update-button">
            <input type="submit" value="Update"ß>
        </div>
	</div>
	</form>	
</body>

</html>
