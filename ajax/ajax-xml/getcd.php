<?php
	$artist = $_GET['q'];
	$html = '<h3>'.$artist.'</h3>'."\n";
	$doc = new DOMDocument();
	$doc->load("catalog.xml");
	$artistList = $doc->getElementsByTagName('ARTIST');
	$artistCount = $artistList->length;
	$found = false;
	for ($i=0; $i < $artistCount; $i++) {
		if ($artistList->item($i)->nodeType == XML_ELEMENT_NODE) {
			if ($artistList->item($i)->nodeValue == $artist) {
				$found = true;
				$parent = $artistList->item($i)->parentNode;
				break;
			}	
		}
	}
	if (!$found) {
		die("Artist not Found");
	}
	$cd = $parent->childNodes;
	$cdCount = $cd->length;
	$html .= '<p>'."\n";
	for($i=0; $i < $cdCount; $i++) {
		if ($cd->item($i)->nodeType == XML_ELEMENT_NODE) {
			if ($cd->item($i)->nodeName != 'ARTIST') {
				$label = $cd->item($i)->nodeName;
				$value = $cd->item($i)->nodeValue;
				$html .= $label.': '.$value.'<br />';
			}
		}
	}
	echo $html;
?>