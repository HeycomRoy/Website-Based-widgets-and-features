<?php

class AddProductView extends View 
{
	private $model; 

	public function __construct($rs, $model)
	{
		$this->rs = $rs;
		$this->model = $model;
	}
	
	protected function displayContent()
	{
		$html = '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
		if (!isset($_SESSION['Admin'])) {
			$html = '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
			return $html;
		}
		if ($_POST['Add']) {
			$result = $this->model->processAddProduct($_POST);
			if ($result['PImage']) {
				$_POST['PImage'] = $result['PImage'];
			}
		}	
		$html .= $this->displayProductForm("Add", $result, $_POST);
		return $html;
	}

	protected function displayProductForm($mode, $result, $product) 
	{   
		/* echo "<pre>";
		print_r($errmsg);
		echo "</pre>"; */
	 	if (is_array($result)) {
			extract($result);	
		}	 
		$html = '<div class="hmecontent">'."\n";
		$html .= '<div id="editform">'."\n";	
		$html .='<form id="edit_form" method="post" action="'.
			$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">'."\n";
		$html.='<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />'."\n";
		$html.='<input type="hidden" name="PID" value="'.$product['PID'].'" />'."\n";
		$html.='<input type="hidden" name="PImage" value="'.$product['PImage'].'" />'."\n";
		$html.= '<label for="PName" class="col1">Product Name </label>';
		$html.= '<input type = "text" name="PName" id = "PName"  class="col2"'.
				'value="'.htmlentities(stripslashes($product['PName']),ENT_QUOTES).'" /><div id="pname_msg" class="col3"> '.
				$pname_msg.'</div>'."\n";		
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PTitle" class="col1">Product Title </label>';
		$html.= '<input type = "text" name="PTitle" id = "PTitle"  class="col2"'.
				'value="'.htmlentities(stripslashes($product['PTitle']),ENT_QUOTES).'" /><div id="ptitle_msg" class="col3"> '.
				$ptitle_msg.'</div>'."\n";		
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PDesc" class="col1">Description </label>';
		$html.= '<input type = "text" name="PDesc" id = "PDesc"  class="col2"  value="'.
				htmlentities(stripslashes($product['PDesc']),ENT_QUOTES).'" /><div id="pdesc_msg" class="col3"> '.
				$pdesc_msg.'</div>'."\n";
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PPrice" class="col1">Price</label>';
		$html.= '<input type = "text" name="PPrice" id = "PPrice"  class="col2"  value="'.
				$product['PPrice'].'" /><div id="price_msg" class="col3"> '.$price_msg.'</div>'."\n";
		$html.= '<div class="clear"></div>'."\n";
		
		if ($product['PImage']) {
			$html .= '<div class="col1a">Product Image<br />';
			$html .= '<img src="images/'.$product['PImage'].'" /></div>'."\n";
		} 
		else {
			$html .= '<div class="col1" >&nbsp;</div>';
		}
		$html .= '<div class="col2"><label for="pimage">Upload New Image</label><br />'."\n";
		$html .= '<input type="file" name="PImage" /></div>'."\n";
		$html .= '<div id="pimage_msg" class="col3"><br /> '.$pimage_msg.'</div>'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<input type = "submit" name="'.$mode.'" value="'.$mode.'" class="submitButton" /></div>'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '</form>'."\n";
		$html .= '</div>'."\n";                       // end of div editform
		$html .= '<div class="pagemsg">'.$msg.'</div>';
		return $html;
	}
}

?>