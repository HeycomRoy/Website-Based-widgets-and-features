<?PHP
class captcha{
public function match($value){
    if(empty($value)) return false;
    return $value == $_SESSION['captcha']; // This will return true only if the provided value is a match for the session value
}

/* private function getwords(){
	    $words = array('dog','cat','ferret','weasel'); // Put your list of words in here or put the array in another php file and include it here (to make your code easier to read).
	    shuffle($words);
	    return $words[0] . " " . $words[1];

	} */

private function getwords(){
	$chars = "abcdefghijklmnopqrstuvwxyz123456789";
	$numchars = strlen($chars);
	$lenc = rand(5,7);
	$word = '';
	for ($i=0; $i<$lenc; $i++) {
		$pos = rand(0, $numchars);
		$word .= substr($chars, $pos, 1);
	}
	return $word;
}	
	
public function create(){
	$string = $this->getwords();
	$numchars = strlen($string) + 1; 
	         
	$width = $numchars * 12;
	$height = 60;
//	$font = 'fonts/00TT.TTF';
	$font = 'lib/captcha/fonts/CAMBRIA.TTC';
	$location = 'lib/captcha/captchas/' . uniqid('captcha_') . '.jpg';

	$img = imagecreatetruecolor($width,  $height);
	$white = imagecolorallocate( $img, 255, 255, 255); 
	$black = imagecolorallocate( $img,  0,  0,  0); 
	imagefill($img, 0, 0, $white);	
	imagerectangle ($img, 0, 0, $width-1,  $height-1, $black);
//	imagealphablending($img, true); 
//	imagecolortransparent( $img ); 
	
	// generate background of randomly built ellipses 
	/* for ($i=1; $i<=200; $i++) { 
		$r = round( rand( 0,  100 ) ); 
		$g = round( rand( 0,  100 ) ); 
		$b = round( rand( 0,  100 ) ); 
		$color = imagecolorallocate( $img,  $r,  $g,  $b ); 
		imagefilledellipse($img,round(rand(0, $width)),round(rand(0,$height)),round(rand(0,$width/16)),round(rand(0,$height/4)),$color);     
	}  */
	
	$startx = round($width / $numchars); 
	$maxfontsize = $startx; 
	$startx = round(0.5*$startx); 
	$maxxofs = round($maxfontsize*0.9); 
	
	// give each character a random angle, size and color 
	for ($i=0;$i<$numchars;$i++) { 
		$r = round(rand( 127, 255 )); 
		$g = round(rand( 127, 255 )); 
		$b = round(rand( 127, 255 )); 
		$ypos = ($height/2)+round(rand(5,20)); 
		 
		$fontsize = round( rand( 18,  $maxfontsize) ); 
//		$color = imagecolorallocate( $img,  $r,  $g,  $b); 

		$presign = round( rand( 0,  1 ) ); 
		$angle = round( rand( 0,  25 ) ); 
		if ($presign==true) $angle = -1*$angle; 
		ImageTTFText($img,$fontsize,$angle,$startx+$i*$maxxofs,$ypos,$black,$font,substr($string,$i,1)); 
	} 
	
	// create image file 
	imagejpeg( $img ,$location , 70); 
	flush(); 
	imagedestroy( $img ); 
	$_SESSION['captcha'] = $string;
	return $location;
	

}

}
