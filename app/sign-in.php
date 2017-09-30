<?php

$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

if (! (isset($_POST['name']) && isset($_POST['email']) ) ) {
	header( "Location: https://jacobboddey.uk/chellaston/app/index.php?error=not-logged-in" );
}

if ( strlen( $_POST['name'] ) < 2 || strlen( $_POST['email'] ) < 2 ) {
	header( "Location: https://jacobboddey.uk/chellaston/app/index.php?error=not-logged-in" );
	die();
}

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
$reason = $_POST['reason'];

if ( isset( $_POST['other'] ) && strlen( $_POST['other'] ) > 0 ) {
	$reason = $_POST['other'];
}

$sql = "INSERT INTO students VALUES ('" . date( 'Y-m-d H:i:s' ) . "', '" . $_POST['name'] . "', '" . $_POST['email'] . "', 'in', '" . $reason . "')";
mysqli_query($conn, $sql);

mysqli_close($conn);

header( "Location: https://jacobboddey.uk/chellaston/app" );

?>