<?php
	session_start();
	//$_SESSION['error'] = '';
?> 

<!DOCTYPE html>

<html class="no-js" lang="en">
	
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
   		 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="/assets/stylesheets/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/stylesheets/app.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Log In</title>
	</head>
	
	<body>
	<!-- Google translate element -->
		<div class="grid-x">
			<div class="cell translate">								
				<div id="google_translate_element"></div>				
			</div>
		</div>

		<div class="grid-x">
			
			<!-- Website info -->
			<div class="medium-6 large-4 large-offset-2 app-info-cell">
					<h3>Welcome to</h3>
					<h2 class="name-custom">Get Reading Tracker</h2>
		      <p><span><i class="fa fa-edit"></i> Log your reading sessions</span></p>
		      <p><span><i class="fa fa-bar-chart"></i> Check your statistics</span></p>
		      <p><span><i class="fa fa-envelope-o"></i> Share your report</span></p>		
			</div>

			<!-- Log-in form -->
			<div class="medium-6 large-4 sign-in-form-cell">
				<form class="sign-in-form" action="/users/validate.php" method="post">
					<div class="alert alert-error"><?php echo $_SESSION['error'] ?></div>
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="medium-12 cell">
								<h4 class="text-center">Log In</h4>				    
								<label>Enter username:
									<input class="input-group-field" type="text" placeholder="Your username" name="username" required>
								</label>
								<label>Enter password:
									<input class="input-group-field" type="password" placeholder="Your password" name="password" required>
								</label>
								<p><input class="button expanded" type="submit" value="Log In"></p>
								<span><p class="text-center">Not yet registered? <a href="register.php">Register here.</a></p></span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Image Banner -->
		<div class="grid-x">
			<div class="cell">
				<img src="/assets/images/banner.jpg" alt="Welcome banner"></img>
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
		<script src="/assets/javascripts/jquery.js"></script>
		<script src="/assets/javascripts/foundation.min.js"></script>
		<script src="/assets/javascripts/what-input.js"></script>
		<script src="/assets/javascripts/app.js"></script>
		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>