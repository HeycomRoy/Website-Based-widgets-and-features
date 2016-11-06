<?php
/*
**	Handles simple captcha creation and checking
*/
class Captcha
{
	private function getWords()
	{
		$words = array('dog','cat','ferret','weasel','parrot','lion');
		shuffle($words);
		return $words[0].' '.$words[1];
	}

	public function create() 
	{
		$string = $this->getWords();
		$numchars = strlen($string);
		
		$width = $numchars * 12;
		$height = 60;
		$font = 'fonts/00TT.TTF';
		
		$location = 'captchas/'.uniqid('captcha_').'.jpg';
								// create an empty canvas
		$img = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($img, 255, 255, 255);
		imagettftext($img, 12, 0, 8, 22, $white, $font, $string);
		imagejpeg($img, $location, 70);
		flush();
		imagedestroy($img);
		$_SESSION['captcha'] = $string;
		return $location;
	}

	public function match($value)
	{
		if (empty($value)) {
			return false;
		}
		return $value == $_SESSION['captcha'];
	}
}
?>