<?php
	session_start();
	$id = htmlspecialchars($_GET["id"]);
	$_SESSION['error'] = '';
	$_SESSION['info'] = '';
	$mysqli = new mysqli('localhost', 'jessiekl', 'jessieklabyz', 'jessiekl');

	$sql = "SELECT name, username FROM reader WHERE id = '$id'";

	if (!$result = $mysqli->query($sql)) {
		echo "error";
	}

	$reader = $result->fetch_assoc();
	$username = $reader['username'];
	$readername = $reader['name'];
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/jquery.dynatable.css">
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/jtable.min.css">
		<link rel="stylesheet" type="text/css" href="/~jessiekl/GetReadingTracker/assets/stylesheets/app.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Reader Home</title>
	</head>
	<body>

		<!-- Google translate element -->
	  <div class="grid-x">
			<div class="cell translate">								
				<div id="google_translate_element"></div>						
			</div>
		</div>
	
		<!-- Responsive Top Bar -->
		<div class="grid-x">
			<div class="cell top-bar-cell">
				<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
					<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
					<div class="title-bar-title"><a href="/~jessiekl/GetReadingTracker/users/show.php?username=<?php echo $username ?>"><img src="/~jessiekl/GetReadingTracker/assets/images/Logo.png" alt="Get Reading Tracker"/></a></div>
				</div>
				<div class="top-bar user-show-top-bar" id="responsive-menu">
					<div class="top-bar-left">
						<ul class="dropdown menu" data-dropdown-menu>
							<li id="home-link"><a href="/~jessiekl/GetReadingTracker/users/show.php?username=<?php echo $username ?>"><img src="/~jessiekl/GetReadingTracker/assets/images/Logo.png" alt="Get Reading Tracker"/></a></li>
							<li class="has-submenu">
								<a href="#" id="readers-label" onclick="addReaderAlert()">Readers</a>
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

		<div class="stats-panel">
			<div class="grid-x">
				<div class="small-3 cell reader-panel">
						<h4 class="reader"><?php echo $readername ?></h4>
				</div>

				<div class="small-9 cell">
					<div class="stats-list">
						<?php 
							$sql1 = "SELECT IFNULL(SUM(minutes),0) AS weeklyminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND readerid = '$id'";
							$result1 = $mysqli->query($sql1);
							$row1 = $result1->fetch_assoc();
							$weeklyminutes = $row1['weeklyminutes'];

							$sql2 = "SELECT IFNULL(SUM(finished),0) AS weeklybooks FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND readerid = '$id'";
							$result2 = $mysqli->query($sql2);
							$row2 = $result2->fetch_assoc();
							$weeklybooks = $row2['weeklybooks'];

							$sql3 = "SELECT IFNULL(SUM(minutes),0) AS totalminutes FROM readingsession WHERE readerid = '$id'";
							$result3 = $mysqli->query($sql3);
							$row3 = $result3->fetch_assoc();
							$totalminutes = $row3['totalminutes'];

							$sql4 = "SELECT IFNULL(SUM(finished),0) AS totalbooks FROM readingsession WHERE readerid = '$id'";
							$result4 = $mysqli->query($sql4);
							$row4 = $result4->fetch_assoc();
							$totalbooks = $row4['totalbooks'];
						?>
						<div class="grid-x">
							<div class="small-3">
								<p class="stat-number"><?php echo $weeklyminutes ?></p>
							</div>
							<div class="small-3">
								<p class="stat-number"><?php echo $weeklybooks ?></p>
							</div>
							<div class="small-3">
								<p class="stat-number"><?php echo $totalminutes ?></p>
							</div>
							<div class="small-3">
								<p class="stat-number"><?php echo $totalbooks ?></p>
							</div>
						</div>

						<div class="grid-x">
							<div class="small-3">
								<p class="stat-name">Minutes This Week</p>
							</div>
							<div class="small-3">
							<p class="stat-name">Books This Week</p>
							</div>
							<div class="small-3">
								<p class="stat-name">Minutes Total</p>
							</div>
							<div class="small-3">
								<p class="stat-name">Books Total</p>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>

		<!-- Tabs (Add Reading Session, Statistics, Share Report) -->
		<div class="grid-x">
			<div class="cell">
				<ul class="tabs" data-tabs id="readers-tabs">
					<div class="grid-x">
						<div class="small-4 cell" id="tab-container">
							<li class="tabs-title is-active"><a href="#panel1" aria-selected="true"><i class="fa fa-edit"></i> Add Reading Session</a></li>
						</div>
						<div class="small-4 cell" id="tab-container">
							<li class="tabs-title"><a data-tabs-target="panel2" href="#panel2"><i class="fa fa-bar-chart"></i> Statistics</a></li>
						</div>
						<div class="small-4 cell" id="tab-container">
							<li class="tabs-title"><a data-tabs-target="panel3" href="#panel3"><i class="fa fa-envelope-o"></i> Share Report</a></li>
						</div>

					</div>
				</ul>
			</div>
		</div>	

		<!-- Add Reading Session -->
		<div class="tabs-content" data-tabs-content="readers-tabs">			
			<div class="tabs-panel is-active" id="panel1">
				<div class="grid-x">
					<div class="cell">
						<form class="add-reading-session-form" action="/~jessiekl/GetReadingTracker/reading_sessions/create.php" method="post">
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<div class="small-10 large-offset-1 cell">
										<h2 class="text-center">Add Reading Session</h2>
										<div class="alert alert-error"><?php echo $_SESSION['error'] ?></div>
										<div class="alert alert-error"><?php echo $_SESSION['info'] ?></div>

										<div class="grid-x grid-padding-x">
											<div class="small-4 cell">
												<labe>Date:
													<input class="input-group-field" type="date" placeholder="Date" name="sessiondate">
												</labe>
											</div>

											<div class="small-4 cell">
												<label>Title:
													<input class="input-group-field" type="text" placeholder="Title" name="title">
												</label>
											</div>

											<div class="small-4 cell">
												<label>Author:
													<input class="input-group-field" type="text" placeholder="Author" name="author">
												</label>
											</div>
										</div>

										<div class="grid-x grid-padding-x">
											<div class="small-4 cell">
												<label>Minutes read:
													<input class="input-group-field" type="number" placeholder="Minutes" name="minutes">
												</label>
											</div>

											<div class="small-4 cell" id="finished-checkbox">
												<input type="checkbox" name="finished" value="1"> Finished?
						  					<input type="hidden" name="readerid" value="<?php echo $id ?>">
											</div>	
										</div>

										<div class="grid-x grid-padding-x">
											<div class="cell">
												<input class="button" type="submit" value="Add Session">
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Statistics -->
			<div class="tabs-panel" id="panel2">
				<div class="grid-x">
					<div class="cell">
						
						<!-- Vertical Bar Graph -->
						<div class="bar-graph-callout">

							<?php
								$sql6 = "SELECT IFNULL(SUM(minutes),0) AS sundayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '6' AND readerid = '$id'";
								$result6 = $mysqli->query($sql6);
								$row6 = $result6->fetch_assoc();
								$sundayminutes = $row6['sundayminutes'];

								$sql7 = "SELECT IFNULL(SUM(minutes),0) AS mondayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '0' AND readerid = '$id'";
								$result7 = $mysqli->query($sql7);
								$row7 = $result7->fetch_assoc();
								$mondayminutes = $row7['mondayminutes'];

								$sql8 = "SELECT IFNULL(SUM(minutes),0) AS tuesdayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '1' AND readerid = '$id'";
								$result8 = $mysqli->query($sql8);
								$row8 = $result8->fetch_assoc();
								$tuesdayminutes = $row8['tuesdayminutes'];

								$sql9 = "SELECT IFNULL(SUM(minutes),0) AS wednesdayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '2' AND readerid = '$id'";
								$result9 = $mysqli->query($sql9);
								$row9 = $result9->fetch_assoc();
								$wednesdayminutes = $row9['wednesdayminutes'];

								$sql10 = "SELECT IFNULL(SUM(minutes),0) AS thursdayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '3' AND readerid = '$id'";
								$result10 = $mysqli->query($sql10);
								$row10 = $result10->fetch_assoc();
								$thursdayminutes = $row10['thursdayminutes'];

								$sql11 = "SELECT IFNULL(SUM(minutes),0) AS fridayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '4' AND readerid = '$id'";
								$result11 = $mysqli->query($sql11);
								$row11 = $result11->fetch_assoc();
								$fridayminutes = $row11['fridayminutes'];

								$sql12 = "SELECT IFNULL(SUM(minutes),0) AS saturdayminutes FROM readingsession WHERE (WEEK(sessiondate) = WEEK(CURDATE())) AND WEEKDAY(sessiondate) = '5' AND readerid = '$id'";
								$result12 = $mysqli->query($sql12);
								$row12 = $result12->fetch_assoc();
								$saturdayminutes = $row12['saturdayminutes'];
							?>

							<h2 class="text-center">Weekly Minutes</h2>
							<div>
								<ul class="bar-graph">
								  <li class="bar-graph-axis">
								    <div class="bar-graph-label">100</div>
								    <div class="bar-graph-label">80</div>
								    <div class="bar-graph-label">60</div>
								    <div class="bar-graph-label">40</div>
								    <div class="bar-graph-label">20</div>
								    <div class="bar-graph-label">0</div>
								  </li>
								  <li class="bar sun" style="height: <?php echo $sundayminutes ?>%;" title="<?php echo $sundayminutes ?>">
								    <div class="percent"><?php echo $sundayminutes ?></div>
								    <div class="description">Sunday</div>
								  </li>
								  <li class="bar mon" style="height: <?php echo $mondayminutes ?>%;" title="<?php echo $mondayminutes ?>">
								    <div class="percent"><?php echo $mondayminutes ?></div>
								    <div class="description">Monday</div>
								  </li>
								  <li class="bar tues" style="height: <?php echo $tuesdayminutes ?>%;" title="<?php echo $tuesdayminutes ?>">
								    <div class="percent"><?php echo $tuesdayminutes ?></div>
								    <div class="description">Tuesday</div>
								  </li>
								  <li class="bar wed" style="height: <?php echo $wednesdayminutes ?>%;" title="<?php echo $wednesdayminutes ?>">
								    <div class="percent wed"><?php echo $wednesdayminutes ?></div>
								    <div class="description wed">Wednesday</div>
								  </li>
								  <li class="bar thurs" style="height: <?php echo $thursdayminutes ?>%;" title="<?php echo $thursdayminutes ?>">
								    <div class="percent"><?php echo $thursdayminutes ?></div>
								    <div class="description">Thursday</div>
								  </li>
								  <li class="bar fri" style="height: <?php echo $fridayminutes ?>%;" title="<?php echo $fridayminutes ?>">
								    <div class="percent"><?php echo $fridayminutes ?></div>
								    <div class="description">Friday</div>
								  </li>
								  <li class="bar sat" style="height: <?php echo $saturdayminutes ?>%;" title="<?php echo $saturdayminutes ?>">
								    <div class="percent"><?php echo $saturdayminutes ?></div>
								    <div class="description">Saturday</div>
								  </li>
								</ul>
							</div>
						</div>

						<!-- Sessions Table -->
						<div class="table-callout">
							<h2 class="text-center">Reading Sessions</h2>
							<div id="session-table-container"></div>
							<input type-"hidden" id="readerid" value="<?php echo $id ?>"/>
						</div>

						<!-- Title info popup -->
						<div class="small reveal" id="info-modal" data-reveal>
							<section id="book-info">
							</section>
								<h4 id="book-title"></h4>
								<img id="book-image" src="no-image">
								<p id="book-description"></p>
								<p id="book-author"></p>
								<p id="book-publisher"></p>
								<p id="book-date"></p>
								<p id="book-page-count"></p>

							<button class="close-button" data-close aria-label="Close modal" type="button">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Share Report -->
			<div class="tabs-panel" id="panel3">
				<div class="grid-x">
					<div class="small-6 small-offset-3 cell">
						<section id="share-report-show">
							<form class="send-report-form" action="" post="">
								<div class="grid-container">
									<div class="grid-x grid-padding-x">
										<div class="small-10 small-offset-1 cell">
											<h4>Share Report</h4>
											<label>Enter your email:
												<input class="input-group-field" type="email" placeholder="Your email" name="youremail" required>
											</label>
											<label>Enter the recipient's email:
												<input class="input-group-field" type="email" placeholder="Recipient email" name="recipientemail" required>
											</label>
											<p><a href="/~jessiekl/GetReadingTracker/readers/show.php?id=<?php echo $id ?>" class="button expanded">Send</a></p>
										</div>
									</div>
								</div>
							</form>
						</section>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Reader Button -->
		<div class="grid-x">
			<div class="small-6 small-offset-3 cell">
				<form class="form delete-reader" action="/~jessiekl/GetReadingTracker/readers/delete.php" method="post">
					<input type="submit" class="button small expanded delete-reader" id="btn-submit" value="Delete Reader" onclick=""></input>
					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="hidden" name="username" value="<?php echo $username?>">
				</form>
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

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery-3.2.1.min.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery-ui.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery.jtable.min.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/jquery.dynatable.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/foundation.min.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/what-input.js"></script>
		<script src="/~jessiekl/GetReadingTracker/assets/javascripts/app.js"></script>
		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	</body>
</html>