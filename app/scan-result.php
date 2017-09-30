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

$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

if (!isset($_GET['code'])) {
	header( "Location: https://jacobboddey.uk/chellaston/app/scan.php" );
}

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

echo 'Code is: ' . $_GET['code'];

$sql = "INSERT INTO verification VALUES ('" . $entity->getPreferredUsername() . "', '" . date( 'Y-m-d H:i:s' ) . "')";

mysqli_query($conn, $sql);

header( "Location: https://jacobboddey.uk/chellaston/app/index.php" );

?>