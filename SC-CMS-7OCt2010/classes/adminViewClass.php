<?php

class AdminView extends View
{
	private $model;
	private $result;

	public function __construct($rs, $model)
	{
		$this->rs = $rs;
		$this->model = $model;
	}

	public function displayPage()
	{
		//  check user session here
		$this->result = $this->model->checkUserSession();
		/* $html  = $this->displayHeader();
		$html .= $this->displayContent();
		$html .= $this->displayFooter(); */
		$html = parent::displayPage();
		return $html;
	}
	
	protected function displayContent()
	{
		if ($this->result['pageMsg']) {
			$html = '<div class="pageMsg">'.$this->result['pageMsg'].'</div>'."\n";
		}	
		else if (!$_SESSION['Admin']) {
			$html = $this->displayLoginForm();
		}
		return $html;
	}
	
	private function displayLoginForm()
	{
		$html  = '<h2 class="pagehead">'.$this->rs['PageHeading'].'</h2>'."\n";
		$html .= '<div class="admbox">'."\n"; 
		$html .= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" >'."\n";
		$html .= '<label for="userName" class="col1">User Name</label>'."\n";
		$html .= '<input type="text" name="userName" id="userName" value="'.$_POST['userName'].'" class="col2" />'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<label for="userPassword" class="col1">Password</label>'."\n";
		$html .= '<input type="password" name="userPassword" id="userPassword" class="col2" />'."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= '<input type="submit" name="login" value="Login" />'."\n";
		$html .= '</form>'."\n";
		$html .= '</div>'."\n";
		$html .= '<div class="pgErrMsg">'.$this->result['errorMsg'].'</div>'."\n";
		return $html;
	}
}

?>