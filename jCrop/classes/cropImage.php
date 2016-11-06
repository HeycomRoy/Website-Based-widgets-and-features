<?php
class imageCrop {
	private $imageName; 
	private $imageDestination; 
	private $imageStartX; 
	private $imageStartY; 
	private $imageFinishX; 
	private $imageFinishY; 
	private $imageWidth; 
	private $imageHeight; 

	public function __construct($imageName,$imageDestination,$imageStartX,$imageStartY,$imageFinishX,$imageFinishY,$imageWidth,$imageHeight) {
		$this->imageName = $imageName;//path to existing image
		$this->imageDestination = $imageDestination;//save path
		$this->imageStartX = $imageStartX;//cropStartX
		$this->imageStartY = $imageStartY;//cropStartY
		$this->imageFinishX = $imageFinishX;//cropFinishedX
		$this->imageFinishY = $imageFinishY;//cropFinishedY
		$this->imageWidth = $imageWidth;//croppedWidth
		$this->imageHeight = $imageHeight;//croppedHeight
	}
	
	public function cropImage($finalWidth,$finalHeight){//supply desired size and it will be so!!!
		
		list($origWidth, $origHeight, $imageType) = getimagesize($this->imageName);
		$imageType = image_type_to_mime_type($imageType);
		
		
		if(!$finalHeight){//if no height specified... 
			
			if($finalWidth > $this->imageWidth){//if the width is too small, make one based on crop ratio
				$percentageIncrease = $finalWidth / $this->imageWidth; //percentage decimal
				$finalHeight = $this->imageHeight * $percentageIncrease;
			}else{
				$finalHeight = $this->imageHeight;
			}
			
		}else{
			
			if($this->imageWidth < $finalWidth){//small crop? resize... (comment out to maintain proportions and stretch image)
			$finalWidth = $this->imageWidth;
			}
			
			if($this->imageHeight < $finalHeight){ //same deal
			$finalHeight = $this->imageHeight;
			}
		}
		
		$imgMake = imagecreatetruecolor($finalWidth,$finalHeight);
		
		switch($imageType) {
		case "image/gif":
			$imgCanvas = imagecreatefromgif($this->imageName); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$imgCanvas = imagecreatefromjpeg($this->imageName); 
			break;
	    case "image/png":
		case "image/x-png":
			$imgCanvas = imagecreatefrompng($this->imageName); 
			break;
  		}
		
		imagecopyresampled($imgMake, $imgCanvas, 0, 0, $this->imageStartX, $this->imageStartY, $finalWidth, $finalHeight, $this->imageWidth ,$this->imageHeight );
		
		if (file_exists($this->imageDestination)) {
			$pathParts = pathinfo($this->imageDestination);
			$this->imageDestination = $pathParts['dirname']."/".uniqid("YOURSITENAME").basename($this->imageDestination);
		}
			
		switch($imageType) {
		case "image/gif":
	  		if(imagegif($imgMake, $this->imageDestination)){
				return $this->imageDestination;
			}
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		if(imagejpeg($imgMake, $this->imageDestination, 90)){//jpg has quality parameter.
				return $this->imageDestination;
			}
			break;
		case "image/png":
		case "image/x-png":
			if(imagepng($imgMake, $this->imageDestination)){  
				return $this->imageDestination;
			}
			break;
    	}
	}
	
}
?>