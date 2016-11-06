<?php
header("Cache-Control: no-cache, must-revalidate");
// Fill up array with names
$a[]="Anna";
$a[]="Brittany";
$a[]="Cinderella";
$a[]="Diana";
$a[]="Eva";
$a[]="Fiona";
$a[]="Gunda";
$a[]="Hege";
$a[]="Inga";
$a[]="Johanna";
$a[]="Kitty";
$a[]="Linda";
$a[]="Nina";
$a[]="Ophelia";
$a[]="Petunia";
$a[]="Amanda";
$a[]="Raquel";
$a[]="Cindy";
$a[]="Doris";
$a[]="Eve";
$a[]="Evita";
$a[]="Sunniva";
$a[]="Tove";
$a[]="Unni";
$a[]="Violet";
$a[]="Liza";
$a[]="Elizabeth";
$a[]="Ellen";
$a[]="Wenche";
$a[]="Vicky";
$a[]="Vilma";
$a[]="Alfonso";

$q = $_GET['q'];
if (strlen($q) == 0) {
	exit;
}

$hint = '';
$arrlength = count($a);
for ($i=0; $i < $arrlength; $i++) {
	if (strtolower($q) == strtolower(substr($a[$i], 0, strlen($q)))) {
		if ($hint == '') {
			$hint = $a[$i];
		}
		else  {
			$hint .= ", ".$a[$i];
		}
	}
} 
if ($hint == '') {
	$response = "no suggestion";
}
else {
	$response = $hint;
}
echo $response;
?>