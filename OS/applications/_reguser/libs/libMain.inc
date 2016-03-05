<?php #20070612 http://www.framework.altervista.org/FrameWork/libs/al_01_libMain.inc
define('LIBMAIN','1.00');

/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*                                                                      */
/* libMain.inc configuration                                            */
/************************************************************************/

/**
 * File delle funzioni di sistema della libreria Main
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libMain
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070422
 * @since   20070422
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */

/**
 ***************************************************************************
 * file-system function ****************************************************
 ***************************************************************************
 * La rutine crea un path generico sul server attivo partendo da root
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $folder Nome della cartella da creare
 */
function set_folder($folder){
    if (!file_exists(dirname($folder))){
	set_folder(dirname($folder));
    }
    if (!file_exists($folder))
		mkdir($folder);
}


/**
 * La funzione elimina un intero albero di directory eliminando anche i file presenti all'interno
 *
 * La funzione è Ricorsiva
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $path Percorso di partenza x la Eliminazione Tree (Funzione mancante in PHP)
 */
function deltree($path){
    if (file_exists($path)){
	$fd=opendir($path);
	while (false !== ($nf= readdir($fd))){
	    if ($nf !=".." && $nf !="."){
		if (is_dir("$path/$nf")){
		    deltree("$path/$nf");// ricorsione
		}
		else{
		    unlink ("$path/$nf");
		}
	    }
	}
	fclose($fd);
	rmdir($path);//BUG: non cancella con windows!!!!
    }
}



/**
 * La funzione copia un intero albero di directory in modo ricorsivo nel nuovo path
 *
 * La funzione è Ricorsiva
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $path Percorso di partenza
 * @param string $path Percorso di destinazione
 */
function copytree($source,$dest){
    if (file_exists($source)){
	if(!file_exists($dest)) mkdir("$dest",0777);
	$fd=opendir($source);
	while (false !== ($nf= readdir($fd))){
	    if ($nf !=".." && $nf !="."){
		if (is_dir("$source/$nf")){
		    copytree("$source/$nf","$dest/$nf");// ricorsione
		}
		else{
		    copy("$source/$nf","$dest/$nf");
		}
	    }
	}
	fclose($fd);
    }
}




/**
 * error-all function *******************************************************
 * La funzione restituisce il valore di un array se esiste la chiave altrimenti una stringa vuota
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $array Array passato
 * @param string $key Chiave passata
 * @return array Ritorna lo stesso array caricato oppure stringa vuota
 */
function array_keyval($array,$key){
    $ret="";
    if (array_key_exists($key,$array))
	$ret=$array[$key];
    return $ret;
}



/**
 * La funzione definisce una costante se non esiste
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $name Nome della Costante da definire
 * @param string $value Valore della Costante da definire
 * @return costant Ritorna la variabile definita
 * @return number Ritorna il valore -1 se la costante è già stata definita in precedenza
 */
function define_once($name, $value , $case_insensitive=false){
    if (!defined($name))
	return define($name,$value,$case_insensitive);
    else
	return -1;
}



/**
 * security box *********************************************************
 * La funzione restituisce il percorso della security box. se la sb non esiste allora la crea
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @return string $sbdir Nome del percorso della security box
 */
function sb_get($utente_tmp){
    if (!file_exists("../../users/$utente_tmp"))mkdir("../../users/$utente_tmp",0755);
    $hdir=opendir("../../users/$utente_tmp");
    while (false !== ($f= readdir($hdir)))
      if ($f[0]!='.' && $f!="index.php") $sbdir=$f;
    closedir($hdir);
  if ($sbdir==""){
    $sbdir=rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000)."-".rand(1000,9000);
    echo $sbdir;
    mkdir("../../users/$utente_tmp/".$sbdir,0755);
    $fp=fopen("../../users/$utente_tmp/index.php","a");
    fwrite($fp,"\n");
    fclose($fp);
  }
  return $sbdir;
}



/**
 * La funzione aumenta la sicurezza delle chiavi md5
 *
 * @author FW-TEAM
 * @version 20070611
 * @since   20070611
 * @param string $string Valore da criptare con o xmd5 oppure xsha1
 * @param string $criptsys Valore selezione tipo di criptazione con o xmd5 oppure xsha1
 * @return string Ritorna il Valore criptato della stringa passata come parametro
 */
function xcrypt($string){
$criptsys=get_config("criptsys","md5");
if ($criptsys=="md5") {return xmd5($string);}
if ($criptsys=="sha1") {return xsha1($string);}

}



/**
 * La funzione aumenta la sicurezza delle chiavi md5
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $string Valore da criptare in MD5
 * @return string $r Ritorna il Valore criptato della stringa passata come parametro
 */
function xmd5($string){
    $l=strlen($string);
    $r=$string;
    for($i=0;$i<$l;$i++){
	$r=md5($r);
	if ($i==($l/3))$r=strrev($r);
    }
    return $r;
}



/**
 * La funzione aumenta la sicurezza delle chiavi SHA1
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $string Valore da criptare in SHA1
 * @return string $r Ritorna il Valore criptato della stringa passata come parametro
 */
function xsha1($string){
    $l=strlen($string);
    $r=$string;
    for($i=0;$i<$l;$i++){
	$r=sha1($r);
	if ($i==($l/3))$r=strrev($r);
    }
    return $r;
}


/**
 * facility ***************************************************************
 * La funzione verifica se esiste il foglio di stile nel blocco/applicazione e lo carica
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $path Valore del percorso del foglio di stile cercato
 */
function autostyle($path){
    if (file_exists("$path/style.css"))
	echo "<style>@import url($path/style.css);</style>";
}



?>
