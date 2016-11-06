var xmlHttp;
 
function showHint(str)
{
	if (str.length == 0) {
		document.getElementById('txtHint').innerHTML = '';
		return;
	}
	xmlHttp = GetXmlHttpObject();
	if (xmlHttp == null) {
		alert("Your browser does not support AJAX!");
		return;
	}
	var url =  url +"?q=" + str +"&sid=" + Math.random();
	xmlHttp.onreadystatechange = function()
	{
		if (xmlHttp.readyState == 4)
		{document.getElementById(elementID).innerHTML = xmlHttp.responseText;}
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
   catch (e)
   {
     try {xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");} 	//  for IE6
      
     catch (e) { alert("Your browser does not support AJAX!");
		return false;  
		}  
  }
  return xmlHttp;  
}  


