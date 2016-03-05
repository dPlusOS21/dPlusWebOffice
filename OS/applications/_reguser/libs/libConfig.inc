<?php #20070512 http://www.framework.altervista.org/FrameWork/libs/al_00_libConfig.inc
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/**
 * File delle funzioni di sistema della libreria di configurazione
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_di_sistema_libConfig
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070423
 * @since   20070423
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */


/**
 * La routine crea un path di config
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @param string $folder Nome della cartella da creare
 */
function set_config_folder($folder){
    if (!file_exists("../../users/datas/config/".dirname($folder))){
	set_config_folder(dirname($folder));
    }
    if (!file_exists("../../users/datas/config/$folder"))
		mkdir("../../users/datas/config/$folder");
}
//--------------------------------------------------------------------------

/**
 * La routine che salva la configurazione generale: il nuovo mondo!!!!
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @param string $var Nome del File di configurazione da creare
 * @param string $default Valore di default inserito dentro il File di configurazione creato
 */
//*
function get_config($var,$default){
    if (!file_exists("../../users/datas/config/$var")){
	set_config_folder(dirname("$var"));
	$f=fopen("../../users/datas/config/$var","w");fwrite($f,$default);fclose($f);
    }
    return @join(@file("../../users/datas/config/$var"));
}
//*/
//--------------------------------------------------------------------------

/**
 * Imposta il valore in una variabile di config
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @param string $var Nome del File di configurazione da settare
 * @param string $value Valore inserito dentro il File di configurazione da settare
 */
function set_config($var,$value){
	$f=fopen("../../users/datas/config/$var","w");fwrite($f,$value);fclose($f);
}

//_______________________________________________________________________________________________________________

//queste routine caricano i parametri di configurazione settati

/**
 * Imposta il valore di settaggio relativa all'uso della libreria ahah in config
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return number Ritorna 0 se disabilitate ed 1 se abilitate
 */
function ahah_enabled(){
    if(get_config("b-ahah_enabled","")=="")
	return 0;
    else
	return 1;
}


/**
 * Richiama la modalità di DEBUG settata
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function debug(){return get_config("b-debug","0");}

/**
 * Richiama la modalità di Error Reporting settata
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function errorreporting(){return get_config("e-errorreporting","2039");}

/**
 * Richiama il Titolo settato - se non presente setta il default
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function title(){return get_config("title","FrameWork");}

/**
 * Richiama il Titolo settato - se non presente setta il default - se definito per l'utente richiama quello utente in linea
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function theme(){
  $default_theme=get_config("theme","google");
  if (defined('LIBUSER'))
    $theme=user_getkey(user_getuser(),"user_theme");
  if ($theme!="")
    return $theme;
  else
    return $default_theme;
}

/**
 * Richiama la Lingua settata - se non presente setta il default - se definito per l'utente richiama quella utente in linea
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function lang(){
  if (defined('LIBUSER'))
    $lang=user_getkey(user_getuser(),"user_lang");
  if ($lang!="")
    return substr($lang,0,2);
  else
    return get_config("lang","it");
}

/**
 * Richiama la omonima funzione
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @param constant
 */
set_config_folder("time");


/**
 * Richiama il Fuso Orario settato - se non presente setta il default
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function fuso_orario() {return get_config("time/fuso_orario","0");}


/**
 * Richiama il Formato Data settato - se non presente setta il default
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function formato_data(){return get_config("time/formato_data"," D d M Y");}


/**
 * Richiama il Formato Orario settato - se non presente setta il default
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function formato_ora(){return get_config("time/formato_ora"," H:i");}

/**
 * Richiama il Formato Data e Ora settati - se non presenti setta il default
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return string Ritorna il valore della funzione get_config agganciata
 */
function formato_data_ora(){return get_config("time/formato_data_ora"," D d M Y - H:i");}

/**
 * Richiama il Path di Base della installazione di FW
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return Percorso comprensivo di pagina index.php di avvio
 */
function base_path(){return substr( $_SERVER['PHP_SELF'], 0, strpos( $_SERVER['PHP_SELF'], "index.php" ));}
?>
