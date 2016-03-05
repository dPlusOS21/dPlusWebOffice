/* api auth 
Autenticazione utenti remota
*/

var $_GET=parse_get();

//imposta la variabile dest per l'autenticazione
var dest=self.location.href;
if (dest.indexOf("?")!=-1)dest=dest.substr(0,dest.indexOf("?"));

$op=$_GET['op'];

if ($op=="session"){
	var $usermail=$_GET['usermail'];
	var $newsession=$_GET['session'];
	var d=new Date();
		setcookie("auth",$usermail+"||"+$newsession,d.getTime+60*60*24*30,"/");
}
if ($op=="logout"){
	setcookie("auth","",-1,"");
	usermail="";
	session="";
	scope="";
	
}
var response;
var service="http://verticaldev.altervista.org/services/auth/index.php";
//var service="services/auth/index.php";


//restituisce un array con tutti i dati oassati con il metodo get
function parse_get(){
  var args = new Array();
  var query = window.location.search.substring(1);
  if (query){
    var strList = query.split('&');
    for(str in strList){
      var parts = strList[str].split('=');
      args[unescape(parts[0])] = unescape(parts[1]);
    }
  }
  return args;
}


//crea un cookie nello stile php
function setcookie(nome,value,expires,path){
	document.cookie = nome + '=' + escape(value) + '; expires=' + expires+'; path='+path;
}



//preleva dal coookie il tuo nome
function getuser(){
  if (document.cookie.length > 6)
  {
    var inizio = document.cookie.indexOf("auth" + "=");
    if (inizio != -1)
    {
      inizio = inizio + 5;
      var fine = document.cookie.indexOf(escape("||"),inizio);
      if (fine == -1) fine = document.cookie.length;
      return unescape(document.cookie.substring(inizio,fine));
    }else{
       return "";
    }
  }
  return "";
}

//preleva dal coookie la tua session
function getsession(){
  if (document.cookie.length > 6)
  {
    var inizio = document.cookie.indexOf("auth" + "=");
    if (inizio != -1)
    {
		
      inizio = document.cookie.indexOf(escape("||")) + 6;
      var fine = document.cookie.indexOf(";",inizio);
      if (fine == -1) fine = document.cookie.length;
      return unescape(document.cookie.substring(inizio,fine));
    }else{
       return "";
    }
  }
  return "";
}

//verifica se sei connesso
function verify(scope,usermail,session){
	response="wait";
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		response=xmlhttp.responseText;
    		if(response!="1\n")setcookie("auth","",-1,"/");
    	}
  	}    
	xmlhttp.open("GET",service+"?op=verify&scope="+scope+"&dest="+dest+"&usermail="+usermail+"&session="+session,false);
	xmlhttp.send();
	while(response=="wait");
}

//api automatica
function verifyuser(scope){
	verify(scope,getuser(),getsession());
	return response.replace("\n","");
}





function login(scope){
	location=service + "?op=login&scope=" + scope + "&dest=" + dest + "&usermail=" + getuser() + "&session=" + getsession();
}

function logout(scope){
	location=service + "?op=logout&scope=" + scope + "&dest=" + dest + "&usermail=" + getuser() + "&session=" + getsession();
}

function dashboard(scope){
	location=service + "?op=dashboard&scope=" + scope + "&dest=" + dest + "&usermail=" + getuser() + "&session=" + getsession();
}

function switchlog(scope){
	if (getsession())
		dashboard(scope);
	else
		login(scope);
}

