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
		<li class="active"><a href="../"><img width=30px src="../../img/left-arrow.png"></img></a></li>
		<li class="navigation-text">Chellaston Academy</li>
		<?php
			echo '<a href="../account.php"><li class="navigation-admin" style="float:right"><img width=30px align="right" src="../../img/account.png"></img></li></a>';
		?>
	</ul>
	
	<div class="main-block" style="margin-top:84px;">
	 
		<h4 class="text">Welcome back, <?php echo explode(' ', $entity->getName())[0]; ?></h4>
	
		<div class="button" id="view-activity" style="background-color:#008A5F;"><a href="view-activity.php" style="text-decoration: none;color:white;">View Activity</a></div>
		<div class="button" id="print-list" style="background-color:#cc3131;"><a href="print-list.php" style="text-decoration: none;color:white;">Print List</a></div>
		<div class="button" id="student-search" style="background-color:#008A5F;"><a style="text-decoration: none;color:white;">Student Search</a></div>
		
		<hr><br>
		
		<div class="button" id="statistics" style="background-color:#008A5F;"><a style="text-decoration: none;color:white;">Statistics</a></div>
		<div class="button" id="view-admins" style="background-color:#008A5F;"><a href="view-admins.php" style="text-decoration: none;color:white;">View Admins</a></div>
	
	</div>

		
</body>