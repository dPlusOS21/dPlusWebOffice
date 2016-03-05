/* pagecount api 
page counter service
*/


var response;
var service="http://verticaldev.altervista.org/services/pagecount/index.php";
//var service="services/pagecount/index.php";


//aggiunge la visita
function pc_add(scope){
	response="wait";
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		response=xmlhttp.responseText;
    	}
  	}    
	xmlhttp.open("GET",service+"?op=add&scope="+scope,false);
	xmlhttp.send();
	while(response=="wait");
}

//legge le visite
function pc_read(scope){
	response="wait";
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		response=xmlhttp.responseText;
    	}
  	}    
	xmlhttp.open("GET",service+"?op=read&scope="+scope,false);
	xmlhttp.send();
	while(response=="wait");
	return response;
}

