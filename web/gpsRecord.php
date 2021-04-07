<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Running</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
	<script>
	      // check for Geolocation support
		if (navigator.geolocation) {
		  console.log('Geolocation is supported!');
		}
		else {
		  console.log('Geolocation is not supported for this Browser/OS version yet.');
		}

		window.onload = function() {
		  var startPos;
		  navigator.geolocation.getCurrentPosition(function(position) {
		    startPos = position;
		    document.getElementById('startLat').innerHTML = startPos.coords.latitude;
		    document.getElementById('startLon').innerHTML = startPos.coords.longitude;
		  });
		};
	    window.addEventListener("DOMContentLoaded", track.init);
	</script>
</head>

<body>
    <div class="sign-in-page">  
        <a href="homepage.php"><img src="images/logo.png" alt=""></a>
    </div>

    <div class="running-container">
        <h1>GPS</h1>
    </div>

    <div class="running-button-container">
        <button type="button" value="start button">Start</button>
        <button type="button" value="end button">End</button>
    </div>
    
    <div id="tripmeter">
	<p>
	    Starting Location (lat, lon):<br/>
	    <span id="startLat">???</span>°, <span id="startLon">???</span>°
	  </p>
	  <p>
	    Current Location (lat, lon):<br/>
	    <span id="currentLat">???</span>°, <span id="currentLon">???</span>°
	  </p>
	  <p>
	    Distance from starting location:<br/>
	    <span id="distance">0</span> km
	</p>
    </div>
</body>

</html>
