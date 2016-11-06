<?php
include("../includes/pass.php");

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // tells curl to return data as string
curl_setopt($ch, CURLOPT_PROXY, 'http://10.60.10.2');
curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'luisa.diputado:'.PSWD);
curl_setopt($ch, CURLOPT_URL, 'http://www.stuff.co.nz');

$content = curl_exec($ch);

if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 407) {
	die ("Proxy authentication required");
}

echo $content;
?>