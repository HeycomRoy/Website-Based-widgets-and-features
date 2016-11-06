<?php
class Upload
{	
	private	$fileName; 			//  name of file from upload form  
	private $fileTypes = array();  //  array of valid file types for upload  
	private $folderPath;  			//  path of folder where uploaded files will be moved 
	
	public function __construct($fileName, $fileTypes, $folderPath)
	{
		$this->fileName = $fileName;
		$this->fileTypes = $fileTypes;
		$this->folderPath = $folderPath;
	}
	
	public function isUploaded()
	{
							// checks if $_FILE[‘file ’][‘name’] is set and there are no errors
		if ($_FILES[$this->fileName]['name']) {					
			if ($_FILES[$this->fileName]['error']) {
				switch($_FILES[$this->fileName]['error']) {
					case 1: echo 'File exceeds PHP\'s maximum upload size<br />';
							return false;
					case 2: echo 'File exceeds maximum upload size set in the form<br />';
							return false;
					case 3: echo 'File partially uploaded<br />';
							return false;
					case 4: echo 'No file uploaded<br />';
							return false;
				}
			}	
							// checks if file type is valid
			$type = $_FILES[$this->fileName]['type'];
			$typeCount = count($this->fileTypes);
			$wrongType = 0;
			foreach($this->fileTypes as $ftype) {
				if ($type != $ftype) {
					$wrongType++;
				}
			}
			if ($wrongType == $typeCount) {
				echo 'Error: Wrong File Type<br />';
				return false;
			}	
							// checks if file reaches server (temp location)
			if (is_uploaded_file($_FILES[$this->fileName]['tmp_name'])) {
				$fleNme = $_FILES[$this->fileName]['name'];
				$flePath = $this->folderPath ? $this->folderPath."/".$fleNme : $fleNme;		
							// checks if destination folder exists and creates it if not (we have already created folder externally)	
							// checks if file already exists and prefixes filename with some PHP generated string if it does moves file from temp location to destination folder	
				if (file_exists($flePath)) {
					$newName = uniqid("LD").$fleNme;
					echo 'File '.$fleNme.' already exists, renamed to '.$newName.'<br />';
					$flePath = $this->folderPath ? $this->folderPath."/".$newName : $newName;	
				}			
							//   move file from temporary location to path specified
				if (move_uploaded_file($_FILES[$this->fileName]['tmp_name'],$flePath)) {
							// checks if file reached destination folder
					if (file_exists($flePath)) {
//						echo 'File '.$_FILES[$this->fileName]['name']. ' uploaded successfully';
							// returns file name (in case it was changed)
						return $flePath;	
					}				
					else {
						echo 'File did not reach destination folder';
						return false;
					}
				}	
				else {
						echo 'Error in moving file to specified location';
						return false;
				}	
			}
			else {
				echo 'File did not reach tempory location on server';
				return false;
			}
		}
		else {
			echo 'File name not available';
		}
	}
}
?>