<?php #20130729 http://www.framework.altervista.org/FrameWork/libs/al_04_libGoogleAuth.inc
define('LIBGOOGLEAUTH','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*                                                                      */
/* libUser.inc registrazione login e opzioni utenti                     */
/************************************************************************/

$access_token=$_GET['access_token'];
if ($access_token==""){
?>
<script>
// parse consigliato da google per sistemare # in ?
var params = {}, queryString = location.hash.substring(1),
    regex = /([^&=]+)=([^&]*)/g, m;
while (m = regex.exec(queryString)) {
  params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
}
if (queryString!="")
	location='http://'+window.location.host+'/index.php?' + queryString;	
</script>
<?php
}
else{
	//$tokeninfo=file("https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=".$access_token);
	$tokeninfo=file("https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=".$access_token);
	$email=substr($tokeninfo[2],strpos($tokeninfo[2],":")+3,-3);
	$user=substr($email,0, -10);
	$picture=substr($tokeninfo[8],strpos($tokeninfo[8],":")+3,-3);
	$password=$access_token;
	//echo join($tokeninfo)."<hr>"; debug
	
	if (!file_exists("datas/sb/".sb_get()."/users/$user")){
		touch("datas/sb/".sb_get()."/users/$user");
		user_setkey($user,"user_web","");
		user_setkey($user,"user_professione","");
		user_setkey($user,"user_provenienza","");
		user_setkey($user,"user_firma","");
		user_setkey($user,"user_theme","");
		user_setkey($user,"user_lang","");
	}
	user_setkey($user,"user_password",$password);
	user_setkey($user,"user_nome",$user);
	user_setkey($user,"user_email",$email);	
	user_setkey($user,"user_avatar",$picture);

	setcookie("user","$user||$password",mktime(0,0,0,1,1,2025),"");

  echo "<script language=javascript>window.location='index.php';</script>";
  //die(); debug
  }

?>