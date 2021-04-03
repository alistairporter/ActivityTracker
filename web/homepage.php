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
		<a href="homepage.php"><img src="images/logo.png" alt=""></a>
        <div class="user-icon">
            <div class="dropbtn"><img src="images/user-icon.png" alt="user-icon"> 
                <i class="drop-down"></i>
            </div>
              <div class="dropdown-content">
                <a href="profile.php">My profile</a>
                <a href="activity.php">Activities</a>
                <a href="index.php">Logout</a>
              </div>
        </div>
	</div>	

    <div class="navbar">
        <a href="homepage.php">Dashboard</a>
        <a href="log.php">Log</a>
    </div>

    <p>Date</p>
    <div class="data-analyse-box">
        <p>Report(Daily/Weekly)</p>
        <button type="button">View</button>
        <div class="data-box">

        </div>
    </div>

    <div class="personal-status-box">
        <p>Personal Status</p>
        <a href="weightpage.php"><button type="button">Modify</button></a>
        <div class="data-box">

        </div>
    </div>

    <div class="hydration-box">
        <p>Hydration status</p>
        <a href="waterpage.php"><button type="button">Modify</button></a>
        <div class="data-box">

        </div>
    </div>

    <div class="extra-box">
        <div class="calories-burnt-box">
            <p>Calorie burnt</p>
            <p1>Daily goal</p1>
        </div>

        <div class="activity-box">
            <a href="activity.php"><button type="activity-button">View activitie</button></a>
        </div>
    </div>

    <div class="content-box">
        
    </div>
</body>
   

</html>
