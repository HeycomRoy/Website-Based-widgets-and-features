<?php

class DeleteProductView extends View
{
/*
**	This class contains all the methods needed to delete a particular product from the cartproducts table and the corresponding files from the images folder
*/
	private $model;
	private $PID;
	private $product;
	private $msg;
	
	public function __construct($rs, $model, $PID)
	{
		$this->rs = $rs;
		$this->model = $model;
		$this->PID = $PID;
	}

	protected function displayContent()
	{
		$html = '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
		if (!isset($_SESSION['Admin'])) {
			$html .= '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
			return $html;
		}
		if ($_POST['confirm']) {
			$result = $this->model->deleteProductDetails($_POST['PID'], $_POST['PImage']);
			$html .= '<div class="pageMsg">'.$result['msg'].'</div>'."\n";
			return $html;
		}
		else if ($_POST['cancel']) {
			$this->msg = "No Product Deleted";
		}
		$this->product = $this->model->getProducts($this->PID);
		$html .= $this->displayDeleteForm();
		return $html;
	}
	
	private function displayDeleteForm()
	{
		$html = '<div class="prdrow">'."\n";
		$html .= '<div class="bigImage"><img src="images/big_'.$this->product['PImage'].'" alt="'.$this->product['PName'].'" /></div>'."\n";
		$html .= '<div class="prdDetails"><p>'.$this->product['PTitle'].'</p>'."\n";
		$html .= '<p>'.$this->product['PDesc'].'</p>'."\n";
		$html .= '<p>Price: $'.sprintf("%.2f",$this->product['PPrice']).'</p>'."\n";
		$html .= '<div class="delform">Do you want to delete this product?<br />'."\n";
		$html .= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
		$html .= '<input type="hidden" name="PID" value="'.$this->product['PID'].'" />'."\n";
		$html .= '<input type="hidden" name="PImage" value="'.$this->product['PImage'].'" />'."\n";
		$html .= '<input type="submit" name="confirm" value="Yes" /> | '."\n";
		$html .= '<input type="submit" name="cancel" value="No" />'."\n";
		$html .= '</form>'."\n";
		$html .= '</div>'."\n";
		$html .= '<p class="pageMsg">'.$this->msg.'</p>'."\n";
		$html .= '</div>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
	
	
	
	
	
	
	
	
}

?>