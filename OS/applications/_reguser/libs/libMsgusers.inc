<?php #20070518 http://www.framework.altervista.org/FrameWork/libs/al_05_libMsgusers.inc
define('LIBMSGUSERS','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*                                                                      */
/* libMsgusers.inc Gestione Messaggi tra utenti                         */
/************************************************************************/

/** CONTA I MESSAGGI PRESENTI IN UNA DIRECTORY DA DEFINIRE QUANDO SI ****/
/** RICHIAMA LA FUNZIONE ************************************************/

/**
 * File delle funzioni di sistema della libreria Msgusers
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_opzionali_libMsgusers
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070518
 * @since   20070518
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */

/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine conta i messaggi presenti in una determinata cartella
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @return number $listmsg Numero dei messaggi presenti in cartella
 */
function messages_count($dir)
{
	$fd=opendir($dir);
	$i=0;
	while (false !== ($nf = readdir($fd))){
		if ($nf[0] != "."){
			$listmsg[$i++] = $nf;
		}
	}
	closedir($fd);
	return count($listmsg);
}


/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine elenca i messaggi presenti in una determinata cartella
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @return array $listmsg Lista dei Messaggi presenti in cartella
 */
function messages_list($dir)
{
	$fd = opendir($dir);
	$i = 0;
	while (false !== ($nf = readdir($fd))){
		if ($nf[0] != "."){
			$listmsg[$i++] = $nf;
		}
	}
	closedir($fd);

	if (count($listmsg)>0) array_multisort($listmsg,SORT_DESC);

	return $listmsg;
}



/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine ILLUSTRA IL CONTENUTO DI UN MESSAGGIO
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @param string $file messaggio da leggere
 * @return array $from, $title, $user, $body Parametri di ritorno
 */
function messages_read($dir,$file)
{
	$fp = fopen("$dir/$file","r");
	$string = fread($fp,filesize("$dir/$file"));
	fclose($fp);

	$from=get_xml_element("fm:from",$string);
	$title=get_xml_element("fm:title",$string);
	$user=get_xml_element("fm:user",$string);
	$body=get_xml_element("fm:body",$string);
	$status=get_xml_element("fm:read",$string);

	return array("from" => $from, "title" => $title, "user" => $user, "body" => $body);
}


/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine elimina un messaggio dalla temp dei messaggi ricevuti da leggere
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @param string $file messaggio da leggere
 */
function messages_red($dir,$file)
{
	unlink("$dir/received-tmp/$file.tmp");
}


/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine controlla se un messaggio è stato letto opure no
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @param string $file messaggio da leggere
 * @return string Ritorna il valore read se il messaggio è stato letto, unread se non è stato letto
 */
function messages_isred($dir,$file)
{
	if(file_exists("$dir/received-tmp/$file.tmp")) return "unread";
	else return "read";
}

/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine non è ancora definita
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function messages_write()
{

}

/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine INIA UN MESSAGGIO
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $dir Nome della cartella messaggi da trattare
 * @param string $from Da chi viene inviato il messaggio
 * @param string $to A chi viene inviato il messaggio
 * @param string $sobject Oggetto del messaggio
 * @param string $body Contenuto del messaggio
 */
function messages_send($dir,$from,$to,$sobject,$body)
{
	$body = str_replace("\r","",$body);
	$body = str_replace("\n","<br>",$body);

	if (!file_exists("$dir/$to"))mkdir("$dir/$to",0755);
	if (!file_exists("$dir/$to/received"))mkdir("$dir/$to/received",0755);
	if (!file_exists("$dir/$to/received-tmp"))mkdir("$dir/$to/received-tmp",0755);
	if (!file_exists("$dir/$from/sent"))mkdir("$dir/$from/sent",0755);

	$fp = fopen("$dir/$to/received/".time().".xml","w");

	fwrite($fp,"<?xml version='1.0'?>
		<!DOCTYPE fm:messages SYSTEM \"../messages.dtd\">
		<fm:messages xmlns:fl=\"http://www.tecnoacquisti.com/news\">
			<fm:from>$from</fm:from>
			<fm:title>$sobject</fm:title>
			<fm:user>$from</fm:user>
			<fm:body>$body</fm:body>
			<fm:read>no</fm:read>
		</fm:messages>");

	fclose($fp);

	$fptmp = fopen("$dir/$to/received-tmp/".time().".xml.tmp","w");
	fclose($fptmp);

	$fp = fopen("$dir/$from/sent/".time().".xml","w");

	fwrite($fp,"<?xml version='1.0'?>
		<!DOCTYPE fm:messages SYSTEM \"../messages.dtd\">
		<fm:messages xmlns:fl=\"http://www.tecnoacquisti.com/news\">
			<fm:from>$from</fm:from>
			<fm:title>$sobject</fm:title>
			<fm:user>$to</fm:user>
			<fm:body>$body</fm:body>
		</fm:messages>");

	fclose($fp);
}

/**
 ***************************************************************************
 * messages function    ****************************************************
 ***************************************************************************
 * La routine elimina un determinato messaggio
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 * @param string $file messaggio da eliminare
 */
function messages_delete($file)
{
	unlink($file);
}

?>
