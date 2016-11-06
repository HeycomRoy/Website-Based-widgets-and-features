<?php

class ContactView extends View
{
	protected function displayContent()
	{
		$html = '<div class="hmecontent">'."\n";
		$html .= '<h2>'.$this->rs['PageHeading'].'</h2>'."\n";
		/* $html .= '<p>'.$this->rs['PageContent'].'</p>'."\n";
		if ($_SESSION['Admin']) {
			$html .= '<p class="smltxt">'.
				'<a href="index.php?pageID=editView&amp;page=home">edit</a></p>'."\n";
		} */
		$html .= '<div id="map_canvas" style="width:400px; height:400px; margin: 0 auto"></div>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
}
?>