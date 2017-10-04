<?php

function isActiveToday( $email ) {
	
	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM activity WHERE EMAIL='" . $email . "' AND DATE(TIME) = CURDATE() ORDER BY TIME DESC";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows == 0) {
		return false;
	}
	else {
		
		return true;
	}

	mysqli_close($conn);

}

function getStatus( $email ) {
	
	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM activity WHERE EMAIL='" . $email . "' AND DATE(TIME) = CURDATE() ORDER BY TIME DESC";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows == 0) {
		return "in";
	}
	else {
		$row = mysqli_fetch_assoc($result);
		return $row['STATUS'];
	}

	mysqli_close($conn);
	
}

function isAdmin( $email ) {
	
	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM admins WHERE lower(EMAIL)='" . strtolower($email) . "'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows == 0) {
		return false;
	}
	else {
		return true;
	}

	mysqli_close($conn);
	
}

function isVerified( $email ) {
	
	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM verification WHERE lower(EMAIL)='" . strtolower($email) . "' AND TIME > DATE_SUB(NOW(), INTERVAL 65 MINUTE)";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows == 0) {
		return false;
	}
	else {
		return true;
	}

	mysqli_close($conn);
	
}

function allowedToSignOut() {
	
	$hour = date('H');
	$minute = date('i');
	if (($hour == 10 && ($minute > 55 && minute <= 59)) || ($hour == 11 && $minute < 10)) {
		return true;
	}
	if ($hour == 13 && ($minute > 9)) {
		return true;
	}
	return false;
}

function isNew( $email ) {

	$conn = mysqli_connect("localhost", "chellaston", "uN9LVwdLF7", "chellaston");
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM students WHERE lower(EMAIL)='" . strtolower($email) . "'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows == 0) {
		return true;
	}
	else {
		return false;
	}

	mysqli_close($conn);

}	

?>