<?php

function displayHtmlHeader()
{
	$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
	$html .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
	$html .= '<head>'."\n";
	$html .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'."\n";
	$html .= '<meta name="description" content="" />'."\n";
	$html .= '<meta name="keywords" content="" />'."\n";
	$html .= '<title>Ajax Database Example</title>'."\n";
	$html .= '<script type="text/javascript" src="responseXml.js"></script>'."\n";
	$html .= '</head>'."\n";
	$html .= '<body>'."\n";
	return $html;
}

function displayForm()
{
	$html = '<form>'."\n";
	$html .= 'Select a Customer: '."\n";
	$html .= '<select name="customers" onchange="showCustomer(this.value)">'."\n";
	$html .= displayOptions();
	$html .= '</select>'."\n";
	$html .= '</form><br />'."\n";
	$html .= '<h2 id="name"></h2>'."\n";
	$html .= '<p><span id="lblEmail"></span><span id="email"></span></p>'."\n";
	$html .= '<p><span id="lblPhone"></span><span id="phone"></span></p>'."\n";
	return $html;
}

function connectToDB()
{
	$db = new mysqli("localhost","root","","myfirstdatabase");
	if (mysqli_connect_errno()) {
		die("<h3>Failed to Establish Database Connection!".mysqli_connect_error()."</h3>");
	}
	return $db;
}

function displayOptions()
{
	$db = connectToDB();
	$qry = "select ID, fname, email, phone from customers";
	$rs = $db->query($qry);
	while ($cust = $rs->fetch_assoc()) {
		$customers[] = $cust;
	}
	$html = '';
	foreach ($customers as $customer) {
		$html .= '<option value="'.$customer['ID'].'">'.$customer['fname'].'</option>'."\n";
	}
	return $html;
}

function displayFooter()
{
	$html = '</body>'."\n";
	$html .= '</html>'."\n";
	return $html;
}

$html = displayHtmlHeader();
$html .= displayForm();
$html .= displayFooter();
echo $html;

?>