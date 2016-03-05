<?php
/************************************************************************/
/* WEB_DESKTOP  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/**
 * File delle funzioni di sistema della libreria di configurazione
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di Web Desktop.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libConfig
 * @author FW-TEAM <vroby.mail@gmail.com - deplano.d@gmail.com>
 * @version 20120525
 * @since   20070423
 * @copyright Copyright (c) 2006-2012
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */

/**
 * login logout e verifica user
 *
 * La routine scrive avvia la sessione uente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_login(){
  $user=$_POST['user'];
  $password=xcrypt($_POST['password']);
  $cartella=sb_get($user);
//  $user_enabled_login=user_getkey($user,"user_enable_login");

  if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
	include "../../users/$user/".sb_get($user)."/$user";
    }
    else{
	echo "user inesistente <br><a href='index.php'>continua</a>";
//$_SESSION = array();
//session_destroy();
//	httplog();
	die();
    }

//    if ($user_enabled_login!="1" && get_config("gestione_mails/b-reg_with_email","")=="on"){
//	echo "utente non abilitato - effettuare il completamento della registrazione via email<br><a href='index.php'>continua</a>";
////	httplog();
//	die();
//    }

    if ($user_password==$password){
	setcookie("user","$user||$password",time()+899999999,"/");
	setcookie("utente","$user",mktime(0,0,0,1,1,2025),"/","");
	setcookie("cartella","$cartella",mktime(0,0,0,1,1,2025),"/","");
	setcookie("user_avatar","$user_avatar",mktime(0,0,0,1,1,2025),"/","");

//	setcookie("utente","$user",mktime(0,0,0,1,1,2025),"/","");
//	setcookie("user","$user||$password",mktime(0,0,0,1,1,2025),"");
//	$cartella=sb_get($user);
//	setcookie("utente","$user",mktime(0,0,0,1,1,2025),"/","");
//	setcookie("cartella","$cartella",mktime(0,0,0,1,1,2025),"/","");
	echo "<script language=javascript>window.location='index.php';</script>";
    }
    else{
	echo "password non corretta <br><a href='index.php'>continua</a>";
//$_SESSION = array();
//session_destroy();
//	httplog();
	die();
    }

}


/**
 * login logout e verifica user
 *
 * La routine termina la sessione utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_logout(){
//    setcookie("user","$user||$password",time()+899999999,"/");
    setcookie("user","",NULL,"/");
    setcookie("utente","",NULL,"/");
    setcookie("cartella","",NULL,"/");
    setcookie("user_avatar","",NULL,"/");
//    httplog();
    echo "<script language=javascript>window.location='index.php';</script>";

}


/**
 * login logout e verifica user
 *
 * La routine verifica l'identita dell'utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @return string Ritorna $user oppure stringa vuota
 */
function user_getuser(){
      $tmp=explode("||",$_COOKIE['user']);
      $user=$tmp[0];
      $password=$tmp[1];

      if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!="")
        include "../../users/$user/".sb_get($user)."/$user";
      else{
	   if ($user!=""){
		setcookie("user","",NULL,"$url");
//		httplog();
		echo "<script language=javascript>window.location='index.php';</script>";
	    }
        return "";
    }

      if ($user_password==$password)
        return $user;
      else
        return "";
}

/**
 * login logout e verifica user
 *
 * La routine restituisce l'elenco utenti
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @return array $listuser Lista Utenti
 */
function user_listusers(){
    $fd=opendir("../../users");
    $i=0;
    while (false !== ($nf= readdir($fd))){
      if ($nf[0]!="."){
          $listuser[$i++]=$nf;
      }
    }
      closedir($fd);
    return $listuser;
}


/**
 * login logout e verifica user
 *
 * La routine restituisce il numero di utenti registrati
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @return number $i Numero complessivo utenti registrati
 */
function user_countuser(){
    $fd=opendir("../../users");
    $i=0;
    while (false !== ($nf= readdir($fd)))if($nf[0]!='.')$i++;
    closedir($fd);
    return $i;
}

/**
 * registrazione modifica e cancellazione user
 *
 * La routine restituisce il valore di una chiave di un utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $user Utente
 * @param string $key Chiave
 * @return string $key Valore dela Chiave oppure stringa vuota
 */
function user_getkey($user,$key){
    if ($user!="" && file_exists("../../users/$user/".sb_get($user)."/$user")){
	include "../../users/$user/".sb_get($user)."/$user";
	return ${$key};
    }
    else{
	return "";
    }
}


/**
 * registrazione modifica e cancellazione user
 *
 * La routine modifica le opzioni base un utente gia registrato
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_moduser(){
    $user=user_getuser();
    $password=xcrypt($_POST['password1']);
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $web=$_POST['web'];
    $professione=$_POST['professione'];
    $provenienza=$_POST['provenienza'];
    $avatar=$_POST['avatar'];
    $ext_avatar=$_POST['ext_avatar'];
    if ($ext_avatar!="")$avatar=$ext_avatar;
    $firma=$_POST['firma'];
    $theme=$_POST['theme'];
    $lang=$_POST['lang'];

    if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
	if ($_POST['password1']!="")
	    user_setkey($user,"user_password",$password);
	user_setkey($user,"user_nome",$nome);
	user_setkey($user,"user_email",$email);
	user_setkey($user,"user_web",$web);
	user_setkey($user,"user_professione",$professione);
	user_setkey($user,"user_provenienza",$provenienza);
	user_setkey($user,"user_avatar",$avatar);
	user_setkey($user,"user_firma",$firma);
	user_setkey($user,"user_theme",$theme);
	user_setkey($user,"user_lang",$lang);
    }
    else{
	echo "user gia registrato <br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }
}

/**
 * registrazione modifica e cancellazione user
 *
 * La routine permette ad un utente di cancellarsi
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_deluser(){
  $user=user_getuser();

  if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
    unlink ("../../users/$user/".sb_get()."/$user");
  }
  echo "<script language=javascript>window.location='index.php';</script>";
}


/**
 * registrazione modifica e cancellazione user
 *
 * La routine permette all'amministratore di cancellare un utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_killuser(){
  if (admin_isadmin()){
    $user=$_GET['killuser'];

    if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
      unlink ("../../users/$user/".sb_get($user)."/$user");
    }
  }
}




/**
 * Funzione Procedura Calcolo Spazio Occupato Utente - prende le misure 
 *
 * 
 *
 * @author FW-TEAM
 * @version 20131010
 * @since   20131010
 */
function get_size($path) {
		global $size;
	
		$size[$path]=0;
		if(!is_dir($path))return filesize($path);
		$dir = opendir($path);
		while($file = readdir($dir))
		{
			if(is_file($path."/".$file)){
				$size[$path]+=filesize($path."/".$file);
			}
			if(is_dir($path."/".$file) && $file!="." && $file !=".."){
				get_size($path."/".$file);
			}
				$size[$path] +=$size[$path."/".$file];
		}
		closedir($dir);
		//return $size["$path"];
}


/**
 * Funzione Procedura Calcolo Spazio Occupato Utente - Fissaggio Quota Max
 *
 * 
 *
 * @author FW-TEAM
 * @version 20131010
 * @since   20131010
 */

function user_setquotamax($quotamax) {
	$user=user_getuser(); if ($user<>""){
		user_setkey($user,"quotamax", $quotamax);
	}
}

/**
 * Funzione Procedura Calcolo Spazio Occupato Utente - Rilevamento Quota Max
 *
 * 
 *
 * @author FW-TEAM
 * @version 20131010
 * @since   20131010
 */

function user_getquotamax() {
	$user=user_getuser(); if ($user<>""){
		$valore = (int)user_getkey($user,"quotamax");
	}
return $valore;
}


/**
 * Funzione Procedura Calcolo Spazio Occupato Utente - Rilevamento Quota occupata dalla chiave
 *
 * 
 *
 * @author FW-TEAM
 * @version 20131010
 * @since   20131010
 */

function user_getquota() {
	$user=user_getuser(); if ($user<>""){
		$valore = (int)user_getkey($user,"quotacurrent");
	}
return $valore;
}




/**
 * Procedura Calcolo Spazio Occupato Utente - Calcolo Quota Attuale
 *
 * 
 *
 * @author FW-TEAM
 * @version 20131010
 * @since   20131010
 */

function user_getquotacurrent() {
// -------------- procedura ricavo spazio occupato utenti --------------------//

$user=user_getuser(); if ($user<>""){

if (user_getquotamax()==null) {
    user_setquotamax( get_config("quota_user","5120000") );
    $quota = user_getquotamax();
} else { $quota = user_getquotamax();
}

//	$quota = user_getquotamax();

//	$rootpath = "datas/sources/".$user; //path root di user
	$rootpath = "../../users/$user/".sb_get($user).""; //path root di user
//echo $rootpath;
	global $size;//l'array con tutte le directory e il loro spazio occupato


	get_size($rootpath); //occupato

		$total=$quota;  //freespace in Byte
		$spazio_occupato_totale=$size[$rootpath]; //spazio occupato
	
		$free=$total-$spazio_occupato_totale;  //spazio del disco
		$totalmega=$total / 1000000;

		if ($totalmega >= 1000)
			$totalmega=sprintf("%.1fGb",$totalmega/1000);
		else
			$totalmega=sprintf("%.2fMb",$totalmega);
		        $totalmega=str_replace(".00","",$totalmega);
		        $percent=(100*$spazio_occupato_totale+1)/$total;
	// -------------- procedura ricavo spazio occupato utenti --------------------//

	$percent=round($percent,2);
	$base=200;
	$base_title=200;
	$barra=2*$percent;
	$residuo=100-$percent;

	user_setkey($user,"quotacurrent", $spazio_occupato_totale);

	echo "<div style='position:absolute; margin:0px; margin-left: 75%; width: ".$base."px; height:15px; background-color: LIGHTSKYBLUE;'>&nbsp;<span style='color:black;'><b>Max: ".($quota/1000000)."Mb</b></span></div>";
	if ($percent < 50){ echo "<div style='position:absolute; margin:0px; margin-left: 75%; width: ".$barra."px; height:15px; background-color: green;'>&nbsp;<span style='color:white;'><b>Max: ".($quota/1000000)."Mb</b></span></div>";}
	if ($percent > 50 && $percent <= 80 ){ echo "<div style='position:absolute; margin:0px; margin-left: 75%; width: ".$barra."px; height:15px; background-color: ORANGE;'>&nbsp;<span style='color:white;'><b>Max: ".($quota/1000000)."Mb</b></span></div>";}
	if ($percent > 80 && $percent <= 100 ){ echo "<div style='position:absolute; margin:0px; margin-left: 75%; width: ".$barra."px; height:15px; background-color: red;'>&nbsp;<span style='color:white;'><b>Max: ".($quota/1000000)."Mb</b></span></div>";}
	if ($percent > 100){ echo "<div style='position:absolute; margin:0px; margin-left: 75%; width: ".$base."px; height:15px; background-color: BLACK;'>&nbsp;<blink><span style='color:white;'><b>Please Free Space !!!</b></span></blink></div>";}
	echo "<div style='position:absolute; margin:5px; margin-left: 75%; width: ".$base_title."px; height:15px;'><p><b>Used: $percent% - Free: $residuo%</b></p></div>";


}

}






?>
