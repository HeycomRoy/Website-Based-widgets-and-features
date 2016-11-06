<?php
function connectToDB()
{
	$db = new mysqli("localhost","root","","myfirstdatabase");
	if (mysqli_connect_errno()) {
		die("<h3>Failed to Establish Database Connection!".mysqli_connect_error()."</h3>");
	}
	return $db;
}

	header('Content-Type: text/xml');   	//  indicate that content is xml
	header('Cache-Control: no-cache, must-revalidate');
	$db = connectToDB();
	$id = $_GET['q'];
	if (!$id) {
		exit;
	}
	$qry = "SELECT ID, fname, email, phone FROM customers WHERE ID = $id";
	$result = $db->query($qry);
	if ($result) {
		if ($result->num_rows > 0) {
			$cust = $result->fetch_assoc();
		}
		else {
			die("Customer record not found!");
		}
	}
	else {
		die("Error executing query");
	}
	$xml = '<?xml version="1.0" encoding="ISO-8859-1" ?>';
	$xml .= '<customer>'."\n";
	$xml .= '<name>'.$cust['fname'].'</name>'."\n";
	$xml .= '<email>'.$cust['email'].'</email>'."\n";
	$xml .= '<phone>'.$cust['phone'].'</phone>'."\n";
	$xml .= '</customer>'."\n";
	echo $xml;
	$result->free();
	$db->close();
?>