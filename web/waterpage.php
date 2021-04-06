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
	<title>Hydration information</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
	<?php
		include "includes/database.php"; 
		//creat variables
		$waterdb = '';
		$goalWaterdb = '';

		// now read from database select id by given username 
		//get the logged in user 
		$userid =$_SESSION["userid"];


			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$addWater= $_POST["water"];
				$goalWater = $_POST["goalWater"];

				// insert values in the database and userid
				$sql =" INSERT INTO water(water, goalWater, userid) VALUES ($addWater, $goalWater, $userid)";
				//run the query
				 if (mysqli_query($conn, $sql)) { 
		            //continue show the rest of html
			 		// get the last id
			 		$lastId = $conn->insert_id;
			 		//redirect to this page ,// we don't want to add it to data base few times 
			 		header("Location: /waterpage.php?id=".$lastId);
			 		exit();
			 	}else {
	        		 echo "Error: " . $sql . "<br>" .
	           		 mysqli_error($conn); 
	        }
			 	//if it wasn't post do this        
				} elseif (isset($_GET['id'])) {
				 	//get id 
				 	$id= $_GET['id'];
				 	//read from db
				 	$sql = " SELECT SUM(water) as water FROM water WHERE userid = $userid ";
				 	$result = $conn->query($sql);
					//result array
			        $row = $result->fetch_assoc() ;
			        if (!$result) {
			            die('Could not query:' . mysql_error());
			        }
			        $sqlOld = "SELECT water, goalWater FROM water where userid = $userid order by id asc limit 1";
					$resultOld = $conn->query($sqlOld);
					//result array
			        $rowOld = $resultOld->fetch_assoc() ;
			        if (!$resultOld) {
			            die('Could not query:' . mysql_error());
			        }

			        $waterdb = $row['water'];
			        $goalWaterdb = $rowOld['goalWater'];
			    }
			        
	

		     



	?>

	<form action="#" method="post" >	
		<div class="sign-in-page">
	        <a href="homepage.html"><img src="images/logo.png" alt=""></a>
	    </div>
		
		<div class="water-info-box">
			<p>Water</p>
			<div class="water-goal-box">
				<div class="goal-water">
					<p>Goal: </p>
					<input type="text" placeholder="" value="<?php echo $goalWaterdb; ?>" readonly>
					<p> Liter</p>
				</div>

				<div class="water-consumed">
					<p>Water: </p>
					<input type="text" placeholder=""value="<?php echo $waterdb; ?>"  readonly>
					<p>Liter</p>
				</div>
			</div>
		</div>

		<div class="water-box">
			<div class="add-water">
				<p>Add water: </p>
				<input type="text" placeholder="" name="water">
				<p>Liter</p>
			</div>
		

			<div class="goal-water-box">
				<p>Goal water:</p>
				<input type="text" placeholder="" name="goalWater" value="<?php echo $goalWaterdb; ?>">
				<p>Liter</p>
			</div>

			<div class="water-update-button">
	            <input type="submit" value="Update">
	        </div>
		</div>
</body>

</html>