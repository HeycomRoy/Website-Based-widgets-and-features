<?php
class ResizeImage {
	private $imageName;  			//  name of file as returned from upload class  
	private $dimension; 			//  desired dimension of longer side   
	private $destFolder;			//  path of folder where resized images will be saved

	public function __construct($imageName, $dimension, $destFolder){
		$this->imageName = $imageName;
		$this->dimension = $dimension;
		$this->destFolder = $destFolder;
		$this->prefix = $prefix;
	}
	
	public function resize() {
		
		if (!file_exists($this->imageName)) {//checks if file exists on server
			echo 'RESIZE ERROR: Source file not found';
			return false;
		}
		//calculate image aspect ratio and get new width and height
		$imageInfo = getimagesize($this->imageName);
		/*echo '<pre>';
		print_r($imageInfo);
		echo '</pre>';*/
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
		
		//sets full file path based on destination folder
		$fileName = basename($this->imageName);
		$fullPath = $this->destFolder.$fileName;
		
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
				return $fullPath;
			}
			else {
				return false;
			}
		}
		
		if ($imageInfo['mime'] == 'image/png') {
			if ($this->resizePng($newW, $newH, $origW, $origH, $fullPath)) {
				return $fullPath;
			}
			else {
				return false;
			}
		}
	}//resize ends
	
	
	private function resizeJpeg($newW, $newH, $origW, $origH, $fullPath){
		
		$im = ImageCreateTrueColor($newW, $newH);
		$baseImage = ImageCreateFromJpeg($this->imageName);
		imagecopyresampled($im, $baseImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
		imagejpeg($im, $fullPath);
		imagedestroy($im);
		if (file_exists($fullPath)) {
			//echo 'Image '.$fullPath.' resized successfully<br />';
			return true;
		}	
		else {
			echo 'ERROR: Failed to resize image '.$fullPath.'<br />';
			return false;
		}
	}
	
	private function resizeGif($newW, $newH, $origW, $origH, $fullPath) {
		$im = ImageCreateTrueColor($newW, $newH);
		$baseImage = ImageCreateFromGif($this->imageName);
		imagecopyresampled($im, $baseImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
		imagegif($im, $fullPath);
		imagedestroy($im);
		if (file_exists($fullPath)) {
			return true;
		}	
		else {
			echo 'ERROR: Failed to resize image '.$fullPath.'<br />';
			return false;
		}
	}
	
	private function resizePng($newW, $newH, $origW, $origH, $fullPath) {
		$im = ImageCreateTrueColor($newW, $newH);
		$baseImage = ImageCreateFromPng($this->imageName);
		imagecopyresampled($im, $baseImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
		imagepng($im, $fullPath);
		imagedestroy($im);
		if (file_exists($fullPath)) {
			return true;
		}	
		else {
			echo 'ERROR: Failed to resize image '.$fullPath.'<br />';
			return false;
		}
	}
	
		
}//class ends
?>






