<?php

function connectToDB()
{
	try {
		$db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		if (mysqli_connect_errno()) {
			throw new exception("Unable to connect to database");
		}
		else {
			return $db;
		}
	}
	catch(exception $e) {
		echo $e->getMessage();
	}
}

function displayUserMessage()
{
	$db = connectToDB();
	$userName = $_GET['q'];
	$qry = "SELECT userName FROM user1 WHERE userName = '$userName'";
	$result = $db->query($qry);
	if ($result) {
		if ($result->num_rows > 0) {
			$msg = "User Name taken";
		}
		else {
			$msg = "User Name available";
		}
	}
	else {
		echo "Error executing query";
	}
	return $msg;
}

include "../conf.php";
$msg = displayUserMessage();
echo $msg;

?>