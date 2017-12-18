<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="en">
	
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/app.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Sign Up</title>
	</head>
	
	<body>
		<!-- Google translate element -->
		<div class="grid-x">
			<div class="cell translate">								
				<div id="google_translate_element"></div>						
			</div>
		</div>

		<!-- Sign-up form -->
		<div class="grid-x">
			<div class="small-12 medium-10 medium-offset-1 large-6 large-offset-3" id="sign-up-form-cell">
				<form class="sign-up-form" action="/~jessiekl/GetReadingTracker/users/create.php" method="post">
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="small-10 small-offset-1 cell">
								<h4 class="text-center">New User Sign Up</h4>
								<div class="alert alert-error"><?php echo $_SESSION['error'] ?></div>
								<div class="alert alert-error"><?php echo $_SESSION['info'] ?></div>
							  	<label>Enter username:
							  		<input class="input-group-field" type="text" placeholder="Your username" name="username" required>
							  	</label>
								<p><input class="button expanded" type="submit" value="Sign Up"></p>
								<span><p class="text-center">Already have a username? <a href="signin.php">Sign in here.</a></p></span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Image Banner -->
		<div class="grid-x">
			<div class="cell">
				<img src="/~jessiekl/GetReadingTracker/assets/images/banner.jpg" alt="Welcome banner"></img>
			</div>
		</div>

		<!-- Footer -->
		<div class="grid-x">
			<div class="small-6 cell">
				<div class="footer-text-container">
					<p class="footer-text">Last Modified: </p>
				</div>
			</div>
			<div class="small-6 cell">
				<p id="last-modified"> </p>
			</div>
		</div>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/foundation.min.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/what-input.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/app.js"></script>
		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>