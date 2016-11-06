(function() {

	//  run initialize when page loads
	if (window.addEventListener) {
		window.addEventListener('load', initialize, false);
	}
	else if (window.attachEvent) {
		window.attachEvent('onload', initialize);
	}

function initialize() {
    var latlng = new google.maps.LatLng(-41.2950090, 174.7836760);
    var myOptions = {
		zoom: 16,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: true,
	    mapTypeControlOptions: {
	      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	    },
	    navigationControl: true,
	    navigationControlOptions: {
	      style: google.maps.NavigationControlStyle.SMALL
	    }
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
	var marker = new google.maps.Marker({
		position: latlng, 
		map: map, 
		title:"Natcoll Design Technology"	
	}); 	
  }
 })(); 