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

function createUser()
{
	$userName = $_POST['userName'];
	$password = $_POST['userPassword'];
	if (!$userName || !$password) {
		$msg = "Please enter username and password";
		return $msg;
	}
	$db = connectToDB();
	$password = sha1($password);
	$qry = "INSERT INTO user1(userName, userPassword) VALUES ('$userName', '$password')";
	$rs = $db->query($qry);
	if ($rs) {
		if ($db->affected_rows > 0) {
			$msg = 'User created';
		}
		else {
			$msg = 'User name already taken';
		}
	}
	else {
		$msg = "User name already taken";
	}
	return $msg;
}

function createUserForm()
{
	$ajaxStr = "ajaxFunction(this.value, 'checkUser.php', 'nameMsg')";
	$html = '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" >'."\n";
	$html .= '<label for="userName" class="col1">User Name</label>'."\n";
	$html .= '<input type="text" name="userName" id="userName" value="'.$_POST['userName'].'" class="col2" onkeyup="'.$ajaxStr.'" />'."\n";
	$html .= '<div id="nameMsg" class="col3"></div>'."\n";
	$html .= '<div class="clear"></div>'."\n";
	$html .= '<label for="userPassword" class="col1">Password</label>'."\n";
	$html .= '<input type="password" name="userPassword" id="userPassword" class="col2" />'."\n";
	$html .= '<div class="clear"></div>'."\n";
	$html .= '<input type="submit" name="submit" value="Submit" />'."\n";
	$html .= '</form>'."\n";
	return $html;
}

	include "../conf.php";
	include "../classes/displayClass.php";
	$mypage = new displayPage("Create User Demo","Create User Demo","Create User Demo","Create User Demo");
	$html = $mypage->displayHeader();
	if ($_POST['submit']) {
		$msg = createUser();
	}
	$html .= createUserForm();
	$html .= '<p>'.$msg.'</p>'."\n";
	$html .= $mypage->displayFooter();
	echo $html;
?>