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
	 
		<h4 class="text">Viewing Admins</h4>
		
		<table style="width:100%">
			<col width="80%">
			<col width="20%">
			<tr>
				<th style="text-align:left" class="text">Name</th>
				<th><img width=15px src="../../img/delete.png"></img></th>
			<tr>
			<?php
			
				$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT * FROM admins";
				$result = mysqli_query($conn, $sql);

				while ($row = mysqli_fetch_array($result)) {
					echo '<tr><td class="text">' . $row['NAME'] . '</td><td style="text-align:center;"><a href="delete-admin.php?email=' . $row['EMAIL'] . '"><img width=15px src="../../img/delete.png"></img></a></td></tr>';
				}

				mysqli_close($conn);
			
			?>
		</table>
		
		<h4 class="text">Add a new admin</h4>
		<form method="POST" action="add-admin.php">
			<input class="textbox" id="admin-name" name="admin-name" type="text" placeholder="Name">
			<input class="textbox" id="admin-email" name="admin-email" type="text" placeholder="Email">
			<button type="submit" style="font-size:15px;margin-top:10px;display:block;" class="button">Add</button>
		</form>

	</div>

		
</body>