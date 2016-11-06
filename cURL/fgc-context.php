<?php
include("../includes/pass.php");

$auth = base64_encode('luisa.diputado:'.PSWD);

$stream = array('http'=> 
	array('proxy' =>'tcp://10.60.10.2:3128',
		  'request_fulluri' => true,
		  'header' => "Proxy-Authorization: Basic $auth"));

$cxtStream = stream_context_create($stream);

$url = "http://finance.yahoo.com/q?s=MSFT";

$page = file_get_contents($url, false, $cxtStream); 
echo $page;

$file = fopen("page.html", "w");
fwrite($file, $page);
fclose($file);

?>