<?php
// Start the session
session_start();

//if not logged in redirect to signin page 
if ($_SESSION["username"]) {
	//header("Location: /signin.php");
	//exit();
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fitness Tracker</title>
	<link rel="stylesheet" href="css/css.css">
	<script src="js/js.js"></script>
</head>

<body>
	<div class="logo">
		<a href="index.php"><img src="images/logo.png" alt=""></a>
	</div>	
<?php echo 'Welcome '. $_SESSION["firstname"]; ?>
	<div class="buttons" >
		<!-- sepi :  removed space from filename -->
		<!-- sepi changed signin/sinup to . php -->
		<a href="signin.php" class="login">Sign in</a>
		<a href="signup.php" class="account register">create an account</a>
	</div>
	
	<div class="slide-container">
		<span id="slider-image-1"></span>
		<span id="slider-image-2"></span>
		<span id="slider-image-3"></span>
		<span id="slider-image-4"></span>

		<div class="image-container">
			<img src="images/1.jpg" class="slider-image" >
			<img src="images/2.jpg" class="slider-image" >
			<img src="images/3.jpg" class="slider-image">
			<img src="images/4.jpg" class="slider-image" >
		</div>

		<div class="button-container">
			<a href="#slider-image-1" class="slider-button"></a>
			<a href="#slider-image-2" class="slider-button"></a>
			<a href="#slider-image-3" class="slider-button"></a>
			<a href="#slider-image-4" class="slider-button"></a>
		</div>
	</div>
	
	
</body>

</html>