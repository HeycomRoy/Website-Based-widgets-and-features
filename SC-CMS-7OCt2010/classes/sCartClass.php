<?php
class SCart
{

	public function addToCart()			//  used to add data from add cart form to session
	{
		$quantity = $_POST['qty'];
		$price = $_POST['Price'];
		$PID = $_POST['PID'];
		if ($_SESSION['cart']) {
			if (!$this->inCart($PID)) {
				$value = explode('::', $_SESSION['cart']);	  //  separates total value from cart string 	
				$cartValue = $value[1] + $price * $quantity;  // recompute total cart value bu adding the product of price and quantity of the new item to what is already there
				$_SESSION['cart'] = $value[0].','.$PID.'#'.$quantity.'::'.$cartValue;
			}
		}
		else {
			$cartValue = $price * $quantity;
			$_SESSION['cart'] = $PID.'#'.$quantity.'::'.$cartValue;
		}
	}
	
	public function getPidsFromSession()  //   collects all PIDs in the cart and store them in one array 
	{
		$products = explode(',', $_SESSION['cart']);
		$pids = array();
		foreach($products as $product) {
			$prod = explode('#', $product);
			$pids[] = $prod[0];
		}
		return $pids;
	}
	
	public function inCart($PID)		//   used to check if PID already exists in the cart
	{
		$pids = $this->getPidsFromSession();
		if (in_array($PID, $pids)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function displayCartSummary()  	//  used to display the number of items currently in the cart as well as the total value
	{
		$scart = $_SESSION['cart'];
		$html = '<p class="cart">Your cart ';
		if ($scart) {
			$pCount = count($this->getPidsFromSession());
			$html .= 'has '.$pCount.' product';
			$html .= ($pCount > 1) ? 's' : '';
			$html .= '<br />Total Value: $'.$this->getTotalValueFromSession().'<br />'."\n";
			$html .= '<a href="index.php?pageID=viewCart">View Cart/Checkout</a>'."\n";
		}
		else {
			$html .= 'is empty!';
		}
		$html .= '</p>'."\n";
//		echo 'cart: '.$_SESSION['cart'];
		return $html;
	}
	
	public function getTotalValueFromSession()
	{
		$value = explode('::',$_SESSION['cart']);
		$prtVal = sprintf('%.2f', $value[1]);
		return $prtVal;
	}
	
	public function getCartData($odb)		// calls a function that reads the product info of all items that are currently in the cart and returns these info together with quantity ordered
	{
		if ($_SESSION['cart']) {
			$pidsAndqtys = $this->getProductsAndQuantitiesFromSession();
			$products = array();
			foreach($pidsAndqtys as $PID => $qty) {
				$product = $odb->getProducts($PID);
				$product['Qty'] = $qty;
				$products[] = $product;
			}
			return $products;
		}
		return false;
	}
	
	public function getProductsAndQuantitiesFromSession()
	{ 					//  gets PIDS and quantities from session and returns an array of quantities with PIDs as subscripts
		$products = explode(',', $_SESSION['cart']);		//  separating all products
		foreach($products as $product) {
			$prod = explode('#', $product);				//  separating PID and quantity
			if (strstr($prod[1],'::')) {
				$qty = explode('::', $prod[1]);
				$quantities[$prod[0]] = $qty[0];
			}
			else {
				$quantities[$prod[0]] = $prod[1];
			}
		}
		/* echo 'Quantities <pre>';
		print_r($quantities);
		echo '</pre>';*/
		return $quantities; 
	}
	
	public function doCartUpdate()
	{
		$PID = $_POST['PID'];
		$qty = $_POST['qty'];
		$oldQty = $_POST['oldQty'];
		$pprice = $_POST['PPrice'];
		$value = explode('::', $_SESSION['cart']);
		$cartValue = $value[1];
							//  remove effect of old quantity from total cart value
		$resetValue = $cartValue - ($oldQty * $pprice);
							//  compute new total cart value
		$newValue = $resetValue + ($qty * $pprice);
							//  replace the cart string
		$newSessionData = str_replace($PID.'#'.$oldQty, $PID.'#'.$qty, $value[0]);
		$_SESSION['cart'] = $newSessionData.'::'.$newValue;
	}
	
	public function doCartDelete()
	{
		$PID = $_POST['PID'];
		$qty = $_POST['qty'];
		$oldQty = $_POST['oldQty'];
		$pprice = $_POST['PPrice'];
		$value = explode('::', $_SESSION['cart']);
		$cartValue = $value[1];
							//  remove effect of old quantity from total cart value
		$resetValue = $cartValue - ($oldQty * $pprice);
							//  removing the product from cart string
		if (strstr($value[0], ','.$PID.'#'.$oldQty)) {		//  middle or last item
			$newCartString = str_replace(','.$PID.'#'.$oldQty, '', $value[0]);
			$_SESSION['cart'] = $newCartString.'::'.$resetValue;
		}
		else if (strstr($value[0], $PID.'#'.$oldQty.',')) {		//  first item
			$newCartString = str_replace($PID.'#'.$oldQty.',', '', $value[0]);
			$_SESSION['cart'] = $newCartString.'::'.$resetValue;
		}	
		else {											//  there's only 1 item in the cart
			unset($_SESSION['cart']);
		}
	}
	
	public function doProcessOrder($model, $payObj)
	{
		//    The process payment depends on a third party payment gateway which return a result object e.g. $result
		$totalSale = $this->getTotalValueFromSession();		
		$products = $this->getCartData($model);
		$orderID = $model->createOrder($products, $totalSale);
		$payObj->sendToDPS($totalSale, $orderID);
	}
}
?>