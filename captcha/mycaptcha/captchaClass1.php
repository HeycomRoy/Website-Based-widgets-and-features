<?php
/*
**	Handles simple captcha creation and checking
**   	generates a string of random characters
*/
class Captcha
{
	private function getWords()
	{
		$chars = 'abcdefghijklmnopqrstuvwxyz123456789';
		$numchars = strlen($chars);
		$wordlength = rand(4,7);
		$word = '';
		for ($i=0; $i < $wordlength; $i++) {
			$pos = rand(0,$numchars);       //  generate a random position
			$word .= substr($chars, $pos, 1);
		}
		return $word;
	}

	public function create() 
	{
		$string = $this->getWords();
		$numchars = strlen($string);
	
		$width = $numchars * 12;
		$width1 = $width + 4;
		$height = 60;
		$font = 'fonts/CAMBRIA.TTC';
		
		$location = 'captchas/'.uniqid('captcha_').'.jpg';
								// create an empty canvas
		$img = imagecreatetruecolor($width1, $height);
		$white = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);
		imagefill($img, 0, 0, $white);
		imagerectangle($img, 0, 0, $width1-1, $height-1, $black);
		$maxfontsize = round($width / $numchars);
		$startx = round(0.5 * $maxfontsize);
		$maxxoffs = round($maxfontsize * 0.9); 
		
		for ($i=0; $i < $numchars; $i++) {
			$ypos = ($height / 2) + round(rand(5,20));
			$fontsize = round(rand(14, $maxfontsize));
			$angleor = round(rand(0,1));
			$angle = round(rand(0,45));
			if ($angleor == 0) {
				$angle = -1 * $angle;
			}
			imagettftext($img, $fontsize, $angle, $startx + $i*$maxxoffs, $ypos, $black, $font, substr($string, $i,1));
		}
	
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