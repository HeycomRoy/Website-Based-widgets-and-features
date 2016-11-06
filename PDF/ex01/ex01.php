<?php
	//define new object
	$pdf = pdf_new();
	//create the pdf
	$filepath = 'G:\xamp\xampplite\htdocs\advanced\PDF\ex01\new.pdf';
	$created = pdf_open_file($pdf, $filepath);
	//define infomationa(optional)
	pdf_set_info($pdf, 'Title', 'Creating a PDF via PHP');
	pdf_set_info($pdf, 'Creator', 'Jonny Brown');
	//define character set
	pdf_set_parameter($pdf, 'textformat', 'utf8');
	//set page dimensions
	pdf_begin_page($pdf, 595, 842);
	//load font to memory
	$font = pdf_load_font($pdf, 'Helvetica', 'host', '');
	
//add text	
	//set font details
	pdf_setfont($pdf, $font, 18);
	//start displaying
	pdf_show_xy($pdf, 'My first PDF page', 50, 800);
	
	//set font again
	pdf_setfont($pdf, $font, 12);
	//start displaying
	pdf_show_xy($pdf, 'more text bahahah more more more mroe moer mero', 50, 760);

//add image	
	//defineimage
	$imagepath = $_SERVER['DOCUMENT_ROOT'].'/advanced/PDF/ex01/Zel.jpg';
	//load image
	$image = pdf_load_image($pdf, 'jpeg', $imagepath, '');
	//place imgage
	pdf_fit_image($pdf, $image, 100, 400, 'scale 0.4' );
	
	//end the page
	pdf_end_page($pdf);
	//close document
	pdf_close($pdf);
	
?>