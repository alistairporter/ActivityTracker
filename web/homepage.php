<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
	
    <div class="sign-in-page">
		<a href="homepage.html"><img src="images/logo1.png" alt=""></a>
        <div class="user-icon">
            <div class="dropbtn"><img src="images/user-icon.png" alt="user-icon"> 
                <i class="drop-down"></i>
            </div>
              <div class="dropdown-content">
                <a href="profile.html">My profile</a>
                <a href="activity.html">Activities</a>
                <a href="index.html">Logout</a>
              </div>
        </div>
	</div>	

    <div class="navbar">
        <a href="homepage.html">Dashboard</a>
    </div>
    
    <div class="date">
        <p>Date</p>
    </div>
    
    <div class="data-analyse-box">
        <p>Report(Daily/Weekly)</p>
        <button type="button">View</button>
        <div class="data-box">

        </div>
    </div>

    <div class="personal-status-box">
        <p>Weight Information</p>
        <a href="weightpage.html"><button type="button">Update</button></a>
        <div class="data-box">
            <div class="weight-loss">
                <p>Total loss:</p>
			    <input type="text" placeholder="">
            </div>

            <div class="weights">
                <p>Weight:</p>
			    <input type="text" placeholder="">
            </div>
        </div>
    </div>

    <div class="hydration-box">
        <p>Hydration status</p>
        <a href="waterpage.html"><button type="button">Update</button></a>
        <div class="data-box">
            <div class="total-water">
                <p>Total water:</p>
			    <input type="text" placeholder="">
            </div>

            <div class="goal">
                <p>Goal:</p>
			    <input type="text" placeholder="">
            </div>
        </div>
    </div>

    <div class="extra-box">
        <div class="calories-burnt-box">
            <p>Calorie burnt</p>
            <input type="text" placeholder="">
        </div>

        <div class="activity-box">
            <a href="activity.html"><button type="activity-button">View activitie</button></a>
        </div>
    </div>

    <div class="content-box">
        
    </div>
</body>
   

</html>
