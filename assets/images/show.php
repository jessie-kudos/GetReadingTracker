<?php
	session_start();
	$username = htmlspecialchars($_GET["username"]);
	$_SESSION['error'] = '';
	$_SESSION['info'] = '';
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');

	$sql = "SELECT username FROM users WHERE username = '$username'";

	$result = $mysqli->query($sql);
?>

<?php	if ($result->num_rows == 1): ?>
		
	<!DOCTYPE html>

	<html lang="en">
		<head>
			<meta charset="utf-8"/>
			<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/foundation.min.css">
			<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/app.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<title>Home</title>
		</head>
		<body>
			<div class="off-canvas position-left" id="offCanvas" data-off-canvas>

		    <!-- Menu -->
		    <?php 
					$sql2 = "SELECT id, name FROM reader WHERE username = '$username'";
					$result2 = $mysqli->query($sql2);
				?>
		    <ul class="vertical menu">
		    	<?php while($row = $result2->fetch_assoc()) { ?>
						<li class="readers-list"><a href="/~jessiekl/GetReadingTracker/readers/show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>
					<?php } ?>
		    </ul>

	  	</div>


				<div class="grid-x">
					<div class="cell translate">								
						<div id="google_translate_element"></div>						
					</div>
				</div>

				<div class="grid-x">
					<div class="cell top-bar-cell">
						<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
							<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
							<div class="title-bar-title"><a href="/~jessiekl/GetReadingTracker/users/show.php?username=<?php echo $username ?>"><img src="/~jessiekl/GetReadingTracker/assets/images/Logo.png" alt="Get Reading Tracker"/></a></div>
						</div>
						<div class="top-bar user-show-top-bar" id="responsive-menu">
							<div class="top-bar-left">
								<ul class="dropdown menu" data-dropdown-menu>
									<li class="menu-text"><a href="/~jessiekl/GetReadingTracker/users/show.php?username=<?php echo $username ?>"><img src="/~jessiekl/GetReadingTracker/assets/images/Logo.png" alt="Get Reading Tracker"/></a></li>
									<li class="has-submenu">
										<a href="#" id="readers-label">Readers</a>
										<?php 
											$sql2 = "SELECT id, name FROM reader WHERE username = '$username'";
											$result2 = $mysqli->query($sql2);
											?>
	    							<ul class="submenu menu vertical">
	    								<?php while($row = $result2->fetch_assoc()) { ?>
												<li class="readers-list"><a href="/~jessiekl/GetReadingTracker/readers/show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>
											<?php } ?>
	    							</ul>
									</li>
								</ul>
							</div>
							<div class="top-bar-right">
								<ul class="menu">
									<li><a href="/~jessiekl/GetReadingTracker/users/signin.php" title="SignOut">Sign Out</a></li>
								</ul>
							</div>
						</div>
					</div>	
				</div>

				<div class="grid-x">
					<div class="cell">
						<div class="main-image-panel">
							<div class="grid-x">
								<div class="small-6 small-offset-6" id="welcome-panel">
									<h4 class="welcome-greeting">Welcome <?php echo $username?></h4>
								</div>
							</div>
							<div class="grid-x">
								<div class="small-6 small-offset-6" id="add-reader-panel">
									<a class="button large add-reader-button" href="#" data-open="add-reader-popup"><i class="fa fa-book"></i>Add New Reader</a>
								</div>
							</div>
						</div>
					</div>
				</div>









			


				<div class="panel-image">
					<div class="grid-x">
						<div class="small-3 vertical-cell">

							<div class="callout large users-show">
								<h4 class="welcome-greeting">Welcome <?php echo $username?></h4>
							</div>

							<div class="grid-x">
								<div class="small-4 book-icon">
									<i class="fa fa-book"></i>
								</div>
								<div class="small-8">
									<div class="reader-dropdown-menu">
										<?php 
											$sql2 = "SELECT id, name FROM reader WHERE username = '$username'";
											$result2 = $mysqli->query($sql2);
										?>

										<ul class="vertical menu accordion-menu" data-accordion-menu>
										  <li>
										    <a class="readers-label">Readers</a>
										    <ul class="menu vertical">
										    <?php while($row = $result2->fetch_assoc()) { ?>
													<li><a href="/~jessiekl/GetReadingTracker/readers/show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>
										    <?php } ?>
										    </ul>
										  </li>
										</ul>
									</div>
								</div>
							</div>

							<div class="grid-x">
								<div class="cell">
									<div class="text-center">
										<a href="#" data-open="add-reader-popup">+ add new reader</a>
									</div>
								</div>
							</div>
						</div>
								
						<div class="small-9 cell">
							<img class="home-image" src="/~jessiekl/GetReadingTracker/assets/images/HomeImage.jpg" alt="Home Image"/>
						</div>	
					</div>
				</div>	

				<div class="reveal" id="add-reader-popup" data-reveal>
					<form class="add-reader-form" action="/~jessiekl/GetReadingTracker/readers/create.php" method="post">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-10 small-offset-1 cell">
									<h4>Add New Reader</h4>
									<div class="alert alert-error"><?php echo $_SESSION['error'] ?></div>
									<div class="alert alert-error"><?php echo $_SESSION['info'] ?></div>
									<label>Enter new reader name:
										<input class="input-group-field" type="text" placeholder="Reader name" name="readername" required>
										<input type="hidden" name="username" value="<?php echo $username?>">
									</label>
									<p><input class="button expanded" type="submit" value="Add"></p>
								</div>
							</div>
						</div>
					</form>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

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

<?php else:
	$_SESSION['error'] = "Username does not exist. Please create a new username.";
	header("location: /~jessiekl/GetReadingTracker/users/signup.php");
?>
<?php endif; ?>

