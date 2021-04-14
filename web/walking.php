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
	<title>walking</title>
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
		$burntCalories = $durationMin * 6.5;
		$type="walking";
		$distance = $_POST["distance"];
		
	// insert values in the data base and userid 
		$sql = "INSERT INTO activity(durationMin, burntCalories, userid, type, distance) VALUE ($durationMin, $burntCalories, $userid,'$type',$distance) ";

		if (mysqli_query($conn, $sql)) { 
	        //continue show the rest of html
	 		// get the las id
	 		$lastId = $conn->insert_id;
	 		header("Location: /walking.php?id=".$lastId);
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
        <a href="homepage.php"><img src="images/logo1.png" alt=""></a>
    </div>

    <div class="walking-container">
        <div id="gpsOutput">GPS</div>
        <div id="map"></div>
    </div>
    
    <div class="walking-button-container">
        <button type="button" value="Start GPS Record" onclick="startLoop()">Start GPS Record</button>
        <button type="button" value="Stop GPS Record" onclick="stopLoop()">Stop GPS Record</button>
    </div>
    <form action="#" method="post">
    <div class="walking-duration-container">
      <div class="duration">
        <p>Duration: </p>
        <input type="text" placeholder="" name="durationMin">
        <p>minutes</p>
      </div>
      <div class="distance">
        <p>Distance: </p>
        <input type="text" placeholder="" value="0" name="distance" id="distance">
        <p>km</p>
      </div>
      <div class="calories-burnt">
        <p>Calorie burnt:</p>
        <input type="text" placeholder="" value="<?php echo $burntCaloriesdb;?>">
        <p>cal</p>
      </div>
      <div class="submit-button">
        <input type="submit" value="submit">
      </div>
    </div>
    </form>
    
        <script>
	  flag = null;
	  distance = 0;
	  let positions = [];
	  
	  function getDis() {
	    var geo1 = $("#geo1").val().split(",");
	    var geo2 = $("#geo2").val().split(",");
	    var distance = distanceBetween(geo1[0], geo1[1], geo2[0], geo2[1], "K");
	    console.log("geo dis: " + distance);
	    $("#dis").html("<h4>" + distance + "Km</h4>");
	  }

	  function distanceBetween(lat1, lon1, lat2, lon2, unit) {
	    var rlat1 = Math.PI * lat1 / 180
	    var rlat2 = Math.PI * lat2 / 180
	    var rlon1 = Math.PI * lon1 / 180
	    var rlon2 = Math.PI * lon2 / 180
	    var theta = lon1 - lon2
	    var rtheta = Math.PI * theta / 180
	    var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);
	    dist = Math.acos(dist)
	    dist = dist * 180 / Math.PI
	    dist = dist * 60 * 1.1515
	    if (unit == "K") {
	      dist = dist * 1.609344
	    }
	    if (unit == "N") {
	      dist = dist * 0.8684
	    }
	    return dist
	  }

	  //
	  // Check if we can get geo location and show it on a map in case we can.
	  //
	  function getLocation() {
	    if (navigator.geolocation) {
	      navigator.geolocation.getCurrentPosition(showPositionShim, showError);
	    } else {
	      var status = document.getElementById("gpsOutput");
	      status.innerHTML = "Geolocation is not supported by this browser.";
	    }
	  }
	  
	  function showPositionShim(position){
	    positions.push(position);
	    showPosition(position);
	  }
	  function showPosition(position) {
	    var geoPoint = position.coords.latitude + "," + position.coords.longitude;
	    var status = document.getElementById("gpsOutput");
	    status.innerHTML = "Your current location is: " + position.coords.latitude + " ,  " + position.coords.longitude;

	    // Get a nice map tile from google maps
	    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center=" +
	      geoPoint + "&markers=" + geoPoint + "&zoom=14&size=400x300&sensor=false&key=AIzaSyAiz04dIyeJ5NSgqXEnwr6-ZgG1wtXDkes";
	    document.getElementById("map").innerHTML = "<img src='" + img_url + "'>";
	  }

	  // show our errors for debuging
	  function showError(error) {
	    var x = document.getElementById("gpsOutput");
	    switch (error.code) {
	      case error.PERMISSION_DENIED:
		x.innerHTML = "Denied the request for Geolocation. Maybe, ask the user in a more polite way?"
		break;
	      case error.POSITION_UNAVAILABLE:
		x.innerHTML = "Location information is unavailable.";
		break;
	      case error.TIMEOUT:
		x.innerHTML = "The request to get location timed out.";
		break;
	      case error.UNKNOWN_ERROR:
		x.innerHTML = "An unknown error occurred :(";
		break;
	    }
	  }
	    
	    function loopStep(){
	      getLocation();
	      if (positions.length >=2){
		positions.forEach(function(item, index, array) {
		  if (index != 0){
		    prevPos = positions[index-1];
		    distance = distance + distanceBetween(prevPos.coords.latitude,prevPos.coords.longitude,item.coords.latitude,item.coords.longitude,"K")
		    console.log(prevPos.coords.latitude,prevPos.coords.longitude,item.coords.latitude,item.coords.longitude)
		    console.log(distance);
		    document.getElementById("distance").value = distance;
		  }
		})
	      }
	      console.log("hello")
	    };
	    function startLoop(){
	      if(!flag) loopStep();
	      console.log("alive!");
	      setTimeout(startLoop, 5000);
	    };
	    
	    function stopLoop(){
	      flag=true;
	    };
  </script>
</body>

</html>
