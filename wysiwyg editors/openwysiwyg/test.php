<?php
	echo $_POST['message'];
//	print_r($_POST);
	$pattern = '/src=".+\.[a-zA-Z]{3,4}"/';
	preg_match($pattern, $_POST['message'], $matches);
	print_r($matches);
?>