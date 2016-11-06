<?php

class GalleryView extends View
{
/*
**	This class contains the methods needed to generate the content of the product gallery page
*/

	private $model; 

	public function __construct($rs, $model)
	{
		$this->rs = $rs;
		$this->model = $model;
	}
	
	protected function displayContent()
	{
		$cart = new SCart;
		$html  = $cart->displayCartSummary();
		$html .= '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= $this->displayProducts();
		return $html;
	}
	
	private function displayProducts()
	{
		$html = '';
		$products = $this->model->getProducts();
		foreach ($products as $product) {
			$html .= '<div class="prodrow">'."\n";
			$html .= '<div class="pImage"><a href="index.php?pageID=productView&amp;PID='.$product['PID'].'" ><img src="images/'.$product['PImage'].'" alt="'.$product['PName'].'" /></a><br />'."\n";
			$html .= '<a href="index.php?pageID=productView&amp;PID='.$product['PID'].'" >'.$product['PName'].'</a></div>'."\n";
			$html .= '<div class="pTitle"><a href="index.php?pageID=productView&amp;PID='.$product['PID'].'" >'.$product['PTitle'].'</a></div>'."\n";
			$html .= '<div class="pPrice">Price: $'.sprintf("%.2f",$product['PPrice']).'</div>'."\n";
			if ($_SESSION['Admin']) {
				$html .= '<div class="pLinks"><a href="index.php?pageID=editProduct&amp;pid='.$product['PID'].'">Edit</a>'."\n";
				$html .= ' | <a href="index.php?pageID=deleteProduct&amp;pid='.$product['PID'].'">Delete</a>'."\n";	
				$html .= '</div>'."\n";
			}
			$html .= '</div>'."\n";
		}
		return $html;
	}
}	
?>