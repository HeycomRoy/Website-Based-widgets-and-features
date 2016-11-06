<?php

class EditView extends View
{
	private $model;
	private $page;
	private $formData;
	private $result;

	public function __construct($rs, $model, $page)
	{
		$this->rs = $rs;
		$this->model = $model;
		$this->page = $page;
	}
	
	protected function displayContent()
	{
		if (!isset($_SESSION['Admin'])) {
			$html = '<div class="pageMsg">Sorry, but this is a restricted page!</div>'."\n";
			return $html;
		}
		if ($_POST['submit']) {
			$this->formData = $_POST;
			$this->result = $this->model->validatePage();
			if ($this->result['ok']) {
				$this->result['msg'] = $this->model->updatePage($_POST);
			}
		}
		else {
			$this->formData = $this->rs;
		}
		$html .= $this->displayEditPageForm();
		return $html;
	}
	
	private function displayEditPageForm()
	{
	    extract($this->formData);
		if (is_array($this->result)) {
			extract($this->result);
		}
		$html = '<div class="hmecontent">';
		$html .= '<h2>Page Edit Form</h2>'."\n";;
		$html .= '<div id="editform">';
	    $html .= '<form id="edit_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">'."\n"; 
		$html.= '<label for="PageID" class="col1">Page Name </label>';
		$html.= '<input type = "text" name="PageID" id = "PageID"  class="col2a"'.
				'value="'.$PageID.'" readonly=\'readonly\' />'."\n";			
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PageTitle" class="col1">Page Title </label>';
		$html.= '<input type = "text" name="PageTitle" id = "PageTitle"  class="col2a"  value="'.htmlentities(stripslashes($PageTitle),ENT_QUOTES).'" />'."\n";	
		$html.= '<div class="col3">'.$PTitleMsg.'</div>'."\n";	
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PageHeading" class="col1">Page Heading </label>';
		$html.= '<input type = "text" name="PageHeading" id = "PageHeading"  class="col2a"  value="'.htmlentities(stripslashes($PageHeading),ENT_QUOTES).'" />'."\n";	
		$html.= '<div class="col3">'.$PHeadingMsg.'</div>'."\n";	
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="page_keywords" class="col1">Keywords </label>';
		$html.= '<input type = "text" name="PageKeywords" id = "PageKeywords"  class="col2a"  value="'.htmlentities(stripslashes($PageKeywords),ENT_QUOTES).'" />'."\n";
		$html.= '<div class="col3">'.$PKeywordsMsg.'</div>'."\n";	
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PageDescription" class="col1">Description </label>';
		$html.= '<input type = "text" name="PageDescription" id = "PageDescription"  class="col2a"  value="'.htmlentities($PageDescription).'" />'."\n";	
		$html.= '<div class="col3">'.$PDescriptionMsg.'</div>'."\n";			
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<label for="PageContent"  class="col1">Page Content  </label>'."\n";
		$html.= '<textarea name="PageContent" id="PageContent" class="col2a" rows="7">'.$PageContent."</textarea>\n";
		$html.= '<div class="col3">'.$PContentMsg.'</div>'."\n";	
		$html.= '<div class="clear"></div>'."\n";	
		$html.= '<input type = "submit" name="submit" value="Submit" class="submitButton" />'."\n";
		$html.= '<div class="clear"></div>'."\n";
		$html.= '<div class="pageMsg">'.$this->result['msg'].'</div>';
		$html.= '</form>'."\n";
		$html.= "\t</div>\n</div>";
		return $html;
	}
	
}

?>