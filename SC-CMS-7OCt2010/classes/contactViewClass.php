<?php
include 'lib/captcha/captchaClass.php';

class ContactView extends View
{
	private $captcha;
	private $model;
	private $result;
	
	public function __construct($rs, $model)
	{
		$this->rs = $rs;
		$this->model = $model;
	}
	
	protected function displayContent()
	{
		$html = '';
		$this->captcha = new Captcha;
		if ($_POST['submit']) {
			$this->result = $this->model->validateContactForm($_POST);
			if ($this->result['ok']) {
				$html .= $this->displaySendEmailResult();
				return $html;
			}
		}
		$html .= '<script type="text/javascript" src="lib/openwysiwyg/scripts/mysettings.js"></script>'."\n";
		$html .= '<div class="hmecontent">'."\n";
		$html .= '<h2>'.$this->rs['PageHeading'].'</h2>'."\n";
		/* $html .= '<p>'.$this->rs['PageContent'].'</p>'."\n";
		if ($_SESSION['Admin']) {
			$html .= '<p class="smltxt">'.
				'<a href="index.php?pageID=editView&amp;page=home">edit</a></p>'."\n";
		} */
		$html .= '<div id="map_canvas" style="width:400px; height:400px; margin: 0 auto"></div>'."\n";
		$html .= $this->displayForm();
		$html .= '</div>'."\n";
		return $html;
	}
	
	private function displayForm()
	{
		if (is_array($this->result)) {
			extract($this->result);
		}
		$html  = '<div id="cform">'."\n";
		$html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'."\n";
		$html .= '<label for="email" class="col1">Email</label>'."\n";
		$html .= '<input type="text" name="email" id="email" class="col2" value="'.$_POST['email'].'" />'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<label for="message" class="col1">Message</label>'."\n";
		$html .= '<textarea id="message" name="message" class="col2">'.$_POST['message'].'</textarea>'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$location = $this->captcha->create();
		$html .= '<img class="col1" src="'.$location.'" />'."\n";
		$html .= '<div class="col2">'."\n";
		$html .= '<label id="captcha">Enter word</label>'."\n";
		$html .= '<input type="text" name="captcha" />'."\n";
		$html .= '<input type="submit" name="next" value="Next" /></div>'."\n";
		$html .= '<div class="col3">'.$captchaMsg.'</div>'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<input type="submit" name="submit" value="Submit" />'."\n";
		$html .= '</form>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}
	
	private function displaySendEmailResult()
	{
		$html = "Email sent";
		return $html;
	}
}
?>