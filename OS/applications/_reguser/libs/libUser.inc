<?php #20070919 http://www.framework.altervista.org/FrameWork/libs/al_03_libUser.inc
define('LIBUSER','1.00');
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


/**
 * File delle funzioni di sistema della libreria di Utenti
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libUser
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070518
 * @since   20070518
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */

/**
 * security box per utenti registrati per files *********************************************************
 * La funzione restituisce il percorso della security box degli utenti registrati per files. se la sb non esiste allora la crea
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @return string $sbdir Nome del percorso della security box
 */
function user_sb_get(){
    if (!file_exists("../../users/$user/".user_getuser()))mkdir("../../users/$user/".user_getuser(),0755);
    $hdir=opendir("../../users/$user/".user_getuser());
    while (false !== ($f= readdir($hdir)))
      if ($f[0]!='.' && $f!="index.php") $sbdir=$f;
    closedir($hdir);
  if ($sbdir==""){
    $sbdir=rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000);
    echo $sbdir;
    mkdir("../../users/$user/".user_getuser()."/".$sbdir,0755);
    $fp=fopen("../../users/$user/".user_getuser()."/index.php","a");
    fwrite($fp,"\n");
    fclose($fp);
  }
  return $sbdir;
}


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
  $user_enabled_login=user_getkey($user,"user_enable_login");

  if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
	include "../../users/$user/".sb_get()."/$user";
    }
    else{
	echo "user inesistente <br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }

    if ($user_enabled_login!="1" && get_config("gestione_mails/b-reg_with_email","")=="on"){
	echo "utente non abilitato - effettuare il completamento della registrazione via email<br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }

    if ($user_password==$password){
	//setcookie("user","$user||$password",time()+899999999,"");
	setcookie("user","$user||$password",mktime(0,0,0,1,1,2025),"");
	echo "<script language=javascript>window.location='index.php';</script>";
    }
    else{
	echo "password non corretta <br><a href='index.php'>continua</a>";
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
    setcookie("user","",NULL,"$url");
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

      if (file_exists("../../users/$user/".sb_get()."/$user") && $user!="")
        include "../../users/$user/".sb_get()."/$user";
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
 * La routine aggiunge una chiave al file utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $user Utente
 * @param string $key Chiave
 * @param string $value Valore dela Chiave
 */
function user_setkey($user,$key,$value){
  if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
    $keylist=@file("../../users/$user/".sb_get()."/$user");
    foreach($keylist as $l=> $key_value){
	if (strpos($key_value,$key)!==false){
	    $nl=$l;
	    break;
	}
    }
    $keylist[$nl]="<?  \$$key=\"$value\";  ?>\n";
    $fp=fopen("../../users/$user/".sb_get()."/$user","w");
    foreach($keylist as $key_value){
	fwrite($fp,$key_value);
    }
    fclose($fp);
  }
  else{
    echo "user non registrato <br><a href='index.php'>continua</a>";
//    httplog();
    die();
  }
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
    if ($user!="" && file_exists("../../users/$user/".sb_get()."/$user")){
	include "../../users/$user/".sb_get()."/$user";
	return ${$key};
    }
    else{
	return "";
    }
}



/**
 * registrazione modifica e cancellazione user
 *
 * La routine registra un nuovo utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_reguser(){
    $user=$_POST['user'];
    $password=xcrypt($_POST['password1']);
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $web=$_POST['web'];
    $professione=$_POST['professione'];
    $provenieza=$_POST['provenienza'];
    $avatar=$_POST['avatar'];
    $ext_avatar=$_POST['ext_avatar'];
    if ($ext_avatar!="")$avatar=$ext_avatar;
    $firma=$_POST['firma'];

    $capchacode=$_POST['capchacode'];
    $capchakey=$_POST['capchakey'];

    $theme=$_POST['theme'];
    $lang=$_POST['lang'];

    if (!file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
/*	if (loadlib("libCapcha") && !capcha_test($capchacode,$capchakey)){
	    echo "Capcha code errato: devi ripetere la registrazione <br><a href='index.php'>continua</a>";
	    httplog();
	    die();
	} */
	touch("../../users/$user/".sb_get()."/$user");
	user_setkey($user,"user",$user);
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
	user_setkey($user,"user_firstdaylogin",date("Y.m.d"));
	user_setkey($user,"user_lastdaylogin",date("Y.m.d"));
	user_setkey($user,"user_currentdaylogin",date("Y.m.d"));

	// se nella configurazione del sito allora si usa l'abilitazione utente da mail
/*	if(get_config("gestione_mails/b-reg_with_email","")=="on") {
	    $magic=rand(10,9999);
	    user_setkey($user,"user_enable_login",$magic);
	    // richiamo routine per invio mail per eventuale abilitazione utente //
	    send_mail_enabled_login($magic);
	}
	else { */
	    user_setkey($user,"user_enable_login","1");
/*	} */
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

    if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
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

  if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
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

    if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
      unlink ("../../users/$user/".sb_get()."/$user");
    }
  }
}


// gestione chiavi ultimo collegamento e primo collegamento

if (user_getuser()!=""){
    $user=user_getuser();
    if (user_getkey($user,"user_currentdaylogin")<date("Y.M.d") || user_getkey($user,"user_currentdaylogin")==""){
	user_setkey($user,"user_lastdaylogin",user_getkey($user,"user_currentdaylogin"));
	user_setkey($user,"user_currentdaylogin",date("Y.M.d"));
    }
    if (user_getkey($user,"user_firstdaylogin")==""){
	user_setkey($user,"user_firstdaylogin",user_getkey($user,"user_lastdaylogin"));
    }

}


/**
 * registrazione modifica e cancellazione user
 *
 * La routine effettua il completamento nuova registrazione by user by email se il settagio lo prevede
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_completereg() {
    $user=$_GET['user'];
    $magic=$_GET['magic'];
    if (user_getkey($user,"user_enable_login")==$magic){
	user_setkey($user,"user_enable_login","1");
	echo "user abilitato ad entrare - si puo' effettuare il login <br><a href='index.php'>continua</a>";
    }
//    httplog();
    die();
}



/**
 * registrazione modifica e cancellazione user
 *
 * La routine effettua l'Invio email per il completamento della registrazione nuovo utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function send_mail_enabled_login($magic) {

//carica la lingua
$lang=lang();
switch($lang){
    case "en":
define ('_COMPLETE_REGISTER_NEW_USER',"please confirm registration");
define ('_COMPLETE_REGISTER_NEW_USER2',"to complete please follow this link:");
	break;
    default;
define ('_COMPLETE_REGISTER_NEW_USER',"Completamento nuova registrazione");
define ('_COMPLETE_REGISTER_NEW_USER2',"Per completare la registrazione clicca sul seguente link:");
	break;
}

  $user = $_POST['user'];
  $user_email = $_POST['email'];
  $sitename = "http://".$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"];


  $mail = _COMPLETE_REGISTER_NEW_USER2."\n"."\n".$sitename."?user_op=completereg&user=$user&magic=$magic";
  $site_email_address = get_config("gestione_mails/site_email_address","");
  $admin_mail = get_config("gestione_mails/admin_mail","");

	//invio la mail se il settaggio sul config del sito lo prevede

if(get_config("gestione_mails/b-reg_with_email","")=="on") {

	if (!mail($user_email,$sitename." - ". _COMPLETE_REGISTER_NEW_USER, $mail, "From: $site_email_address\r\n"."Reply-To: $site_email_address\r\n"."X-Mailer: PHP/".phpversion()))
//	    admin_writelog("fallito invio  Mail a "._COMPLETE_REGISTER_NEW_USER." Utente: ".$user);
	else
//	    admin_writelog("Inviata Mail a "._COMPLETE_REGISTER_NEW_USER." Utente: ".$user);

}

if(get_config("gestione_mails/b-admin_advise_new_user_registration_by_email","")=="on") {

	if (!mail($admin_mail,$sitename." - ". _COMPLETE_REGISTER_NEW_USER, $mail, "From: $site_email_address\r\n"."Reply-To: $site_email_address\r\n"."X-Mailer: PHP/".phpversion()))
//	    admin_writelog("fallito invio  Mail a "._COMPLETE_REGISTER_NEW_USER." Utente: ".$user." ad Admin");
	else
//	    admin_writelog("Inviata Mail a "._COMPLETE_REGISTER_NEW_USER." Utente: ".$user." ad Admin");

}


}



/**
 * registrazione modifica e cancellazione user
 *
 * La routine effettua il Recupero della Password dimenticata
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function send_rnd_password() {

//carica la lingua
$lang=lang();
switch($lang){
    case "en":
define ('_FORGPASS',"Recupero password dimenticata");
define ('_RECPASSNOTICE',"La nuova password generata ti è stata inviata al tuo indirizzo di posta elettronica dal sito ");
define ('_RECPASSESENDMAIL',"La nuova password è stata inviata al tuo indirizzo di posta elettronica");
define ('_FNEWPASS',"Nuova password");
define ("_RECPASSESENDMAIL1","Le istruzioni per il recupero password sono state inviate al tuo indirizzo di posta elettronica");
define ('_RECPASSNOTICE2',"Per completare l' operazione segui il seguente link");
define ('_USER_RANDOM_CREATION_PASSWORD_BY_EMAIL',"Random Creation New User Password");
	break;
    default;
define ('_FORGPASS',"Recupero password dimenticata");
define ('_RECPASSNOTICE',"La nuova password generata ti è stata inviata al tuo indirizzo di posta elettronica dal sito ");
define ('_RECPASSESENDMAIL',"La nuova password è stata inviata al tuo indirizzo di posta elettronica");
define ('_FNEWPASS',"Nuova password");
define ("_RECPASSESENDMAIL1","Le istruzioni per il recupero password sono state inviate al tuo indirizzo di posta elettronica");
define ('_RECPASSNOTICE2',"Per completare l' operazione segui il seguente link");
define ('_USER_RANDOM_CREATION_PASSWORD_BY_EMAIL',"Creazione Random Nuova Password Utente");
	break;
}




  $user=$_POST['user'];


  if (file_exists("../../users/$user/".sb_get()."/$user") && $user!=""){
	include "../../users/$user/".sb_get()."/$user";
    }
    else{
	echo "user inesistente <br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }

  $user = $_POST['user'];
  $user_email = user_getkey($user,"user_email","");
  $sitename = "http://".$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"]; // nome del sito
  $site_email_address = get_config("gestione_mails/site_email_address",""); // richiamo alla chiave per la mail del sito //

    $newpass = "fw-pass-".rand();
    $newpassxcrypt = xcrypt($newpass);
    user_setkey($user,"user_password",$newpassxcrypt);

    $mail = _FORGPASS."\n"."\n"._RECPASSNOTICE.":\n$sitename\n\n"."User: ".$user."\n"._FNEWPASS." : ".$newpass;

	//invio la mail
	mail($user_email,$sitename." - ". _FORGPASS, $mail, "From: $site_email_address\r\n"."Reply-To: $site_email_address\r\n"."X-Mailer: PHP/".phpversion());

//	admin_writelog(_USER_RANDOM_CREATION_PASSWORD_BY_EMAIL." ".$user);


}

?>
