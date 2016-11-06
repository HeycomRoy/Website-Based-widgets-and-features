$(document).ready(function(){

 	$("h2").append('<em></em>');

	for (i=1; i < 5; i++) {
		$(".thumbs a:eq(" + i + ")").click(imageReplace);
	}	
});

function imageReplace(){
	
		var largePath = $(this).attr("href");
		var largeAlt = $(this).attr("title");
		
		$("#largeImg").attr({ src: largePath, alt: largeAlt });
		
		$("h2 em").html(" (" + largeAlt + ")"); return false;
}