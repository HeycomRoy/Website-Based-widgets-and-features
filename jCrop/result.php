<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Success?</title>
<link type="text/css" href="css/style.css" rel="stylesheet" media="screen" />

</head>
<body>

<?php

$imagePath = $_POST['imagePath'];//full path to uploaded image
$imageName = basename($imagePath);//remove path leaving only 'xxxx.jpg'

//crop information
$thumbStartX = $_POST['thumbx'];
$thumbStartY = $_POST['thumby'];
$thumbFinishX = $_POST['thumbx2'];
$thumbFinishY = $_POST['thumby2'];
$thumbWidth = $_POST['thumbw'];
$thumbHeight = $_POST['thumbh'];
		
include('classes/cropImage.php');
$resizedImage = new imageCrop($imagePath,'images/thumbs/'.$imageName,$thumbStartX,$thumbStartY,$thumbFinishX,$thumbFinishY,$thumbWidth,$thumbHeight);
$resizeThumbResult = $resizedImage->cropImage(580,false);//enforced width
//$resizeThumbResult = $resizedImage->cropImage(500,100);//enforced size (Ensure this is reflected in jCrop js.)

if($resizeThumbResult){
	
	@unlink($imagePath);//clear temp folder
	
	$html .= "<h1>Holy crap it worked!</h1>\n";
	$html .= "<p>Enter path into database, or whatever you need to do etc...</p>\n";
	$html .= "<img src=\"".$resizeThumbResult."\" />\n";
	
}else{
	$html = "<h2>Image crop error, Boooooo!</h2>";
	$html .= "</div>\n";
}

echo $html;
?>

</body>
</html>