<?php
class Validate {
   
    public function checkRequired($field)
    {
		if (!$field) {
			$msg = "*Required field";
		}
		return $msg;
    }
   
	public function checkName($name)
	{ // checking names, firstname, surname etc
		if(!preg_match('/^[[:alpha:][:blank:]]+$/',$name)){
			$msg = "*Invalid Name";	
		}
		return $msg;
	}
   
	public function checkEmail($email)
	{ // checking for a valid email
        if(!preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-]+$/',$email)){
			$msg = "*Invalid Email Address";	
        }
		return $msg;
   }
   
	public function checkDOB($month, $day, $year)
	{
//		echo "date: ".$month,$day,$year;
		if (!is_numeric($month) || !is_numeric($day) || !is_numeric($year) 
			|| !checkdate($month, $day, $year)) {
			$msg = "*Invalid date";
		}	
		return $msg;
	}
	
	public function checkNumeric($field) 
	{
		if (!is_numeric($field)) {
			$msg = 'Price needs to be a number';
		}
		return $msg;
	}
	
}//end of class validate
?>