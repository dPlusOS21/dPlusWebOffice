function ddgrequest(arg){
  var response;
  var service="http://verticaldev.altervista.org/services/duckduckgo/index.php?arg=";
  xmlhttp=new XMLHttpRequest();
   xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		response=xmlhttp.responseText;
    	}
  	}    
	xmlhttp.open("GET",service+arg,false);
	xmlhttp.send();
	return response;
}


