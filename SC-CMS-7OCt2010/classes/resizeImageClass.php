<?php
class ResizeImage
{
	private $imageName;  			//  name of file as returned from upload class  
	private $dimension; 			//  desired dimension of longer side   
	private $destFolder;			//  path of folder where resized images will be saved
	private $prefix;				//  prefix that will be attached to the name of the resized image

	public function __construct($imageName, $dimension, $destFolder, $prefix='') 
	{
		$this->imageName = $imageName;
		$this->dimension = $dimension;
		$this->destFolder = $destFolder;
		$this->prefix = $prefix;
	}
	
	public function resize()
	{
							//checks if file exists on server
		if (!file_exists($this->imageName)) {
			echo 'RESIZE ERROR: Source file not found';
			return false;
		}
		//calculate image aspect ratio and get new width and height
		$imageInfo = getimagesize($this->imageName);
		/* echo '<pre>';
		print_r($imageInfo);
		echo '</pre>'; */
		$origW = $imageInfo[0];
		$origH = $imageInfo[1];
		if ($origH > $origW) {
			$newH = $this->dimension;
			$newW = ($origW * $newH) / $origH;
		}
		else {
			$newW = $this->dimension;
			$newH = ($origH * $newW) / $origW;
		}
		//checks if destination folder for thumbs exists and creates it if not  [will not do this, folder created externally]
		//sets full file path based on destination folder
		$fleName = basename($this->imageName);
		$dFolder = $this->destFolder ? $this->destFolder.'/' : '';
		$dFile = $this->prefix ? $this->prefix.'_'.$fleName : $fleName;
		$fullPath = $dFolder.''.$dFile;
		//checks file mime type and calls corresponding resize function
		if ($imageInfo['mime'] == 'image/jpeg') {
			if ($this->resizeJpeg($newW, $newH, $origW, $origH, $fullPath)) {
				//returns full path when resizing has been successful, or false otherwise
				return $fullPath;
			}
			else {
				return false;
			}
		}
		if ($imageInfo['mime'] == 'image/gif') {
			if ($this->resizeGif($newW, $newH, $origW, $origH, $fullPath)) {
				//returns full path when resizing has been successful, or false otherwise
				return $fullPath;
			}
			else {
				return false;
			}
		}
	}
	
	private function resizeJpeg($newW, $newH, $origW, $origH, $fullPath)
	{
		$im = ImageCreateTrueColor($newW, $newH);
		$baseImage = ImageCreateFromJpeg($this->imageName);
		imagecopyresampled($im, $baseImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
		imagejpeg($im, $fullPath);
		imagedestroy($im);
		if (file_exists($fullPath)) {
//			echo 'Image '.$fullPath.' resized successfully<br />';
			return true;
		}	
		else {
			echo 'ERROR: Unable to resize image '.$fullPath.'<br />';
			return false;
		}
	}
	
	private function resizeGif() 
	{
		// student needs to complete this
	}
}
?>