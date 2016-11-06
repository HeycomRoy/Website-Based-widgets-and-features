<?php

class HomeView extends View
{
	protected function displayContent()
	{
		$html = '<div class="hmecontent">'."\n";
		$html .= '<h2>'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= '<a href="index.php?pageID=rss"><img src="assets/rsslogo.jpg" alt="rss logo"/></a>'."\n"; 
		$html .= '<p>'.strip_tags($this->rs['PageContent']).'</p>'."\n";
//		$html .= '<p>'.$this->rs['PageContent'].'</p>'."\n";
		if ($_SESSION['Admin']) {
			$html .= '<p class="smltxt">'.
				'<a href="index.php?pageID=editView&amp;page=home">edit</a></p>'."\n";
		}
		$html .= '</div>'."\n";
		return $html;
	}
}
?>