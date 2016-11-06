<?php
include_once 'captchaClass1.php';

session_start();
$captcha = new Captcha;
if ($_POST['go']) {
	if ($captcha->match($_POST['captcha'])) {
		echo 'Captcha matched. Sweet.';
	}
	else {
		echo 'Words did not match!';
	}
	@unlink($_SESSION['location']);
	unset($_SESSION);
	session_destroy();
}
else {
	$_SESSION['location'] = $captcha->create();
	$html = '<img src="'.$_SESSION['location'].'" alt="'.$_SESSION['captcha'].'" />';
	$html .= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
	$html .= '<label for="captcha">Enter the characters you see</label>'."\n";
	$html .= '<input type="text" name="captcha" id="captcha" />'."\n";
	$html .= '<input type="submit" name="go" value="Go" />'."\n";
	$html .= '</form>'."\n";
	echo $html; 
}
?>