<?php
include("../includes/pass.php");

$auth = base64_encode('luisa.diputado:'.PSWD);
//$auth = base64_encode('luisa.diputado:xxx');

$stream = array('http'=> 
	array('proxy' =>'tcp://10.60.10.2:3128',
		  'request_fulluri' => true,
		  'header' => "Proxy-Authorization: Basic $auth"));

$cxtStream = stream_context_create($stream);

$url = "http://finance.yahoo.com/q?s=MSFT";

$page = file_get_contents($url, false, $cxtStream); 
$pattern = '/<big><b><span id=".+">(.+)<\/span><\/b><\/big>/';
preg_match_all($pattern, $page, $results);

/* echo '<pre>';
print_r($results);
echo '</pre>'; */

echo 'Stock Price: '.$results[1][1];

?>