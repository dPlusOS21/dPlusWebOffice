//storage api.js
//
//

var storeResponse;
var storeService="http://verticaldev.altervista.org/services/storage/index.php";
//var service="services/storage/index.php";

function save(scope,usermail,session,storage,dest){
	location=storeService + "?op=save&scope=" + scope + "&usermail=" + usermail + "&session="+ session +"&storage=" + storage + "&dest=" + dest;
}


