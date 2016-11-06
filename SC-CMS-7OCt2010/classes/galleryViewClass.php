<?php

class GalleryView extends View
{
/*
**	This class contains the methods needed to generate the content of the product gallery page
*/

	private $model; 
	private $pageNum;			//  current page number
	private $pPageCount = 3;    //  number of products displayed per page
	private $start;				//  record number to use as starting point for the query

	public function __construct($rs, $model, $pageNum)
	{
		$this->rs = $rs;
		$this->model = $model;
		if ($pageNum) {
			$this->pageNum = intval($pageNum);
		}
		else {
			$this->pageNum = 1;
		}
	}
	
	protected function displayContent()
	{
		$count = $this->model->getProductCount();
		$cart = new SCart;
		$html  = $cart->displayCartSummary();
		$html .= '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= $this->displayProducts();
		$html .= $this->displayProductPages($count['pCount']);
		return $html;
	}
	
	private function displayProducts()
	{
		$html = '';
		$this->start = ($this->pageNum - 1) * $this->pPageCount;
		$products = $this->model->getPageProducts($this->start, $this->pPageCount);
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
	
	private function displayProductPages($count)
	{
		if ($count <= $this->pPageCount) {
			return;
		}
		$html = '<div id="pagination"><ul>'."\n";
		if ($this->pageNum > 1) {
			$html .= '<li>&lt; <a href="index.php?pageID=gallery&amp;p='.($this->pageNum - 1).'">Previous</a></li>'."\n";
		}
		else {
			$html .= '<li>Pages: </li>'."\n";
		}
		$pCount = ceil($count / $this->pPageCount);
		for ($i=1; $i <= $pCount; $i++) {
			if ($this->pageNum == $i) {
				$class = "curPage";
			}	
			else {
				$class = "notCur";
			}
			$html .= '<li class="'.$class.'"><a href="index.php?pageID=gallery&amp;p='.$i.'">'.$i.'</a></li>'."\n";
		}
		if ($this->pageNum != $pCount) {
			$html .= '<li class="next"><a href="index.php?pageID=gallery&amp;p='.($this->pageNum + 1).'">Next</a>&gt;</li>'."\n";
		}
		$html .= '</ul></div>'."\n";
		return $html;
	}
}	









?>