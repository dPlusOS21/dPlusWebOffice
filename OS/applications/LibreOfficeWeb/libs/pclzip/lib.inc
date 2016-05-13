<?php #20070525 http://www.framework.altervista.org/FrameWork/libs/al_05_libZip.inc
define('LIBZIP','1.00');
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

/**
 * File delle funzioni di sistema della libreria Zip
 *
 * Questo file contiene le procedure di sistema necessarie al funzionamento di FrameWork.
 *
 * NOTAZIONE: tutte le librerie il cui nome è preceduto da "al_" sono considerate da FW in AutoLoad
 *
 * @package Funzioni_opzionali_libZip
 * @author FW-TEAM <vroby.mail@gmail.com - nost.ass@gmail.com>
 * @version 20070518
 * @since   20070518
 * @copyright Copyright (c) 2006-2007
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License and GPL3
 */





// scarica le variabili che servono
$dpath=$_GET['dpath']; //echo "PERCORSO ATTUALE: ".$dpath;

$action=$_GET['action'];
$appname ="FW_Files";
$zip_op=$_GET['zip_op'];

$filename=$_GET['filename'];

	include "pclzip.lib.php";


function zippa($dpath,$filename){

	//Inizializziamo la classe
	$myzip = new iczip();

	//Addattiamo una cartella in maniera ricorsiva
	$myzip->addDirRecursive($dpath);	//percorso fisico

	//Se vogliamo possiamo addattare dei singoli file verranno posizionati nella root del file zippato
	//$myzip->addSingeFile("example/singolofile.txt");	

	//Salviamo l'archivio
	$myzip->render($filename.".zip",'save'); 

	//Se non desideriamo generare il file ma lo vogliamo salvare sul pc
	//#$myzip->render("prova.zip",'dump'); 

}

echo "Dpath: ".$dpath."<br>";
echo "Filename: ".$filename."<br>";
echo "Myzip: ".$myzip."<br>";
echo "zip_op: ".$zip_op."<br>";



?>

