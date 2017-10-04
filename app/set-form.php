<?php

$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

/*if (! (isset($_POST['email']) && isset($_POST['user-form']) ) ) {
	header( "Location: https://jacobboddey.uk/chellaston/app/index.php?error=not-logged-in" );
}

if ( strlen( $_POST['email'] ) < 5 || strlen( $_POST['user-form'] ) < 2 ) {
	header( "Location: https://jacobboddey.uk/chellaston/app/index.php?error=not-logged-in" );
	die();
}

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}*/

$sql = "INSERT INTO students VALUES ('" . $_POST['email'] . "', '" . $_POST['user-name'] . "', '" . $_POST['user-form'] . "') ON DUPLICATE KEY UPDATE FORM='" . $_POST['user-form'] . "'";
mysqli_query($conn, $sql);

mysqli_close($conn);

header( "Location: https://jacobboddey.uk/chellaston/app" );

?>