<?php
include("../includes/pass.php");

class wSpider
{
	public $ch;			//  cURL handle
	public $html;		// resultant html data
	public $binary;		// for binary transfers
	public $url;		//  the url containing data to be downloaded

	public function __construct()
	{
		$this->html = '';
		$this->binary = 0;
		$this->url = '';
	}
	
	public function fetchPage($url) 
	{
		if (!$url) {
			return;
		}
		$this->url = $url;
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);  // tells curl to return data as string
		curl_setopt($this->ch, CURLOPT_PROXY, 'http://10.60.10.2');
		curl_setopt($this->ch, CURLOPT_PROXYPORT, '3128');
		curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, 'luisa.diputado:'.PSWD);
		curl_setopt($this->ch, CURLOPT_URL, $this->url);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, $this->binary);
		$this->html = curl_exec($this->ch);
		curl_close($this->ch);
	}
}

$mySpider = new wSpider();
//$url = $url = "http://finance.yahoo.com/q?s=MSFT";
$url = "http://www.stuff.co.nz";
$mySpider->fetchPage($url);
echo $mySpider->html;
$file = fopen("page.html", "w");
fwrite($file, $mySpider->html);
fclose($file);
?>





