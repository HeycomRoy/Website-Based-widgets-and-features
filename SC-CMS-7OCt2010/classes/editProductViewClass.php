<?php

include 'classes/addProductViewClass.php';

class EditProductView extends AddProductView
{
/*
**	This class extends the AddProductView class which contains the product form to add/edit product.  This also calls the updateProductDetails method from the model class which 
**	does the actual update of the product on the cartproducts table and the image upload if necessary 
*/

	private $model;
	private $PID;
	
	public function __construct($rs, $model, $PID)
	{
		$this->rs = $rs;
		$this->model = $model;
		$this->PID = $PID;
	}

	protected function displayContent()
	{
		$html = '<h2 class="pagehead">'.$this->rs['pageHeading'].'</h2>'."\n";
		if (!isset($_SESSION['Admin'])) {
			$html .= '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
			return $html;
		}
		if ($_POST['Update']) {
			$result = $this->model->updateProductDetails($_POST);
			$product = $_POST;
		}
		else {
			$product = $this->model->getProducts($this->PID);
		}
		$html .= $this->displayProductForm("Update", $result, $product);
		return $html;
	}
}
?>