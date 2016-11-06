<?php
class displayPage {
	
	private $title;
	private $keywords;
	private $description;
	private $heading;
	private $css;
	
    function __construct($page_title="", $page_keywords="", $page_description="", $page_heading="", $page_css="../css/style.css"){
		$this->title=$page_title;
		$this->keywords=$page_keywords;
		$this->description=$page_description;
		$this->heading=$page_heading;	
		$this->css=$page_css;	
	}
	
	function displayHeader()
	{
		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		$html .= '<head>'."\n";
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'."\n";
		$html .= '<meta name="description" content="'.$this->description.'" />'."\n";
		$html .= '<meta name="keywords" content="'.$this->keywords.'" />'."\n";
		$html .= '<link rel="stylesheet" href="'.$this->css.'" />'."\n";
		$html .= '<title>'.$this->title.'</title>'."\n";
		$html .= '<script type="text/javascript" src="../ajax.js"></script>'."\n";
		$html .= '</head>'."\n";
		$html .= '<body>'."\n";	

		$html .= '<h1>'.$this->heading.'</h1>'."\n";
		return $html;
	} // end of display_header()function
	
	
	function displayFooter()
	{
		$html = '<br />Copyright by me - <a href="#">myDesign.co.nz</a>'."\n";
		$html .= "</body>\n</html>";
		return $html;
	}// end of display_footer() function
	
	
}
?>
