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
	
	public function patternMatch($pattern)
	{
		preg_match_all("($pattern)siU", $this->html, $results);
		return $results;
	}
}

$mySpider = new wSpider();
$url = "http://finance.yahoo.com/q?s=MSFT";
//$url = "http://www.stuff.co.nz";
$mySpider->fetchPage($url);
$pattern = '<big><b><span id=".+">(.+)<\/span><\/b><\/big>';
$results = $mySpider->patternMatch($pattern);
echo '<h3>MSFT Stock Price: </h3> $ '.$results[1][1];

$mySpider1 = new wSpider();
$url1 = "http://westpac.co.nz/olcontent/olcontent.nsf/Content/Choices+home+loan+rates";

$mySpider1->fetchPage($url1);
echo '<h3>Current Westpac Mortgage Rates</h3>';
for ($i=1; $i<=3; $i++) {

	$pattern1 = '<li class="rate'.$i.'"><p>(.+)<img.+</p><span>(.+)</span></li>';

	$results1 = $mySpider1->patternMatch($pattern1);

	echo '<p>'.$results1[2][0].': '.$results1[1][0].' %</p>';
}	

?>





