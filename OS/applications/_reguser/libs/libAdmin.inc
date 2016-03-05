<?php #20070612 http://www.framework.altervista.org/FrameWork/libs/al_02_libAdmin.inc
define('LIBADMIN','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*                                                                      */
/* libAdmin.inc administration library                                  */
/************************************************************************/

/**
 * File delle funzioni di sistema della libreria di Amministrazione
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libAdmin
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070512
 * @since   20070512
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */


/**
 * admin session
 *
 * La routine scrive un log nel regisrtro delle operazioni di amministrazione
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @param string $operation Operazione da scrivere
 */
function admin_writelog($operation){
    global $ticket;
    $d=$ticket;
    $file="admin/".date("Y/m/d")."/$d";
//    writelog($file,"ADMINOP", $d,$_SERVER["REMOTE_ADDR"].":".$operation);
}



/**
 * La routine verifica che l'utente e' admin
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @return number $ret Valore 1 Admin - 0 No Admin
 */
function admin_isadmin(){
    if (admin_verifyIP()!=""){
	$ret=1;
	if (get_config("b-admincookie","on")=="on"){
	    if (admin_verifycookie() )
		$ret=1;
	    else
		$ret=0;
	}
    }
    else{
	$ret=0;
    }
    return $ret;
}



/**
 * La routine genera/cambia la password di amministrazione.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @param string $password Password di Aministrazione passata per il controllo
 */
function admin_setpassword( $password ){
//  admin_writelog("setpassword");
  $fp=fopen("../../users/datas/sb/".sb_get()."/admin_passwd","w");
  fwrite($fp,xcrypt($password) );
  fclose($fp);
}



/**
 * La routine verifica la password passata.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @param string $password Password di Aministrazione passata per il controllo
 * @return boolean True se verificata la password - False se non verificata
 */
function admin_verifypassword($password){
 if(!file_exists("../../users/datas/sb/".sb_get()."/admin_passwd")){
    admin_setpassword("FrameWork");//<--- la password di default
 }
 $registered_password=@join(@file("../../users/datas/sb/".sb_get()."/admin_passwd"));
 if ($registered_password==xcrypt($password)){
//    admin_writelog("verifypassword:ok");
    return true;
    }
 else{
//    admin_writelog("verifypassword:failed");
    return false;
    }
}


/**
 * La routine registra l'ip dell'amministratore
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_setIP(){
  $ip=$_SERVER["REMOTE_ADDR"];
//  admin_writelog("admin:set ip administrator");
  $fp=fopen("../../users/datas/sb/".sb_get()."/admin_ip","w");
  fwrite($fp,$ip );
  fclose($fp);
}

/**
 * La routine cancella l'ip dell'amministratore.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_removeIP(){
  $ip="no-ip";
//  admin_writelog("amdimin:remove ip administrator");
  $fp=fopen("../../users/datas/sb/".sb_get()."/admin_ip","w");
  fwrite($fp,$ip );
  fclose($fp);
}


/**
 * La routine verifica l'ip dell'amministratore.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @return boolean True se verificato l'IP - False se non verificato
 */
function admin_verifyIP(){
 $ip=$_SERVER["REMOTE_ADDR"];
 if (!file_exists("../../users/datas/sb/".sb_get()."/admin_ip"))
    admin_removeIP();

 $registered_ip=@join(@file("../../users/datas/sb/".sb_get()."/admin_ip"));
 if ($registered_ip==$ip){
    //admin_writelog("verifyip:ok");
    return true;
    }
 else{
    //admin_writelog("verifyip:failed");
    return false;
    }
}



/**
 * La routine attiva la sessione di aaministrazione e scrive l'operazione nel log.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_startsession(){
    $data=date("Y/m/d").".".(time()%1000);
    $d=date("H.i.s").microtime();
    admin_setIP();
    if (get_config("b-admincookie","on")=="on")admin_setcookie();

//    writelog("admin/$data","URI",$d,"start session:".$_SERVER["REMOTE_ADDR"] );
}




/**
 * La routine termina la sessione di amministrazione e registra l'operazione nel log.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_stopsession(){
    $data=date("Y/m/d").".".(time()%1000);
    $d=date("H.i.s").microtime();
    if (get_config("b-admincookie","on")=="on")admin_removecookie();
    admin_removeIP();
//    writelog("admin/$data","URI",$d,"stop session:".$_SERVER["REMOTE_ADDR"] );
}





/**
 * funzionalita'  cookie
 *
 * La routine setta un cookie da amministratore.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_setcookie(){
    $registered_password=@join(@file("../../users/datas/sb/".sb_get()."/admin_passwd"));
    setcookie("admin","$registered_password",mktime(0,0,0,1,1,2025),"");
//    httplog();
    echo "<script language=javascript>window.location='index.php';</script>";
}


/**
 * La routine toglie il cookie da amministratore.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
function admin_removecookie(){
    setcookie("admin","",NULL,"$url");
//    httplog();
    echo "<script language=javascript>window.location='index.php';</script>";
}


/**
 * La routine verifica il possesso del cookie da amministratore.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 * @return costant on se verificato - Null se non verificato
 */
function admin_verifycookie(){
    $registered_password=@join(@file("../../users/datas/sb/".sb_get()."/admin_passwd"));
    $password=$_COOKIE['admin'];
    if ($registered_password==$password)
	return "on";
    else
	return"";
}

/**
 * La routine contiene la procedura di controllo/creazione della SB.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */

    $d=date("H.i.s");
    $year=date("Y");
    $month=date("m");
    $day=date("d");

    if(!file_exists("../../users/datas/sb/".sb_get()."/logs"))mkdir("../../users/datas/sb/".sb_get()."/logs",0755);
    if(!file_exists("../../users/datas/sb/".sb_get()."/logs/admin"))mkdir("../../users/datas/sb/".sb_get()."/logs/admin",0755);
    if(!file_exists("../../users/datas/sb/".sb_get()."/logs/admin/$year"))mkdir("../../users/datas/sb/".sb_get()."/logs/admin/$year",0755);
    if(!file_exists("../../users/datas/sb/".sb_get()."/logs/admin/$year/$month"))mkdir("../../users/datas/sb/".sb_get()."/logs/admin/$year/$month",0755);
    if(!file_exists("../../users/datas/sb/".sb_get()."/logs/admin/$year/$month/$day"))mkdir("../../users/datas/sb/".sb_get()."/logs/admin/$year/$month/$day",0755);

// l'albero decisionale
// gestione autenticazione e sessione di amministrazione
$admin_op=$_GET['admin_op'];
if( $admin_op!=""){

    switch ($admin_op){
	case "setpassword":
	    if (admin_isadmin()){
		//echo "setpassword:";
		$password=$_POST['password'];
		if ($password!=""){
		    admin_setpassword($password);
		    echo "<script>alert('password changed');</script>\n";
		}
	    }
	break;

	case "startsession":
	    $password=$_POST['password'];
	    if (admin_verifypassword($password)){
		//echo "startsession:";
		admin_startsession();
	    }
	break;

	case "stopsession":
	    $password=$_POST['password'];
	    if (admin_isadmin()){
		//echo "stopsession:";
		admin_stopsession();
	    }
	break;
    }
}


/**
 * La routine se non e' anora stata creata la password di admin provvede a settarla.
 *
 * @author FW-TEAM
 * @version 20070512
 * @since   20070512
 */
if (!file_exists("../../users/datas/sb/".sb_get()."/admin_passwd")){
    echo"<script>alert('The admin password is: FrameWork');</script>\n";
    admin_setpassword("FrameWork");
}

?>
