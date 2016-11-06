<?php

	function displayContent()
	{
		$html = '<form>'."\n";
		$html .= '<p>Select a CD:';
		$html .= '<select name="cds" onchange="ajaxFunction(this.value,\'getcd.php\',\'cdInfo\')">'."\n";
		$html .= getCdXml();
		$html .= '</select>'."\n";
		$html .= '</form></p>'."\n";
		$html .= '<div id="cdInfo"></div>'."\n";
		return $html;
	}
	
	function getCdXml()
	{
		$html = '';
		$doc = new DOMDocument();
		$doc->load("catalog.xml");
		$artistList = $doc->getElementsByTagName('ARTIST');
		$artists = array();
		$artistCount = $artistList->length;
		for ($i=0; $i < $artistCount; $i++) {
			$artists[] = $artistList->item($i)->nodeValue;
		}
		foreach ($artists as $artist) {
			$html .= '<option value="'.$artist.'">'.$artist.'</option>'."\n";
		}
		return $html;
	}

	include "../classes/displayClass.php";
	$mypage = new displayPage("Ajax XML Demo","Ajax XML Demo","Ajax XML Demo","Ajax XML Demo");
	$html = $mypage->displayHeader();
	$html .= displayContent();
	$html .= $mypage->displayFooter();
	echo $html;
?>