<?php #20070515 http://www.framework.altervista.org/FrameWork/libs/al_04_libGroup.inc
define('LIBGROUP','1.00');
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
 * File delle funzioni di sistema della libreria dei Gruppi
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libGroup
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070515
 * @since   20070515
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */

/**
 * impostazioni groups
 *
 * La routine crea un gruppo
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $group Variabile che contiene il nome del Gruppo da creare
 */
function group_create($group){
    if (!file_exists("datas/sb/".sb_get()."/group")){
	mkdir("datas/sb/".sb_get()."/group",0755);
	mkdir("datas/sb/".sb_get()."/group/groups",0755);
	mkdir("datas/sb/".sb_get()."/group/users",0755);
    }
    if (!file_exists("datas/sb/".sb_get()."/group/groups/$group")){
	$fp=fopen("datas/sb/".sb_get()."/group/groups/$group","w");
	fclose($fp);
    }
}


/**
 * impostazioni groups
 *
 * La routine rimuove un gruppo
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $group Variabile che contiene il nome del Gruppo da rimuovere
 */
function group_delete($group){
    if (file_exists("datas/sb/".sb_get()."/group/groups/$group")){
	unlink("datas/sb/".sb_get()."/group/groups/$group");
    }
}


/**
 * impostazioni groups
 *
 * La routine verifica se quel user e' del gruppo
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $group Variabile che contiene il nome del Gruppo da verificare
 * @param string $user Variabile che contiene il nome utente del Gruppo da verificare
 * @return number Valore 1 Utente presente nel Gruppo - 0 Utente Non presente nel Gruppo
 */
function group_getusergroup($group,$user){
    group_create($group);
    if (file_exists("datas/sb/".sb_get()."/group//groups/$group")){
	foreach(@file("datas/sb/".sb_get()."/group/groups/$group") as $l){
	    if ($l==$user."\n")
		return 1;
	}
    }
    return 0;
}


/**
 * impostazioni groups
 *
 * La routine verifica se quel gruppo e' dell'user
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $user Variabile che contiene il nome utente del Gruppo da verificare
 * @param string $group Variabile che contiene il nome del Gruppo da verificare
 * @return number Valore 1 Gruppo appartenente a Utente - 0 Gruppo Non appartenente ad Utente
 */
function group_getgroupuser($user,$group){
    group_create($group);
    if (file_exists("datas/sb/".sb_get()."/group/users/$user")){
	foreach(@file("datas/sb/".sb_get()."/group/users/$user") as $l){
	    if ($l==$group."\n")
		return 1;
	}
    }
    return 0;
}


/**
 * impostazioni groups
 *
 * La routine elenca i gruppi a cui e' iscritto l'user
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $user Variabile che contiene il nome utente del Gruppo da verificare
 * @return array Elenco dei Gruppi di iscrizione Utente
 */
function group_usergroups($user){
    return @file("datas/sb/".sb_get()."/group/users/$user");
}


/**
 * impostazioni groups
 *
 * La routine aggiunge un user al gruppo e aggiunge il gruppo all'elenco dell'user
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $user Variabile che contiene il nome Utente da aggiungere
 * @param string $group Variabile che contiene il nome del Gruppo da aggiungere
 */
function group_adduser($user,$group){
    if (group_getusergroup($group,$user)==0 && $user!="" && $group!=""){
	$fp=fopen("datas/sb/".sb_get()."/group/groups/$group","a");
	fwrite($fp,$user."\n");
	fclose($fp);
    }
    if (group_getgroupuser($user,$group)==0 && $user!="" && $group!="" ){
	$fp=fopen("datas/sb/".sb_get()."/group/users/$user","a");
	fwrite($fp,$group."\n");
	fclose($fp);
    }
}



/**
 * impostazioni groups
 *
 * La routine rimuove un user dal gruppo
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @param string $user Variabile che contiene il nome dell'User da rimuovere
 * @param string $group Variabile che contiene il nome del Gruppo da cui rimuovere l'User
 */
function group_removeuser($user,$group){
    if (group_getusergroup($group,$user) && $user!="" && $group!="" ){
	$list=@file("datas/sb/".sb_get()."/group/groups/$group");
	$fp=fopen("datas/sb/".sb_get()."/group/groups/$group","w");
	foreach($list as $l){
	    if($l!=$user."\n"){
		fwrite($fp,$l);
	    }
	}
	fclose($fp);
    }
    if (group_getgroupuser($user,$group) && $user!="" && $group!=""){
	$list=@file("datas/sb/".sb_get()."/group/users/$user");
	$fp=fopen("datas/sb/".sb_get()."/group/users/$user","w");
	foreach($list as $l){
	    if($l!=$group."\n"){
		fwrite($fp,$l);
	    }
	}
	fclose($fp);
    }


}


/**
 * impostazioni groups
 *
 * La routine elenca i gruppi
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 */
function group_listgroups(){
    $fd=opendir("datas/sb/".sb_get()."/group/groups");
    $i=0;
    while (false !== ($nf= readdir($fd))){
      if ($nf[0]!="."){
          $listgroups[$i++]=$nf;
      }
    }
      closedir($fd);
    return $listgroups;
}


/**
 * impostazioni groups
 *
 * La routine conta i gruppi
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 * @return number $i Numero dei Gruppi
 */
function group_countgroups(){
    $fd=opendir("datas/sb/".sb_get()."/group/groups");
    $i=0;
    while (false !== ($nf= readdir($fd)))if($nf[0]!='.')$i++;
    closedir($fd);
    return $i;
}



/**
 * impostazioni groups
 *
 * La routine effettua la gestione operazioni gruppi
 *
 * @author FW-TEAM
 * @version 20070515
 * @since   20070515
 */

$group_op=$_GET['group_op'];

//la gestione grupppi e' a  carico dell'amministratore
if (admin_isadmin()){
    if ($group_op !=""){
	if (!file_exists("datas/sb/".sb_get()."/group")){
	    mkdir("datas/sb/".sb_get()."/group",0755);
	    mkdir("datas/sb/".sb_get()."/group/groups",0755);
	    mkdir("datas/sb/".sb_get()."/group/users",0755);
	}

	switch ($group_op){

	    case "create":
		$group=$_GET['group'];
		group_create($group);
	    break;

	    case "delete":
		$group=$_GET['group'];
		group_delete($group);
	    break;

	    case "adduser":
		$group=$_GET['group'];
		$user=$_GET['user'];
		group_adduser($user,$group);
	    break;

	    case "removeuser":
		$group=$_GET['group'];
		$user=$_GET['user'];
		group_removeuser($user,$group);
	    break;

	}
    }
}
?>
