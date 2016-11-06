<?php
abstract class View
{	
	protected $rs;
	
	public function __construct($rs)
	{
		$this->rs = $rs;
	}
	
	public function displayPage()
	{
		$html  = $this->displayHeader();
		$html .= $this->displayContent();
		$html .= $this->displayFooter();
		return $html;
	}
	
	abstract protected function displayContent();
	
	protected function displayHeader() 
	{
		$html  = $this->displayHtmlHeader();
		$html .= $this->displayBanner();
		$html .= $this->displayNavBar();
		return $html;
	}
	
	private function displayHtmlHeader()
	{
		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		$html .= '<head>'."\n";
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'."\n";
		$html .= '<meta name="description" content="'.$this->rs['PageDescription'].'" />'."\n";
		$html .= '<meta name="keywords" content="'.$this->rs['PageKeywords'].'" />'."\n";
		$html .= '<link rel="stylesheet" href="css/style.css" />'."\n";
		$html .= '<title>'.$this->rs['PageTitle'].'</title>'."\n";
		if ($_GET['pageID'] == 'contact') {
			$html .= '<script type="text/javascript"  src="http://maps.google.com/maps/api/js?sensor=false">'."\n";
			$html .= '</script>'."\n";
			$html .= '<script type="text/javascript" src="js/gmap.js">'."\n";
			$html .= '</script>'."\n";
			$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/wysiwyg.js"></script>'."\n";
			$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/wysiwyg-settings.js"></script>'."\n";
		}	
		$html .= '</head>'."\n";
		return $html;
	}

	private function displayBanner()
	{
		$html  = '<body>'."\n";
		$html .= '<div id="pgecnt">'."\n";
		$html .= '<div id="banner">'."\n";
		$html .= '<img src="assets/title.png" alt="TSS Banner" />'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
	
	private function displayNavBar()
	{
		$pageArray = array('home','gallery','login','contact');
		$navArray  = array('Home','Gallery','Login','Contact Us');
		if (isset($_SESSION['Admin'])) {
			$navArray[2] = 'Logout';
			$pageArray[2] = 'logout';
		}
		$numLinks = count($navArray);
		$html = '<div id="nav">'."\n";
		$html .= '<ul>'."\n";
		if ($_GET['pageID']) {
			$pageID = $_GET['pageID'];
		}
		else {
			$pageID = 'home';
		}
		for ($i=0; $i<$numLinks; $i++) {
			$html .= '<li><a href="index.php?pageID='.$pageArray[$i].'" >';
			if ($pageID == $pageArray[$i]) {
				$html .= '<span id="activ">'.$navArray[$i].'</span></a></li>'."\n";
			}
			else {
				$html .= $navArray[$i].'</a></li>'."\n";
			}
			if ($i < $numLinks - 1) {
				$html .= '<li> | </li>'."\n";
			}
		}
		$html .= '</ul>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
	
	protected function displayFooter()
	{
		$html = '';
		if ($_SESSION['Admin']) {
			$html .= '<p class="admfoot">Logged in as '.$_SESSION['Admin'];
			$html .= ' | <a href="index.php?pageID=addProduct">Add New Product</a></p>'."\n";
		}
		$html .= '</div>'."\t".'<!--  closes pgecnt   -->'."\n";
		$html .= '<div class="footer">'."\n";
		$html .= '<p>Copyright Diploma of Web Development - ';
		$html .= '<a href="http://www.natcoll.ac.nz">Natcoll Design Technology</a></p>'."\n";
		$html .= '</div>'."\n";
		$html .= '</body>'."\n";
		$html .= '</html>'."\n";
		return $html;
	}
	
}
?>