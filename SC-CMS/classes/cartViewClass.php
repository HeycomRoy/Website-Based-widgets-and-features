<?php

class CartView extends View
{
	private $model;
	private $products;

	public function __construct($rs, $model)
	{
		$this->rs = $rs;
		$this->model = $model;
	}
	
	protected function displayContent()
	{
		$cart = new SCart;
		if ($_POST['update']) {
			$cart->doCartUpdate();
		}
		if ($_POST['delete']) {
			$cart->doCartDelete();
		}
		
		$html = '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
							//  get all information about the products currently in the cart
		$this->products = $cart->getCartData($this->model);
		if ($this->products) {
			$html .= $this->displayCartContent();
		}
		else {
			$html .= '<p class="pagemsg">Cart is Empty</p>'."\n";
		}
		$html .= '<div class="cvfoot"><a href="index.php?pageID=gallery">Continue Shopping</a>'."\n";
		if ($_SESSION['cart']) {
			$html .= ' | <a href="index.php?pageID=checkout">Checkout</a>'."\n";
		}
		$html .= '</div>'."\n";
		return $html;
	}
	
	private function displayCartContent()
	{
		$sTotal = 0;
		$html = '<div class="cartHdr"><span class="pImage">&nbsp;</span>'.
				'<span class="cTitle">Products</span>'.
				'<span class="cPrice">Price</span>'.
				'<span class="cQuantity">Quantity</span>'."\n";
		$html .= '</div>'."\n";
		foreach ($this->products as $product) {
			$html .= '<div class="prodrow">'."\n";
			$html .= '<div class="pImage"><a href="showProduct.php?PID='.$product['PID'].'" >';
			$html .= '<img src="images/'.$product['PImage'].'" alt="'.$product['PName'].'" /></a><br />'."\n";
			$html .= '<a href="showProduct.php?PID='.$product['PID'].'" >'.$product['PName'].'</a></div>'."\n";
			$html .= '<div class="cTitle"><a href="showProduct.php?PID='.$product['PID'].'" >'.$product['PTitle'].'</a></div>'."\n";
			$html .= '<div class="cPrice">Price: $'.sprintf("%.2f",$product['PPrice']).'</div>'."\n";	
			$html .= $this->showUpdateCartForm($product);
			$html .= '</div>'."\n";
			$sTotal += $product['PPrice'] * $product['Qty']; 
		}
		$html .= '<div class="cvfoot">Sub Total: $'.sprintf('%.2f', $sTotal).'</div>'."\n";
		return $html;
	
	}
	
	private function showUpdateCartForm($product)
	{
		$html = '<div class="qty">'."\n";
		$html .= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n";
		$html .= '<select name="qty">'."\n";
		$html .= '<option value="'.$product['Qty'].'" selected="selected">'.$product['Qty'].'</option>'."\n";
		for ($i=1; $i<6; $i++) {
			$html .= '<option value="'.$i.'">'.$i.'</option>'."\n";
		}
		$html .= '</select>'."\n";
		$html .= '<input type="hidden" name="PID" value="'.$product['PID'].'" />'."\n";
		$html .= '<input type="hidden" name="PPrice" value="'.$product['PPrice'].'" />'."\n";
		$html .= '<input type="hidden" name="oldQty" value="'.$product['Qty'].'" />'."\n";
		$html .= '<input type="submit" name="update" value="Update" />'."\n";
		$html .= '<input type="submit" name="delete" value="Delete" />'."\n";
		$html .= '</form>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
	
}

?>