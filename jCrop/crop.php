<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Crop your image &gt;_&lt;</title>
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$("#submitButton").css('display','none');
	$("#thumbnailColorbox").colorbox({width:"910px", inline:true, href:"#thumbnailCropDiv"});
	
	$("#thumbnailCropDiv").click(function(){ 
		$("#submitButton").css('display','inline');
		return false;
	});
		
	function showThumbCoords(c) {
		$('#thumbx').val(c.x);
		$('#thumby').val(c.y);
		$('#thumbx2').val(c.x2);
		$('#thumby2').val(c.y2);
		$('#thumbw').val(c.w);
		$('#thumbh').val(c.h);
	};
	
	$('#jcropThumbTarget').Jcrop({
		onChange: showThumbCoords,
		onSelect: showThumbCoords/*,
		aspectRatio: 5 / 1*/
	});
		
});//jQuery close
</script>
<link type="text/css" href="css/style.css" rel="stylesheet" media="screen" />
</head>
<body>

<h1>Crop area</h1>
<?php
if($_FILES['image']['name']){ // is the image in the temp folder?
				
	include('classes/uploadClass.php');
	$validTypes = array("image/jpeg", "image/jpg", "image/gif", "image/png");	
	$upload = new Upload($validTypes, "images/temp");//upload to temp folder
	$success = $upload->isUploaded();
	echo $success;
	if($success){
		
	include('classes/resizeImageClass.php');
	$resize = new resizeImage($success, 800, "images/temp/"); //path to image, max width, destination
	$resizeResult = $resize->resize(); //resize and overwrite upload.
	
		if($resizeResult){
						
			$html .= "<p><a href=\"#\" id=\"thumbnailColorbox\">Crop your thumbnail image</a></p>\n";//colorbox trigger.
			$html .= "<form action=\"result.php\" name=\"cropper\" method=\"post\" >\n";
		
				$html .= "<div class=\"hiddenColorbox\">\n";
				$html .= "    <div id=\"thumbnailCropDiv\">\n";
				$html .= "    	<h1>Crop your thumbnail image</h1>\n";
				$html .= "    	<img src=\"".$resizeResult."\" id=\"jcropThumbTarget\" />\n";
				$html .= "		<input type=\"hidden\" name=\"imagePath\" value=\"".$resizeResult."\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumbx\" name=\"thumbx\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumby\" name=\"thumby\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumbx2\" name=\"thumbx2\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumby2\" name=\"thumby2\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumbw\" name=\"thumbw\" />\n";
				$html .= "		<input type=\"hidden\" id=\"thumbh\" name=\"thumbh\" />\n";
				$html .= "    </div>\n";
				$html .= "</div>\n";
			
			$html .= "		<input type=\"submit\" id=\"submitButton\" value=\"crop!\"  />\n";
			$html .= "</form>\n";
		}
	}//if upload success ends
}else{
$html .= "Image cant be found in temp folder :( Hosting fail!";
}

echo $html;
?>
</body>
</html>