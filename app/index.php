<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/util.php';
session_start();

$config = [];

$request = new \Zend\Http\PhpEnvironment\Request();
$ad = new \Magium\ActiveDirectory\ActiveDirectory(
    new \Magium\Configuration\Config\Repository\ArrayConfigurationRepository($config),
    Zend\Psr7Bridge\Psr7ServerRequest::fromZend(new \Zend\Http\PhpEnvironment\Request())
);

$entity = $ad->authenticate();

if (isset($_GET['code'])) {
	header( "Location: https://jacobboddey.uk/chellaston/app" );
}

?>

<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#008A5F" />
	<meta name="msapplication-navbutton-color" content="#008A5F">
	<meta name="apple-mobile-web-app-status-bar-style" content="#008A5F">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>Chellaston Academy</title>
	<link rel="icon" type="image/png" href="/img/favicon.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

	<ul class="navigation-bar">
		<li class="active" onclick="openNav()"><img width=30px src="../img/bars.png"></img></li>
		<li class="navigation-text">Chellaston Academy</li>
		<?php
			if ( isAdmin( $entity->getPreferredUsername() ) ) {
				echo '<a href="admin/index.php"><li class="navigation-admin" style="float:right"><img width=30px align="right" src="../img/settings.png"></img></li></a>';
			}
			else {
				echo '<a href="account.php"><li class="navigation-admin" style="float:right"><img width=30px align="right" src="../img/account.png"></img></li></a>';
			}
		?>
	</ul>
	
	<div class="time-block" style="margin-top:64px;">
		<center>
			<h1><div id="time"></div></h1>
			<img class="small-logo" width=75px src="../img/logo.png"></img>
		</center>
	</div>
	
	<div class="main-block">
	
		<?php 
			if (isActiveToday( $entity->getPreferredUsername() ) ) {
				echo '<div class="alert alert-success text">
				<center>You are currently <strong>signed ' . getStatus( $entity->getPreferredUsername() ) . '</strong></center></div>';
			}
			
			if (!allowedToSignOut()) {
				echo '<div class="alert alert-danger text">
				<center><strong>Warning: </strong>You are not currently permitted to sign out</center></div>';
			}
			$verified = isVerified( $entity->getPreferredUsername() );
			
		?>
		
		<h4 class="text" style="font-size:20px;">Sign In/Out</h4>
		
		<?php 
			
			if (!$verified) {
				echo '<h4 class="text">You are not currently verified. In order to sign in or out, you must scan the QR code at reception</h4>';
				echo '<div class="button"><a href="scan.php" style="text-decoration: none;color:white;">Scan</a></div>';
			}
			
		?>
		
		<h4 class="text">Please choose a reason from the dropdown below or enter your own</h4>
		
		<form method="POST" action="database.php">
		
			<center>
				<select name="reason" id="reason">
					<option value="No lessons before lunch">No lessons before lunch</option>
					<option value="Returning after break or lunch">Returning after break or lunch</option>
					<option value="Appointment">Appointment</option>
					<option value="Other" maxlength="64">Other</option>
				</select>
				<input id="other" class="textbox" type="text" name="other" placeholder="Enter a reason">
				<input type="hidden" name="email" value="<?php echo $entity->getPreferredUsername(); ?>">
				<input type="hidden" name="name" value="<?php echo $entity->getName(); ?>">
		
			</center>
			
			<?php 
				if ( $verified ) {
					echo '<center><br><h4 class="status-text">Status: Verified</h4>';
					echo '	<button class="button" type="submit" formaction="sign-in.php">Sign In</button>
							<button class="button" type="submit" formaction="sign-out.php">Sign Out</button>
						</center>';
				}
				else {
					echo '<center><h4 class="status-text">Status: Unverified</h4>';
					echo '<div class="button" id="sign-in-button" style="background-color:#848484;"><a style="text-decoration: none;color:white;">Sign In</a></div>
							<div class="button" id="sign-out-button" style="background-color:#848484;"><a style="text-decoration: none;color:white;">Sign Out</a></div>
						</center>';
				}
			?>
				
		</form>
			
		<br>
	
	</div>
	
	<div id="side-navigation" class="side-navigation">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div class="button" style="text-align:center;width:100%;padding: 10 0 20 0;position:absolute;bottom:55"><a href="../logout" style="text-decoration: none;color:white;">Logout</a></div>
	</div>
	
	<?php 
	    if (isNew($entity->getPreferredUsername())) {
			echo '
				<div id="welcome-modal" class="welcome-modal">
					<center>
					<div class="welcome-modal-content">
						<form action="set-form.php" method="POST">
							<h4 class="text" style="margin-top:5px;">Welcome</h4>
							<h4 class="text" style="margin-bottom: 10px;">Enter your form:</h4>
							<select name="user-form" id="user-form">
								<option value="13MSM">13 MSM</option>
								<option value="13CWT">13 CWT</option>
								<option value="13MVY">13 MVY</option>
								<option value="13WRN">13 WRN</option>
							</select>
							<input id="user-name" name="user-name" type="hidden" value="' . $entity->getName() . '">
							<input id="email" name="email" type="hidden" value="' . $entity->getPreferredUsername() . '">
							<br>
							<button style="padding: 5px 10px 5px 10px;margin-top: 15px;" type="submit" class="button">Submit</button>
						</form>
						<br>
						
					</div>
					</center>
				</div>
			';
		}
		?>
</body>

<script>

	function openNav() {
		document.getElementById("side-navigation").style.width = "250px";
	}

	function closeNav() {
		document.getElementById("side-navigation").style.width = "0";
	}
	
	function updateTime() {
		
		var time = new Date();
		var hours = time.getHours();
		var minutes = time.getMinutes();
		
		if (minutes < 10) {
			minutes = "0" + minutes;
		}
		
		if (hours < 10) {
			hours = "0" + hours;
		}
		
		var timeString = hours + ":" + minutes;
		
		document.getElementById('time').innerHTML = timeString;
		setInterval(updateTime, 60000);
		
	}
	
	window.onload = updateTime;
	
</script>