<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>upload your image</title>
</head>
<body>
<h1>Fancy image upload and crop...</h1>

<form action="crop.php" method="post" name="imageUpload" enctype="multipart/form-data">
<label for="image">Upload an image</label>
<input type="file" name="image" id="imageLink" class="inline" />
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><!--A good idea!-->
<input type="submit" value="upload"/>
</form>

</body>
</html>