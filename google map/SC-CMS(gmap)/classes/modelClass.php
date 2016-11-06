<?php

include 'classes/dbaseClass.php';
include 'classes/uploadClass.php';
include 'classes/resizeImageClass.php';

class Model extends DBase
{
	private $validate;
	
	public function __construct()
	{
		parent::__construct();
		if (in_array($_GET['pageID'], array("checkout","editView","addProduct","editProduct"))) {
			include 'classes/validateClass.php';
			$this->validate = new Validate;
		}	
	}

	public function validateCheckoutEntries()
	{						//   This method validates the fields in the Checkout Form
		$result = array();
		$result['nameMsg'] = $this->validate->checkName($_POST['name']);
		  //    add other field validations here
		foreach($result as $errmsg) {
			if (strlen($errmsg) > 0) {
				$result['ok'] = false;
				return $result;
			}
		}	
		$result['ok'] = true;
		return $result;
	}
	
	public function checkUserSession()
	{
		if ($_GET['pageID'] == 'logout') {
			unset($_SESSION['Admin']);
			$result['pageMsg'] = 'You are now logged out!';
		}
		if ($_GET['pageID'] == 'login') {
			if (!$_SESSION['Admin']) {
				if ($_POST['login']) {
					$result = $this->validateUser();
				}
			}
			else {
				$result['pageMsg'] = 'You are already logged-in as '.$_SESSION['Admin'];
			}
		}
		return $result;
	}
	
	private function validateUser()
	{
		if ($_POST['login'] && $_POST['userName'] && $_POST['userPassword']) {
			$rso = $this->getAdmin($_POST['userName']);
			if ($rso->num_rows > 0) {
				$user = $rso->fetch_assoc();
				if (sha1($_POST['userPassword']) == $user['UserPass']) {
					$_SESSION['Admin'] = $_POST['userName'];
					$result['pageMsg'] = 'You have successfullly logged-in as '.$_SESSION['Admin'];
					$result['ok'] = true;
					$result['errorMsg'] = '';
					return $result;
				}
				else {
					$result['errorMsg'] = 'Invalid User Name / Password Combination';
				}
			}
			else {
				$result['errorMsg'] = 'Invalid User Name / Password Combination';
			}
		}
		else {
			$result['errorMsg'] = 'Please fill in all information!';
		}	
		$result['ok'] = false;
		return $result;
	}
	
	public function validatePage()
	{
		$result = array();
								//    validate all fields in the page edit form 
		$result['PTitleMsg'] = $this->validate->checkRequired($_POST['PageTitle']);
		$result['PHeadingMsg'] = $this->validate->checkRequired($_POST['PageHeading']);
//		$result['PKeywordsMsg'] = $this->checkRequired($_POST['PageKeywords']);
//		$result['PDescriptionMsg'] = $this->checkRequired($_POST['PageDescription']);
//		$result['PContentMsg'] = $this->checkRequired($_POST['PageContent']);
		  
		foreach($result as $errmsg) {
			if (strlen($errmsg) > 0) {
				$result['ok'] = false;
				return $result;
			}
		}	
		$result['ok'] = true;
		return $result;
	}
	
	private function validateProduct($product)
	{
		extract($product);
		$result = array();
		$result['pname_msg'] = $this->validate->checkRequired($PName);
		$result['ptitle_msg'] = $this->validate->checkRequired($PTitle);
		$result['pdesc_msg'] = $this->validate->checkRequired($PDesc);
		$result['price_msg'] = $this->validate->checkNumeric($PPrice);	
		if ($_GET['pageID'] == 'addProduct') {
			$result['pimage_msg'] = $this->validate->checkRequired($_FILES['PImage']['name']);	
		}
		foreach($result as $errmsg) {
			if (strlen($errmsg) > 0) {
				$result['ok'] = false;
				return $result;
			}
		}	
		$result['ok'] = true;
		return $result;
	}
	
	public function processAddProduct($product)
	{
		$vresult = $this->validateProduct($product);
		if (!$vresult['ok']) {
			return $vresult;					//   exit function if there is an in error in form validation
		}
		$iresult = $this->insertProduct($product);   //  call function to create record in product table
		$PID = $iresult['PID'];
		if (!$PID) {							//  failed to insert to product table, exit and return result
			return $iresult;
		}
		$PImage = $this->uploadAndResizeImage($PID);
		if ($PImage) {
			if ($this->updateProductImagePath($PID, $PImage)) {
				$iresult['msg'] .= ' Image uploaded/resized successfully. ';
				$iresult['PImage'] = $PImage;
			}
		}
		else {
			$iresult['msg'] .= 'Unable to upload/resize image. ';
		}
		return $iresult;
	}
	
	public function updateProductDetails($product)
	{
		$vresult = $this->validateProduct($product);
		if (!$vresult['ok']) {
			return $vresult;					//   exit function if there is an in error in form validation
		}
		$PID = $product['PID'];
		if ($_FILES['PImage']['name']) {
			$PImage = $this->uploadAndResizeImage($PID);
			if ($PImage) {
				$product['PImage'] = $PImage;
				$uresult['PImage'] = $PImage;
				$uresult['msg'] = ' Image uploaded/resized successfully. ';
			}
			else {
				$uresult['msg'] .= 'Unable to upload/resize image. ';
			}
		}	
		$uresult['msg'] .= $this->updateProduct($product);
		return $uresult;
	}
	
	public function deleteProductDetails($PID, $PImage)
	{
		$dresult = $this->deleteProduct($PID);
		$thumbImage = "images/".$PImage;
		$bigImage = "images/big_".$PImage;
		if ($dresult['ok']) {
			@unlink($thumbImage);
			@unlink($bigImage);
		}
		return $dresult;
	}
	
	private function uploadAndResizeImage($PID)
	{
		$imgsPath = "images";
		if (!$_FILES['PImage']['name']) {
			return false;
		}
		$extension = explode('.',$_FILES['PImage']['name']);
		if (stristr($extension[1],"jp")) {
			$extension[1] = "jpg";
		}
		$fileTypes = array("image/jpeg","image/pjpeg","image/gif");
		$upload = new Upload("PImage", $fileTypes, $imgsPath);
		$returnFile = $upload->isUploaded();
		if (!$returnFile) {
			return false;
		}
		$thumbPath = $imgsPath.'/'.$PID.'.'.$extension[1];
		$uid = uniqid('bk');
		$thumbBackup = $imgsPath.'/'.$uid.''.$PID.'.'.$extension[1];
		if (file_exists($thumbPath)) {
			rename($thumbPath, $thumbBackup);
		}
		$bigPath = $imgsPath.'/big_'.$PID.'.'.$extension[1];
		$bigBackup = $imgsPath.'/big_'.$uid.''.$PID.'.'.$extension[1];
		if (file_exists($bigPath)) {
			rename($bigPath, $bigBackup);
		}
		copy($returnFile, $thumbPath);
		if (!file_exists($thumbPath)) {
			return false;
		}
		$imgSize = getimagesize($returnFile);
		if ($imgSize[0] > 150 || $imgSize[1] > 150) {
			$thumbImage = new ResizeImage($thumbPath, 150, $imgsPath,'');
			if (!$thumbImage->resize()) {
				echo 'Unable to resize image to 150 pixels';
			}
		}
		rename($returnFile, $bigPath);
		if ($imgSize[0] > 350 || $imgSize[1] > 350) {
			$bigImage = new ResizeImage($bigPath, 350, $imgsPath,'');
			if (!$bigImage->resize()) {
				echo 'Unable to resize image to 350 pixels';
			}
		}
		if (file_exists($thumbPath) && file_exists($bigPath)) {
			@unlink($thumbBackup);
			@unlink($bigBackup);
			return basename($thumbPath);
		}
		else {
			rename($thumbBackup, $thumbPath);
			rename($bigBackup, $bigPath);
			return false;
		}
	}

}
?>