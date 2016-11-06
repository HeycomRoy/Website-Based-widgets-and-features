var xmlHttp;

function showCustomer(str)
{
	xmlHttp = GetXmlHttpObject();
	if (xmlHttp == null) {
		return;
	}
	var url = "getcustxml.php?q=" + str +"&sid=" + Math.random();
//	alert(url);
	xmlHttp.onreadystatechange = stateChanged;
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

function stateChanged()
{
	if (xmlHttp.readyState == 4) {
		xmlDoc = xmlHttp.responseXML;
		document.getElementById('name').innerHTML = xmlDoc.getElementsByTagName('name')[0].childNodes[0].nodeValue; 
		
		document.getElementById('lblEmail').innerHTML = 'Email: ';
		document.getElementById('email').innerHTML = xmlDoc.getElementsByTagName('email')[0].childNodes[0].nodeValue; 
		
		document.getElementById('lblPhone').innerHTML = 'Phone: ';
		document.getElementById('phone').innerHTML = xmlDoc.getElementsByTagName('phone')[0].childNodes[0].nodeValue; 
	}
}
