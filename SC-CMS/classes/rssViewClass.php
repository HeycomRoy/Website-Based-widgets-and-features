<?php
class RSSView
{
	private $model;
	private $posts = array();

	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function displayPage()
	{
		$products = $this->model->getProducts();
		foreach ($products as $product) {
			$this->posts[]= array("title"=>$product['PTitle'],
			"link"=>"http://localhost/xampp/luisad/10wdwe02/assd/SC-CMS/index.php?pageID=productView&amp;PID=".$product['PID'],
			"description"=>$product['PDesc']);
		}
		$html = $this->displayFeeds();
		header('Content-type:text/xml');
		return $html;
	}
	
	private function displayFeeds()
	{
		$doc = new DOMDocument('1.0', 'UTF-8');
		$rss = $doc->createElement('rss');
		$rss->setAttribute('version','2.0');
		$doc->appendChild($rss);
		
		$channel = $doc->createElement('channel');
		$channelTitle = $doc->createElement('title','The Stuff Shoppe RSS Feeds');
		$channelLink = $doc->createElement('link','http://localhost/xampp/luisad/10wdwe02/assd/SC-CMS');
		$channelDesc = $doc->createElement('description','The Stuff Shoppe Products');
		$channel->appendChild($channelTitle);
		$channel->appendChild($channelLink);
		$channel->appendChild($channelDesc);
		$rss->appendChild($channel);
		
		foreach($this->posts as $post) {
			$item = $doc->createElement('item');
			$itemTitle = $doc->createElement('title',$post['title']);
			$itemLink = $doc->createElement('link',$post['link']);
			$itemDesc = $doc->createElement('description',$post['description']);
			$item->appendChild($itemTitle);
			$item->appendChild($itemLink);
			$item->appendChild($itemDesc);
			$channel->appendChild($item);
		}
		$doc->formatOutput = true;
		$str = $doc->saveXML();
//		$doc->save("rss.xml");
		return $str;
	}
}
?>