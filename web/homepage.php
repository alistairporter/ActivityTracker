<?php
// Start the session
session_start();
//if not logged in redirect to signin page 
if (!$_SESSION["username"]) {
    header("Location: /signin.php");
    exit();
}



include "includes/database.php";
$sqlChart = "SELECT sum(burntCalories) as burntCalories, type FROM activity group by type ";
$resultChart = $conn->query($sqlChart);

        

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" href="css/css.css">
	

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      
//        google chart : Google Charts. (2020) Visualization: Column Chart. Google. 
// [Online] [Accessed on 4th April 2021] https://developers.google.com/chart/interactive/docs/gallery/columnchart


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Activity' , 'Calorie burnt'],
            <?php
            if(mysqli_num_rows($resultChart)>0){
                while($rowChart = mysqli_fetch_array($resultChart))
                {
                    echo "['".$rowChart['type']."',".$rowChart['burntCalories']."],";
                }
            }
          ?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Report',
            
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>



</head>

<body>


    <?php
    //connect to database
        //include "includes/database.php";

        $totalWloss='';
        $Weight='';
        $totalWater='';
        $goalWater=''; 
        $burntCalories='';
        $today = date("Y-m-d");

        // get the details of the logged in user 
        $userid =$_SESSION["userid"];

        $sqlweight = "SELECT totalLost, currentWeight From weight WHERE userid = $userid and DATE(date) = '$today' order by id desc limit 1";
        // fetch the result 
        $result = $conn->query($sqlweight);
        $row = $result->fetch_assoc();
        if (!$result) {
            die('Could not query:' . mysql_error());
        }

        $totalWloss= $row['totalLost'];
        $weight=$row['currentWeight']; 
 

        $sqlwater = "SELECT water, goalWater FROM water WHERE userid = $userid and DATE(date) = '$today' order by id desc limit 1";
        
        $resultWater = $conn->query($sqlwater);
        $rowWater = $resultWater->fetch_assoc();
        
        if (!$result) {
            die('Could not query:' . mysql_error());
        }

        $totalWater=$rowWater['water'];
        $goalWater=$rowWater['goalWater'];

        $sqlCal="SELECT burntCalories From activity WHERE userid = $userid and DATE(date) = '$today' order by id desc limit 1 ";

        $resultcalorie = $conn->query($sqlCal);
        $rowcalorie = $resultcalorie->fetch_assoc();
        
        if (!$result) {
            die('Could not query:' . mysql_error());
        }
        $burntCalories=$rowcalorie['burntCalories'];
    ?> 
	
    <div class="sign-in-page">
		<a href="homepage.php"><img src="images/logo1.png" alt=""></a>
        <div class="user-icon">
            <div class="dropbtn"><img src="images/user-icon.png" alt="user-icon"> 
                <i class="drop-down"></i>
            </div>
              <div class="dropdown-content">
                <a href="profile.php">My profile</a>
                <a href="activity.php">Activities</a>
                <a href="logout.php">Logout</a>
              </div>
        </div>
	</div>	

    <div class="navbar">
        <a href="homepage.php"></a>
    </div>
    
    <div class="date">
        <!--php code that show's today's date-->
        <p> <?php echo "Today's Date:".date("y/m/d")."<br>"; ?> </p>
    </div>
    
    <!-- chart location-->

    <div class="data-analyse-box">
        <button type="button">View</button>
        <div class="data-box"  id="columnchart_material">

        </div>
    </div>

    
        <div class="personal-status-box">
            <p>Weight Information</p>
            <a href="weightpage.php"><button type="button">Update</button></a>
            <div class="data-box">
                <div class="weight-loss">
                    <p>Total loss:</p>
    			    <input type="text" placeholder="" value="<?php echo $totalWloss; ?>" readonly>
                </div>
 
                <div class="weights">
                    <p>Weight:</p>
    			    <input type="text" placeholder="" value="<?php echo $weight;?>" readonly>
                </div>
            </div>
        </div>
    

  
        <div class="hydration-box">
            <p>Hydration status</p>
            <a href="waterpage.php"><button type="button">Update</button></a>
            <div class="data-box">
                <div class="total-water">
                    <p>Total water:</p>
    			    <input type="text" placeholder="" value="<?php echo $totalWater ?>" readonly>
                </div>

                <div class="goal">
                    <p>Goal:</p>
    			    <input type="text" placeholder="" value="<?php echo $goalWater; ?>" readonly>
                </div>
            </div>
        </div>
      
      

        <div class="extra-box">
            <div class="calories-burnt-box">
                <p>Calorie burnt</p>
                <input type="text" placeholder="" value="<?php echo $burntCalories;?>" readonly>
            </div>

            <div class="activity-box">
                <a href="activity.php"><button type="activity-button">View activitie</button></a>
            </div>
        </div>
  

    <div class="content-box">
        
    </div>
</body>
   

</html>
