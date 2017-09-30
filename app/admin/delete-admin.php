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

if ( isset($_GET['email']) && strlen($_GET['email']) > 5 ) {
	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "DELETE FROM admins WHERE EMAIL='" . $_GET['email'] . "'";
	mysqli_query($conn, $sql);

	mysqli_close($conn);

	header("Location: https://jacobboddey.uk/chellaston/app/admin/view-admins.php");
	
}
else {
	header("Location: https://jacobboddey.uk/chellaston/app/admin/view-admins.php");
}



?>