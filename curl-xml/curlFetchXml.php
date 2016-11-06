<?php
include("../includes/pass.php");

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // tells curl to return data as string
curl_setopt($ch, CURLOPT_PROXY, 'http://10.60.10.2');
curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'luisa.diputado:'.PSWD);
//curl_setopt($ch, CURLOPT_URL, 'http://rss.ent.yahoo.com/movies/thisweek.xml');
curl_setopt($ch, CURLOPT_URL, 'http://feeds.boingboing.net/boingboing/iBag');

$content = curl_exec($ch);

/* $file = fopen("page.xml", "w");
fwrite($file, $content);
fclose($file); */

$doc = new DOMDocument();
$doc->loadXML($content);

echo '<ul>'."\n";
$items = $doc->getElementsByTagName('item');    // returns a node list

$itemLength = $items->length;

for ($i = 0; $i < $itemLength; $i++) {
	$oneitem = $items->item($i);
	$title = $oneitem->getElementsByTagName('title')->item(0)->nodeValue;
	$link = $oneitem->getElementsByTagName('link')->item(0)->nodeValue;
	echo '<li><a href="'.$link.'">'.$title.'</a></li>'."\n";
}
echo '</ul>'."\n";

?>



