<?php

class ProductView extends View
{
	private $model;
	private $PID;
	private $product;
	
	public function __construct($rs, $model, $PID)
	{
		$this->rs = $rs;
		$this->model = $model;
		$this->PID = $PID;
	}

	protected function displayContent()
	{
		$cart = new SCart;
		if ($_POST['add']) {
			$this->PID = $_POST['PID'];
			$cart->addToCart();
		}
		$this->product = $this->model->getProducts($this->PID);
		$html .= '<h2 class="pagehead">'.$this->product['PName'].'</h2>'."\n";
		$html .= '<div class="bigImage"><img src="images/big_'.$this->product['PImage'].'" alt="'.$this->product['PName'].'" /></div>'."\n";
		$html .= '<div class="prdDetails"><p>'.$this->product['PTitle'].'</p>'."\n";
		$html .= '<p>'.$this->product['PDesc'].'</p>'."\n";
		$html .= '<p>Price: $'.sprintf("%.2f",$this->product['PPrice']).'</p>'."\n";
		if (!$cart->inCart($this->PID)) {
			$html .= $this->showAddCartForm();
		}
		else {
			$html .= '<p class="boldtxt">Product is added to cart</p>'."\n";
		}
		$html .= '<div class="cvfoot"><a href="index.php?pageID=gallery">Continue Shopping</a>'."\n";
		if ($_SESSION['cart']) {
			$html .= ' | <a href="index.php?pageID=viewCart">View Cart</a>'."\n";
		}
		$html .= '</div>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}

	private function showAddCartForm()
	{
		$html = '<p><form method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
		$html .= '<label for="qty">Quantity</label>'."\n";
		$html .= '<select id="qty" name="qty">'."\n";
		for ($i=1; $i<6; $i++) {
			$html .= '<option value="'.$i.'">'.$i.'</option>'."\n";
		}
		$html .= '</select>'."\n";
		$html .= '<input type="hidden" name="PID" value="'.$this->PID.'" />'."\n";
		$html .= '<input type="hidden" name="Price" value="'.$this->product['PPrice'].'" />'."\n";
		$html .= '<input type="submit" name="add" value="Add to Cart" />'."\n";
		$html .= '</form>'."\n";
		return $html;
	}
}


?>