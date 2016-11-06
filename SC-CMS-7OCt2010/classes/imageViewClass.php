<?php
class ImageView extends View
{
	private $model;
	private $start;
	private $imgCnt = 4;
	
	public function __construct($rs, $model, $start)
	{
		$this->rs = $rs;
		$this->model = $model;
		if ($start) {
			$this->start = $start;
		}
		else {
			$this->start = 0;
		}
	}	

	protected function displayContent()
	{
		$html  = '<div id="gallerycontent">'."\n";
		$html .= '<h2>'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= $this->displayImages();
		return $html;
	}
	
	private function displayImages()
	{
		$prodCnt = $this->model->countImages();
		$products = $this->model->getProductImages($this->start, $this->imgCnt);
		$sleft = $this->start - $this->imgCnt;
		if ($sleft < 0) {
			$sleft = 0;
		}
		$sright = $this->start + $this->imgCnt;
		if (($sright + $this->imgCnt) > $prodCnt) {
			$sright = $prodCnt - $this->imgCnt;
		}
		$html = '<p><img id="largeImg" src="images/big_'.$products[0]['PImage'].'" alt="Large image" /></p>'."\n";
		$html .= '<p class="thumbs">'."\n";
		$html .= '<a href="index.php?pageID=imageGallery&amp;start='.$sleft.'">&lt;&lt;</a>'."\n";
		foreach ($products as $product) {
			$html .= '<a href="images/big_'.$product['PImage'].'" title="'.$product['PName'].'">';
			$html .= '<img src="images/'.$product['PImage'].'" alt="'.$product['PName'].'" /></a>'."\n";
		}	
		$html .= '<a href="index.php?pageID=imageGallery&amp;start='.$sright.'">&gt;&gt;</a></p>'."\n";
		return $html;
	}
}
?>