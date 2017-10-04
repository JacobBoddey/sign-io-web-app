<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../util.php';

session_start();

$config = [];

$request = new \Zend\Http\PhpEnvironment\Request();
$ad = new \Magium\ActiveDirectory\ActiveDirectory(
    new \Magium\Configuration\Config\Repository\ArrayConfigurationRepository($config),
    Zend\Psr7Bridge\Psr7ServerRequest::fromZend(new \Zend\Http\PhpEnvironment\Request())
);

$entity = $ad->authenticate();

if (!isAdmin( $entity->getPreferredUsername() )) {
	header( "Location: https://jacobboddey.uk/chellaston/app" );
}

?>

<head>
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<meta name="viewport" content="width=device-width" />
	<meta name="theme-color" content="#008A5F" />
	<meta name="msapplication-navbutton-color" content="#008A5F">
	<meta name="apple-mobile-web-app-status-bar-style" content="#008A5F">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>Chellaston Academy</title>
	<link rel="icon" type="image/png" href="../img/favicon.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

	<ul class="navigation-bar">
		<li class="active"><a href="../admin"><img width=30px src="../../img/left-arrow.png"></img></a></li>
		<li class="navigation-text">Chellaston Academy</li>
		<a href="../account.php"><li class="navigation-admin" style="float:right"><img width=30px align="right" src="../../img/account.png"></img></li></a>
	</ul>
	
	<div class="main-block" style="margin-top:84px;">
	 
		<h4 class="text">View Activity</h4>
		
		<div class="button" style="padding: 5px 10px 5px 10px">Today</div>
		<div class="button" style="padding: 5px 10px 5px 10px">Yesterday</div>
		<div class="button" style="padding: 5px 10px 5px 10px">Other</div>
		
		<table style="width:100%">
			<col width="10%">
			<col width="60%">
			<col width="10%">
			<tr>
				<th style="text-align:left" class="text">Time</th>
				<th style="text-align:left" class="text">Name</th>
				<th style="text-align:left" class="text">Status</th>
			<tr>
			
			<?php
			
				$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT activity.TIME, students.NAME, students.FORM, activity.STATUS, activity.REASON FROM activity INNER JOIN students ON activity.EMAIL = students.EMAIL WHERE activity.time >= CURDATE() ORDER BY TIME DESC;";
				$result = mysqli_query($conn, $sql);

				$lastform = "";
				while ($row = mysqli_fetch_array($result)) {
					$time = strtotime($row['TIME']);
					$timeFormat = date("H:i", $time);
					echo '<tr><td class="text">' . $timeFormat . '</td><td class="text">' . $row['NAME'] . '</td><td class="text">' . strtoupper($row['STATUS']) . '</td></tr>';
				}
				mysqli_close($conn);
			
			?>
		</table>
		
		<br>
		<br>

	</div>

		
</body>