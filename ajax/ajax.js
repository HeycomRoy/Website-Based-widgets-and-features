function ajaxFunction(str, url, elementID)
{
	xmlHttp = GetXmlHttpObject();
	if (xmlHttp == null) {
		return;
	}
	var url = url +"?q=" + str +"&sid=" + Math.random();
        
        //alert (url); //this code is for debugging purposes
        
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4) {
			document.getElementById(elementID).innerHTML = xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function GetXmlHttpObject()
{					//   creates the XMLHttpRequest object
   var xmlHttp = null;
   try {   				// Firefox, Opera 8.0+, Safari, IE7
    xmlHttp=new XMLHttpRequest();
   } 
   catch (e) {
     try {					//  for IE6
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
     } 
     catch (e) {
      alert("Your browser does not support AJAX!");
      return false;  
     }  
  }
  return xmlHttp;  
}