<?php
	session_start();
	require (__DIR__.'/../connection.php');

	if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
		header("location: /users/login.php");
	} else {
		$id = $_SESSION['userId'];
		$username = $_SESSION['username'];

		$sql = "SELECT * FROM users WHERE id = '$id'";
		$result = $mysqli->query($sql);
		$user = $result->fetch_assoc();
		$username = $user['username'];
	}
?>

		
<!DOCTYPE html> 

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="/assets/stylesheets/jquery.dynatable.css">
		<link rel="stylesheet" type="text/css" href="/assets/stylesheets/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/stylesheets/app.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Home</title>
	</head>
	<body>

	<!-- Google translate element -->
		<div class="grid-x">
			<div class="cell translate">								
				<div id="google_translate_element"></div>						
			</div>
		</div>

		<!-- Top-Bar -->
		<div class="grid-x">
			<div class="cell top-bar-cell">
				<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
					<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
					<div class="title-bar-title"><a href="/users/show.php?id=<?php echo $id ?>"><img src="/assets/images/Logo.png" alt="Get Reading Tracker"/></a></div> 
				</div>
				<div class="top-bar user-show-top-bar" id="responsive-menu">
					<div class="top-bar-left">
						<ul class="dropdown menu" id="dropdown-menu" data-dropdown-menu>
							
							<li id="home-link"><a href="/users/show.php?id=<?php echo $id ?>"><img src="/assets/images/Logo.png" alt="Get Reading Tracker"/></a></li>
							<li class="has-submenu">
								<a href="#" id="readers-label" onclick="checkReaders()">Readers</a>
								<?php 
									$sql = "SELECT id, name FROM readers WHERE username = '$username'";
									$result = $mysqli->query($sql);
								?>
    							<ul class="submenu menu vertical">
    								<?php while($row = $result->fetch_assoc()) { ?>
										<li class="readers-list"><a href="/readers/show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>
									<?php } ?>
    							</ul>
							</li>
						</ul>
					</div>
					<div class="top-bar-right">
						<ul class="menu">
							<li><a href="logout.php" title="Log Out">Log Out</a></li> 
						</ul>
					</div>
				</div>
			</div>	
		</div>

		<!-- Main image -->
		<div class="grid-x">
			<div class="cell">
				<div class="main-image-panel">
					<div class="grid-x">
						<div class="small-12 medium-6 medium-offset-5" id="welcome-panel">
							<h1 class="welcome-greeting">Welcome <?php echo $username?></h1>
						</div>
					</div>
					<div class="grid-x">
						<div class="small-12 medium-6 medium-offset-5" id="add-reader-panel">
							<a class="button large add-reader-button" href="#" data-open="add-reader-popup"><i class="fa fa-book" id="book-icon"></i>Add Reader</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Add reader popup window -->
		<div class="reveal" id="add-reader-popup" data-reveal>
			<form class="add-reader-form" action="/readers/create.php" method="post">
				<div class="grid-container">
					<div class="grid-x">
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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="/assets/javascripts/jquery.js"></script>
		<script src="/assets/javascripts/foundation.min.js"></script>
		<script src="/assets/javascripts/what-input.js"></script>
		<script src="/assets/javascripts/app.js"></script>
		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>	


