<?php

 function connect_to_db()
 {
	try
	{
		@$db = new mysqli("localhost","root","","myfirstdatabase");  //connect to the DB
		if (mysqli_connect_errno()) {
			throw new Exception ("Error Connecting to the database: ".mysqli_connect_error());
		}
		else {
			return($db);
		}     
	}
		
	catch(Exception $e)
	{
		die($e->getMessage());
	} 
}	
	
function displayHTMLHeader()
  {
	$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"';
	$html .= ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$html .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
	$html .= '<head>'."\n";
	$html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
	$html .= '<link href="style.css" rel="stylesheet" type="text/css" />'."\n";
    echo $html;
  }
  
 function display_form()
 {
	global $item_msg;
	displayHTMLHeader();
	$html  = '<form action="'.$_SERVER['REQUEST_URI'].'" method = "post">'."\n";
	$html .= '<label for="item" class="col1">User Name </label>';
	$html .= '<input type = "text" name="item" id = "item"  class="col2" value="'.$_POST['item'].'" />'."\n";
	$html .= '<span id="item_msg" class="col3">'.$item_msg.'</span>'."\n";
	$html .= '<div class="clear"></div>'."\n";
	
	$html .= '<input type = "submit" name="submit" value="Search" class="submitButton" />'."\n";
	$html .= '<div class="clear"><p>'.$msg.'</p></div>'."\n";
	$html .= '</form>'."\n";
	echo $html;
 }  

function search_user($item)
{
	global $db;
	$qry = "SELECT UserId, UserName, UserEmail FROM users3 where UserName like '$item'";
	$result = $db->multi_query($qry);
	if ($result) {
		$rs = $db->store_result();
		if ($rs->num_rows < 1) {
			echo ("No match found");
			return;
		}
//   have a loop that does $db->next_result();	
	}
	else {
		echo "Error reading table";
		return;
	}
	
	echo '<table>';
	echo '<tr><th>User ID</th><th>User Name</th><th>User Email</th></tr>'."\n";
	while ($user = $rs->fetch_assoc()) {
		echo '<tr><td>'.$user['UserID'].'</td>'."\n";
		echo '<td>'.$user['UserName'].'</td>'."\n";
		echo '<td>'.$user['UserEmail'].'</td></tr>'."\n";
	}
	echo '</table>';
	echo '<br /><br />'."\n";
}

echo "gpc:". get_magic_quotes_gpc()."<br /><br />";

$db = connect_to_db();

if ($_POST['submit'])
{
	$item = $_POST['item'];
	if ($item) {
		$item_msg = '';
		search_user($item);
	} else {
		$item_msg = 'Please enter search string';
	}	
}	
display_form();
	 
?>