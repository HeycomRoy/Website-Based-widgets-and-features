<?php
include("../includes/pass.php");

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // tells curl to return data as string
curl_setopt($ch, CURLOPT_PROXY, 'http://10.60.10.2');
curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'luisa.diputado:'.PSWD);
//curl_setopt($ch, CURLOPT_URL, 'http://rss.ent.yahoo.com/movies/thisweek.xml');
curl_setopt($ch, CURLOPT_URL, 'http://xml.weather.yahoo.com/forecastrss?p=NZXX0049&u=c');

$content = curl_exec($ch);

curl_close($ch);

/* $file = fopen("weather.xml", "w");
fwrite($file, $content);
fclose($file); */

$doc = new DOMDocument;
$doc->loadXML($content);

$items = $doc->getElementsByTagName('item');    // returns a node list
$firstitem = $items->item(0);

//$title = $firstitem->getElementsByTagName('title')->item(0)->nodeValue;
$titlelist = $firstitem->getElementsByTagName('title');  //  returns a node list 
$titlenode = $titlelist->item(0);		// returns a node
$title = $titlenode->nodeValue;			//  gets the value
echo '<h3>'.$title.'</h3>'."\n";

$description = $firstitem->getElementsByTagName('description')->item(0)->nodeValue;
echo '<p>'.$description.'</p>'."\n";
$forecasts = $firstitem->getElementsByTagName('forecast');
$fcCnt = $forecasts->length; 
for ($i = 0; $i < $fcCnt; $i++) {
	$forecastnode = $forecasts->item($i);
	$text = $forecastnode->getAttribute('text');
	$date = $forecastnode->getAttribute('date');
	$low = $forecastnode->getAttribute('low');
	$high = $forecastnode->getAttribute('high');
	echo '<h4>Forecast for '.$date.'</h4>'."\n";
	echo '<p>'.$text.' Low = '.$low.'<sup>o</sup>C, High = '.$high.'<sup>o</sup>C </p>'."\n";
}

?>




