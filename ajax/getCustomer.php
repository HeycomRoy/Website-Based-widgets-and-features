<?php
	function connectToDB()
{
	$db = new mysqli("localhost","root","","myfirstdatabase");
	if (mysqli_connect_errno()) {
		die("<h3>Failed to Establish Database Connection!".mysqli_connect_error()."</h3>");
	}
	return $db;
}

	$db = connectToDB();
	$id = $_GET['q'];
	if (!$id) {
		exit;
	}
	$qry = "SELECT ID, fname, email, phone FROM customers WHERE ID = $id";
	$result = $db->query($qry);
	if ($result) {
		$cust = $result->fetch_assoc();
	}
	else {
		die("Customer record not found!");
	}
	$html = '<table border="1">'."\n";
	$html .= '<tr><th>ID</th><th>Customer Name</th><th>Email Address</th><th>Phone</th></tr>'."\n";
	$html .= '<tr><td>'.$cust['ID'].'</td>'."\n";
	$html .= '<td>'.$cust['fname'].'</td>'."\n";
	$html .= '<td>'.$cust['email'].'</td>'."\n";
	$html .= '<td>'.$cust['phone'].'</td></tr>'."\n";
	$html .= '</table>'."\n";
	echo $html;
	$result->free();
	$db->close();
?>