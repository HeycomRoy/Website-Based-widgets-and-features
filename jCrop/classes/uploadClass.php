<?php
class Upload {
	
	private $fileTypes = array();  //  array of valid file types for upload  
	private $folderPath;  			//  path of folder where uploaded files will be moved 
	
	public function __construct($fileTypes, $folderPath){
		$this->fileTypes = $fileTypes;
		$this->folderPath = $folderPath;
	}
	
	public function isUploaded(){
			// checks if $_FILE['file']['name'] is set and there are no errors
		if ($_FILES['image']['name']) {					
			if ($_FILES['image']['error']) {
				switch($_FILES['image']['error']) {
					case 1: echo '<p>File exceeds PHP\'s maximum upload size</p>';
					case 2: echo '<p>File exceeds maximum upload size set in the form</p>';
					case 3: echo '<p>File partially uploaded</p>';
					case 4: echo '<p>No file uploaded</p>';
				}
			}	
							// checks if file type is valid
			$type = $_FILES['image']['type'];
			$typeCount = count($this->fileTypes);
			$wrongType = 0;
			
			foreach($this->fileTypes as $ftype) {
				if ($type != $ftype) {
					$wrongType++;
				}
			}
			if ($wrongType == $typeCount) {
				echo "Error: Incorrect File Type";
				return false;
			}
			
			if (is_uploaded_file($_FILES['image']['tmp_name'])) {
				$fileName = $_FILES['image']['name'];
				$finalName = $fileNme;
				$filePath = $this->folderPath."/".$fileName;			
				if (file_exists($flePath)) {
					$newName = uniqid("MYA").$fileNme;
					$filePath = $this->folderPath ? $this->folderPath."/".$newName : $newName;
					$finalName = $newName;
				}			
			////////////////////Great, now move it to desired location
				if (move_uploaded_file($_FILES['image']['tmp_name'],$filePath)) {
							
					if (file_exists($filePath)) {// checks if file reached destination
						return $filePath;//success!
					}				
					else {
						echo "File did not reach destination folder";
						return false;
					}
				}	
				else {
						echo "Error in moving file to specified location";
						return false;
				}	
			}
			else {
				echo "File did not reach tempory location on server";
				return false;
			}
		}
		else {
			echo "File hasn't uploaded correctly";
			return false;
		}
	}
}
?>