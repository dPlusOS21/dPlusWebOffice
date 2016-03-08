<?php
define('BLOCKIP','1.00');

/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

//la directory dei submit
global $updatefiles;

$updatefiles="../../users/".$utente."/".$cartella."/LibreOfficeWebData/"."none_updatefiles";

// la dimensione massima di un file
$maxFileSize=20000000;

//echo ini_get('upload_max_filesize'), ", " , ini_get('post_max_size');


// scarica le variabili che servono
$dpath=$_GET['dpath']; //echo "PERCORSO ATTUALE: ".$dpath;

$action=$_GET['action'];
$appname ="LibreOfficeWeb";
$zip_op=$_GET['zip_op'];

$filename=$_GET['filename'];

// test da abilitare con variabili di controllo solo al bisogno
// ----------------------------------------------------------------------------------//
// echo "<h3>Nome applicazione: ".$appname."</h3><br>";
// echo "<h3>Nome applicazione Senza nulla: ".sec_title($appname)."</h3><br>";
// echo "<h3>Path: ".$dpath."</h3><br>";
// echo "<h3>Path dei files da aggiornare - updatefiles: ".$updatefiles."</h3><br>";
// echo "<h3>Updatedir: ".$updatedir."</h3><br>";
// ----------------------------------------------------------------------------------//

//caricamento condizionale del "pesante" modulo ziplib
//*
if ($zip_op=="zipdir"){
	include "../../applications/$appname/libs/libArchivedir/lib.inc";
	zipdir($dest.$filename.".zip",$dpath.$filename);
	copy($dest.$filename.".zip",$updatefiles."/".$filename.".zip");
	unlink($dest.$filename.".zip");
}

$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];
$appname ="LibreOfficeWeb";

//carica la lingua se esiste
$lang="";
switch($lang){
    case "en":
	define("_COMBOMENU","Other .....");
	break;
    default:
	define("_COMBOMENU","Altro .....");
	break;
}

//admin block
//carica la lingua se esiste
$lang="";
switch($lang){
    case "en":
	define("_AMMINISTRA","Admin Console");
	define("_ADMIN","Admin Block");
	define("_MODIFICA_IMPOSTAZIONI","Setting");
	break;
    default;
	define("_AMMINISTRA","Pannello Admin");
	define("_ADMIN","Blocco Admin");
	define("_MODIFICA_IMPOSTAZIONI","Impostazioni");
	define("_SEARCH","Cerca File");
	define("_ADD_FOLDER","Agg.Cartella");
	define("_ADD_FILE","Agg.File");
	define("_ADD_LINK_WEB","Agg.Link Web");
	define("_ADD_LINK_EMBED","Agg.Link Embed");
	define("_WELCOME","Benvenuto");
	break;
}

/* ip block */

$dpath=$_GET["dpath"];

$actionlink="index.php?dpath=$dpath";
?>
<html>
	<head>
<meta name="theme-color" content="#FFD700">
		<meta charset="utf-8">
	<!--	<meta name="viewport" content="width=device-width,initial-scale=1.0"> -->
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<script src="../../js/jquery.min.js"></script>
	</head>
<style>
body {
        margin: 0;
}

.pushmenu {
        background: #3c3933;
        font-family: Arial, Helvetica, sans-serif;
        position: fixed;
        width: 80px;
        height: 100%;
        top: 0;
        z-index: 1000;
	overflow: auto;
}
 
.pushmenu h3 {
        color: #cbbfad;
        font-size: 14px;
        font-weight: bold;
        padding: 15px 20px;
        margin: 0;
        background: #282522;    
        height: 16px;
}
 
.pushmenu a {
        display: block;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-top: 1px solid #57544e;
        border-bottom: 1px solid #312e2a;
        padding: 14px;
}
 
.pushmenu a:hover {
        background:258ecd;      
}
 
.pushmenu a:active {
        background: #454f5c;
        color: #fff;    
}
 
.pushmenu-left {
        left: -80px;   
}
 
.pushmenu-left.pushmenu-open {
        left: 0px;      
}
 
.pushmenu-push {
        overflow-x: hidden;
        position: relative;
        left: 0;        
}
 
.pushmenu-push-toright {
        left: 80px;    
}
 
/*Transition*/
.pushmenu, .pushmenu-push {
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        transition: all 0.3s ease;      
}
 
#nav_list {
//        background: url(images/menu.png) no-repeat left top;
        cursor: pointer;
//        height: 27px;
//        width: 33px;
        text-indent: -99999em;  
}
 
#nav_list.active {
        background-position: -33px top; 
}
 
.buttonset {
        background: linear-gradient(center top , #6b85b3, #334d86);
        background:-moz-linear-gradient(center top , #6b85b3, #334d86);
    background: -webkit-gradient(linear, center top, center bottom, from(#6b85b3), to(#334d86));
        height: 16px;
        padding: 10px 20px 20px;
}
 
section.content {
        font-family: Arial, Helvetica, sans-serif;
//        padding: 10px 20px;     
}
</style>

<!-- Adeguamento alla coesistenza di jquery con prototype library -->
	<script type=”text/javascript”>
//		JQ = jQuery.noConflict();
	</script>
<!------------------------------------------------------------------>

<script>
//<!-- Adeguamento alla coesistenza di jquery con prototype library -->
//	JQ = jQuery.noConflict(); // metodo non verificato
	JQ = $;  //rename $ function
// si devono sostituire tutte le chiamate a jq con la variabile JQ
//<!------------------------------------------------------------------>
        JQ(document).ready(function() {
                $menuLeft = JQ('.pushmenu-left');
                $nav_list = JQ('#nav_list');
                $nav_list1 = JQ('#nav_list1');


                $nav_list.click(function() {
                        JQ(this).toggleClass('active');
                        JQ('.pushmenu-push').toggleClass('pushmenu-push-toright');
                        $menuLeft.toggleClass('pushmenu-open');
                });
                $nav_list1.click(function() {
                        JQ(this).toggleClass('active');
                        JQ('.pushmenu-push').toggleClass('pushmenu-push-toright');
                        $menuLeft.toggleClass('pushmenu-open');
                });
        });
</script>
<!--------------------------------------------------------------------------------------------------------->
<script>
//----------------------------------------------------------------------------------------------------------
// setting iniziale stato linea (online)
	localStorage.setItem('statolinea', 'on');
//----------------------------------------------------------------------------------------------------------
</script>
<!--
Copyright 2011 Google Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Author: Eric Bidelman (ericbidelman@chromium.org)
-->

<style>

#connection {
  font: 20px Arial, sans-serif;
/*  text-transform: uppercase; */
/*  font-weight: bold;
  vertical-align: middle;
  -webkit-text-stroke: 0;
  -moz-text-stroke: 0;
  color: transparent;
  -webkit-background-clip: text;
  -moz-background-clip: text;
  background-color: rgba(55,96,117,1);
  text-shadow: rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.4) 1px 3px 3px;
  border: 2px solid black;
  border-radius: 25px;
  padding: 25px; */
}
#connection div {
  display: inline-block;
  background-color: orange;
  width: 20px;
  height: 20px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  margin-left: 10px;
  -webkit-animation-duration: 2.5s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -moz-animation-duration: 2.5s;
  -moz-animation-iteration-count: infinite;
  -moz-animation-timing-function: linear;
  -o-animation-duration: 2.5s;
  -o-animation-iteration-count: infinite;
  -o-animation-timing-function: linear;
}
#connection.connected {
/*  background-color: rgba(0, 55, 0, 1); 
  border-color: green;
  -webkit-box-shadow: 0 0 50px 0 #bbb;
  -moz-box-shadow: 0 0 50px 0 #bbb;
  -ms-box-shadow: 0 0 50px 0 #bbb;
  -o-box-shadow: 0 0 50px 0 #bbb;
  box-shadow: 0 0 50px 0 #bbb;*/
}
#connection.connected div {
  background-color: green;
  -webkit-box-shadow: rgba(0, 255, 0, 0.5) 0px 0px 5px;
  -moz-box-shadow: rgba(0, 255, 0, 0.5) 0px 0px 5px;
  -o-box-shadow: rgba(0, 255, 0, 0.5) 0px 0px 5px;
  -ms-box-shadow: rgba(0, 255, 0, 0.5) 0px 0px 5px;
  box-shadow: rgba(0, 255, 0, 0.5) 0px 0px 5px;
  -webkit-animation-name: glowGreen;
  -moz-animation-name: glowGreen;
  -ms-animation-name: glowGreen;
  -o-animation-name: glowGreen;
}
#connection.disconnected {
/*  background-color: rgba(55, 0, 0, 1);
  border-color: red;
  -webkit-box-shadow: 0 0 50px 0 #bbb;
  -moz-box-shadow: 0 0 50px 0 #bbb;
  -ms-box-shadow: 0 0 50px 0 #bbb;
  -o-box-shadow: 0 0 50px 0 #bbb;
  box-shadow: 0 0 50px 0 #bbb; */
}
#connection.disconnected div {
  background-color: red;
  -webkit-box-shadow: rgba(255, 0, 0, 0.5) 0px 0px 5px;
  -moz-box-shadow: rgba(255, 0, 0, 0.5) 0px 0px 5px;
  -ms-box-shadow: rgba(255, 0, 0, 0.5) 0px 0px 5px;
  -o-box-shadow: rgba(255, 0, 0, 0.5) 0px 0px 5px;
  box-shadow: rgba(255, 0, 0, 0.5) 0px 0px 5px;
  -webkit-animation-name: glowRed;
  -moz-animation-name: glowRed;
}
p {
  margin-top: 2em;
}
</style>

<div id="connection" style="position:fixed; top:20px; right:20%; z-index: 30; " >Connecting...<div></div></div>
<script>

function updateConnectionStatus(msg, connected) {
  var el = document.querySelector('#connection');
  if (connected) {
    if (el.classList) {
      el.classList.add('connected');
      el.classList.remove('disconnected');
    } else {
      el.addClass('connected');
      el.removeClass('disconnected');
    }
  } else {
    if (el.classList) {
      el.classList.remove('connected');
      el.classList.add('disconnected');
    } else {
      el.removeClass('connected');
      el.addClass('disconnected');
    }
  }
  el.innerHTML = msg + '<div></div>';
}

window.addEventListener('load', function(e) {
  if (navigator.onLine) {
//    updateConnectionStatus('Online', true);
    updateConnectionStatus('', true);
  } else {
//    updateConnectionStatus('Offline', false);
    updateConnectionStatus('', false);
  }
}, false);

window.addEventListener('online', function(e) {
//  updateConnectionStatus('Online', true);
  updateConnectionStatus('', true);
	localStorage.setItem('statolinea', 'on');
  // Get updates from server.
}, false);

window.addEventListener('offline', function(e) {
//  updateConnectionStatus('Offline', false);
  updateConnectionStatus('', false);
	localStorage.setItem('statolinea', 'off');
  // Use offine mode.
}, false);
</script>
<!--------------------------------------------------------------------------------------------------------->
 
<body class="pushmenu-push">
<nav class="pushmenu pushmenu-left">
<input type='image' src="../../applications/<?=$appname;?>/images/menu.png" id="nav_list1" border=0 WIDTH="40" HEIGHT="40" hspace="10" vspace="10"  align="left" /><br><br><br><br>
    <a href="index.php?action=search"><input type='image' src="../../applications/<?=$appname;?>/images/search.png" onclick="javascript: location.href='index.php?action=search';" title="[<?=_SEARCH?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_dir"><input type='image' src="../../applications/<?=$appname;?>/images/folder-add.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_dir';" title="[<?=_ADD_FOLDER?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_file"><input type='image' src="../../applications/<?=$appname;?>/images/uploads-file.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
<!--    <a href="Writer/index.php?dpath=<?=$dpath;?>&action=add_new_file_docx"><input type='image' src="../../applications/<?=$appname;?>/none_images/docx.png" onclick="javascript: location.href='Writer/index.php?dpath=<?=$dpath;?>&action=add_new_file_docx';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a> -->
<?php
echo "<a><input type='image' src='../../applications/$appname/none_images/docx.png' onclick=\"javascript: getElementById('progetto').value=prompt('nome progetto','Nuovo Documento'); if (getElementById('progetto').value != 'Nuovo Documento') { newdocx.submit();};\" title=\"["._ADD_FILE."]\" border=0 WIDTH=\"32\" HEIGHT=\"32\" /></a>";
echo "<form id='newdocx' name='newdocx' action='Writer/index.php?dpath=$dpath&progetto=$progetto&action=add_new_file_docx' method='post'>";
echo "<input type='hidden' name='progetto' id='progetto' value=''>";
echo "</form>";
?>
    <a href="Calc/index.php?&action=addnewfilexlsx"><input type='image' src="../../applications/<?=$appname;?>/none_images/xlsx.png" onclick="javascript: location.href='Calc/index.php?&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=addnewfileodg"><input type='image' src="../../applications/<?=$appname;?>/none_images/odg.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=addnewfileodb"><input type='image' src="../../applications/<?=$appname;?>/none_images/odb.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>

    <a href="<?=$actionlink;?>&action=add_link"><input type='image' src="../../applications/<?=$appname;?>/images/insert-link.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_link';" title="[<?=_ADD_LINK_WEB?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="/WEB_DESKTOP/OS/applications/_reguser/index.php?user_op=modavatar"> <input type='image' src="../../applications/<?=$appname;?>/images/setting.png" onclick="javascript: location.href='/WEB_DESKTOP/OS/applications/_reguser/index.php?user_op=modavatar';" title="<?=_MODIFICA_IMPOSTAZIONI?>" border=0 WIDTH="32" HEIGHT="32" /></a>

</nav>
 
</body>


<style>
div.ipuser
{
	border: 1px solid #CCC;
	margin-bottom: 0px;
	padding: 5px;
	color: #FFF;
	background-color: LIGHTGRAY;
	font-size: 12px;
}

/* Classe per la barra indirizzo (location) */

span.location
{
	border: 1px solid #f0f0f0;
	margin-bottom: 1px;
	padding: 0px;
	color: #000000;
	background-color: #f8f8f8;
	font-size: 12px;
	width:100%;
	height: 100%;
	vertical-align:middle;
	position:inline;
}

.location button {
	border: 1px solid #FF3333;
	border-radius: 3px 30px 30px 3px;
	padding-top:10px;
	padding-bottom:10px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EE4444;
	text-decoration:none;
	color: #FFFFFF;
	font-weight:bold;
	font-size: 12px;
}

.location button:hover {
	border: 1px solid #FF0000;
	border-radius: 3px 30px 30px 3px;
	padding-top:10px;
	padding-bottom:10px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EE2222;
	color: #FFFFFF;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}
.location a:link {
	border: 1px solid #AAAAAA;
	border-radius: 3px 30px 30px 3px;
	padding-top:10px;
	padding-bottom:10px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #0094FF;
	color: #444444;
	text-decoration:none;
	font-weight:bold;
	font-size: 10px;
}

.location a:visited {
	border: 1px solid #AAAAAA;
	border-radius: 3px 30px 30px 3px;
	padding-top:10px;
	padding-bottom:10px;
	padding-right:25px;
	padding-left:25px;	
	background-color:#0094FF;
/*	background-color:#4DCE16; */
	color: #444444;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}


.location a:hover {
	border: 1px solid #333333;
	border-radius: 3px 30px 30px 3px;
	padding-top:10px;
	padding-bottom:10px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EEEEEE;
	color: #111111;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}


/*classe per la cosmetica */

span.cosmetica
{
	border: 1px solid #f0f0f0;
	margin-bottom: 1px;
	padding: 0px;
	color: #000000;
	background-color: #f8f8f8;
	font-size: 12px;
	width:100%;
	height: 100%;
	vertical-align:middle;
	position:inline;
}

.cosmetica button {
	border: 1px solid #FF3333;
	border-radius: 3px 3px 3px 3px;
	padding-top:8px;
	padding-bottom:8px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EE4444;
	color: #FFFFFF;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica button:hover {
	border: 1px solid #FF0000;
	border-radius: 3px 3px 3px 3px;
	padding-top:8px;
	padding-bottom:8px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EE2222;
	color: #FFFFFF;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica submit {
	border: 1px solid #3333FF;
	border-radius: 3px 3px 3px 3px;
	padding-top:8px;
	padding-bottom:8px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #4444EE;
	color: #FFFFFF;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica submit:hover {
	border: 1px solid #0000FF;
	border-radius: 3px 3px 3px 3px;
	padding-top:8px;
	padding-bottom:8px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #2222EE;
	color: #FFFFFF;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica a:link {
	border: 1px solid #AAAAAA;
/*	border-radius: 3px 3px 3px 3px; */
	padding-top:9px;
	padding-bottom:9px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EEEEEE;
	color: #444444;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica a:visited {
	border: 1px solid #AAAAAA;
/*	border-radius: 3px 3px 3px 3px; */
	padding-top:9px;
	padding-bottom:9px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EEEEEE;
	color: #444444;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}


.cosmetica a:hover {
	border: 1px solid #333333;
/*	border-radius: 3px 3px 3px 3px; */
	padding-top:9px;
	padding-bottom:9px;
	padding-right:25px;
	padding-left:25px;	
	background-color: #EEEEEE;
	color: #111111;
	text-decoration:none;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica input {
	border: 1px solid #AAAAAA;
	border-radius: 5px 5px 5px 5px;
	margin-bottom: 10px;
	background-color: #EEEEEE;
	color: #444444;
	font-weight:bold;
	font-size: 12px;
	vertical-align: middle;
}

.cosmetica input:hover {
	border: 1px solid #333333;
	border-radius: 3px 3px 3px 3px;
	margin-bottom: 10px;
	background-color: #EEEEEE;
	color: #111111;
	font-weight:bold;
	font-size: 12px;
}

.cosmetica select {
	border: 1px solid #AAAAAA;
	border-radius: 5px 5px 5px 5px;
	padding-top:2px;
	padding-bottom:2px;
	padding-right:10px;
	padding-left:10px;	
	background-color: #CCCCCC;
	color: #444444;
	font-size: 12px;
}

.cosmetica select:hover {
	border: 1px solid #444444;
	border-radius: 5px 5px 5px 5px;
	padding-top:2px;
	padding-bottom:2px;
	padding-right:10px;
	padding-left:10px;	
	background-color: #CCCCCC;
	color: #111111;
	font-size: 12px;
}

</style>


  <!-- Caricamento Windows in stile Desktop

  <link href="../../../themes/default.css" rel="stylesheet" type="text/css"/>	
  <link href="../../../themes/lighting.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/mac_os_x.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/alert.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/alert_lite.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/alphacube.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/darkX.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/mac_os_x_dialog.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/nuncio.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/spread.css" rel="stylesheet" type="text/css"/>
  <link href="../../../themes/viewlink.css" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="../../js/javascripts/prototype.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/effects.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/window.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/window_effects.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/window_ext.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/debug.js"> </script>
  <script type="text/javascript" src="../../js/javascripts/dragdrop.js"> </script>

 -->

  <!-- Caricamento librerie gestione files .AMR 
	<script src="../../js/amr/lib/pcmdata.min.js"></script>-->
	
	<!-- Development 		
	<script src="../../js/amr/src/libamr-nb.js"></script>
	<script src="../../js/amr/src/util.js"></script>
	<script src="../../js/amr/src/amr.js"></script>
	<script src="../../js/amr/src/decoder.js"></script>
	<script src="../../js/amr/src/encoder.js"></script>
	
	<script src="../../js/amr/io.js"></script>		-->		
  <!-- Caricamento librerie gestione files .AMR -->

<script>
//----------------------------------------------------------------------------------------------------------
function visualizza(viewlink){
var trovapdf = viewlink.indexOf("pdf"); // Ricerca un carattere nella stringa
var trovaodp = viewlink.indexOf("odp"); // Ricerca un carattere nella stringa
var trovaods = viewlink.indexOf("ods"); // Ricerca un carattere nella stringa
var trovaodt = viewlink.indexOf("odt"); // Ricerca un carattere nella stringa
var trovaodg = viewlink.indexOf("odg"); // Ricerca un carattere nella stringa
var trovadoc = viewlink.indexOf("doc"); // Ricerca un carattere nella stringa
var trovaxls = viewlink.indexOf("xls"); // Ricerca un carattere nella stringa
var trovadocx = viewlink.indexOf("docx"); // Ricerca un carattere nella stringa
var trovaxlsx = viewlink.indexOf("xlsx"); // Ricerca un carattere nella stringa
var trovappt = viewlink.indexOf("ppt"); // Ricerca un carattere nella stringa
//var trovamdb = viewlink.indexOf("mdb"); // Ricerca un carattere nella stringa
//if ((trovapdf != -1) || (trovaodp != -1) || (trovaods != -1) || (trovaodt != -1) || (trovaodg != -1) || (trovadoc != -1) || (trovaxls != -1) || (trovadocx != -1) || (trovaxlsx != -1) || (trovappt != -1) || (trovamdb != -1))
if ((trovapdf != -1) || (trovaodp != -1) || (trovaods != -1) || (trovaodt != -1) || (trovaodg != -1) || (trovadoc != -1) || (trovaxls != -1) || (trovadocx != -1) || (trovaxlsx != -1) || (trovappt != -1))
{
    //window.alert("Il carattere è presente: "+viewlink+""); // trovato
var params = [
    'scrollbars=no',
    'status=no',
    'menubar=no',
    'toolbar=no',
    'height='+screen.height,
    'width='+screen.width,
    'fullscreen=yes' // only works in IE, but here for completeness
].join(',');
     // and any other options from
     // https://developer.mozilla.org/en/DOM/window.open
var popup = window.open(viewlink, '', params); 
popup.moveTo(0,0);
}
else
{
    //window.alert("Il carattere non è presente"); // non trovato
 var visualizza = new Window({className: "viewlink", blurClassName: "viewlink", title: " Files Viewer", bottom:0, width:500, height:300, top: 0, left:0}); 
     visualizza.setURL(""+viewlink+"");
     visualizza.setStatusBar("Files Viewer");
//     winWord.showCenter();
     visualizza.setZIndex(1000);
     visualizza.maximize();
     visualizza.show(true);
 } 
}
//----------------------------------------------------------------------------------------------------------
function audiocontrol(filename){
    if(    document.getElementById("divplayer"+filename).style.display!='none'){
    document.getElementById("divplayer"+filename).style.display='none';
    document.getElementById("divdownloadfile"+filename).style.display='inline';
    }
    else{
    document.getElementById("divplayer"+filename).style.display='inline';
    document.getElementById("divdownloadfile"+filename).style.display='none';
    }
}
//----------------------------------------------------------------------------------------------------------
function amraudiocontrol(filename){
localStorage.setItem('filename', filename);
    if(    document.getElementById("amrdivplayer"+filename).style.display!='none'){
    document.getElementById("amrdivplayer"+filename).style.display='none';
    document.getElementById("divdownloadfile"+filename).style.display='inline';
	localStorage.setItem('filename', filename);
    }
    else{
    document.getElementById("amrdivplayer"+filename).style.display='inline';
    document.getElementById("divdownloadfile"+filename).style.display='none';
	localStorage.setItem('filename', filename);
    }
}
//----------------------------------------------------------------------------------------------------------
function servicecontrol(filename){
    if(    document.getElementById("divservice"+filename).style.display!='none'){
    document.getElementById("divservice"+filename).style.display='none';
    document.getElementById("divtipofile"+filename).style.display='inline';
    document.getElementById("divdownloadfile"+filename).style.display='inline';
    document.getElementById("divplayer"+filename).style.display='none';
    document.getElementById("divradiostreamfile"+filename).style.display='none';
    }
    else{
    document.getElementById("divservice"+filename).style.display='inline';
    document.getElementById("divtipofile"+filename).style.display='none';
    document.getElementById("divdownloadfile"+filename).style.display='none';
    document.getElementById("divplayer"+filename).style.display='none';
    document.getElementById("divradiostreamfile"+filename).style.display='none';
    }
}
//----------------------------------------------------------------------------------------------------------
function locationcontrol(){
    if(    document.getElementById("divlocation").style.display!='none'){
    document.getElementById("divlocation").style.display='none';
    }
    else{
    document.getElementById("divlocation").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------


</script>


<div class="ipuser" style="position:fixed; top: 0px; left: 0px; width:100%; z-index: 20;">


<?php
define('BLOCKIP','1.00');

/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



//$theme=theme();

//user login block
//carica la lingua se esiste
$lang="it";
switch($lang){
    case "en":
	define("_USER_LOGIN","User Login");
	define("_USER","User");
	define("_PASSWORD","Password");
	define("_PER_ENTRARE","For enter");
	define("_EMAIL_PASSW_FORWARD","Password by E-Mail Forward ");
	define("_REGISTRATI","please register");
	define("_WELCOME","Welcome");
	define("_MODIFICA_IMPOSTAZIONI","setup");
	define("_REMEMBER_PASSWORD","Remember my Password");
	define("_SECURITYCODE","Security Code");
	define("_EXIT","Exit");
	define("_LOGIN","Login");
	break;

    default:
	define("_USER_LOGIN","User Login");
	define("_USER","Utente");
	define("_PASSWORD","Password");
	define("_PER_ENTRARE","Per entrare");
	define("_EMAIL_PASSW_FORWARD","Recupero Password via E-Mail ");
	define("_REGISTRATI","Registrati");
	define("_WELCOME","Benvenuto");
	define("_MODIFICA_IMPOSTAZIONI","impostazioni");
	define("_REMEMBER_PASSWORD","Ricordami la mia Password");
	define("_SECURITYCODE","Security Code");
	define("_EXIT","Uscita");
	define("_LOGIN","Entra");
	break;
}


$dpath=$_GET["dpath"];

$actionlink="index.php?dpath=$dpath";
?>

<input type='image' src="../../applications/<?=$appname;?>/images/menu.png" id="nav_list" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0"  align="left" />
<input type='image' src="../../applications/<?=$appname;?>/none_images/Libre-Office.png" onclick="javascript: location.href='index.php';" title="Benvenuto in Libre Office Web" border=0 WIDTH="48" HEIGHT="42" hspace="3" vspace="0" align="left" />
<input type='image' src="../../applications/<?=$appname;?>/images/previous.png" onclick="javascript:window.history.back();" title="[Back]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
<!--	<input type='image' src="../../applications/<?=$appname;?>/images/search.png" onclick="javascript: location.href='index.php?action=search';" title="[Find]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
	<input type='image' src="../../applications/<?=$appname;?>/images/folder-add.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_dir';" title="[Add-Directory]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
	<input type='image' src="../../applications/<?=$appname;?>/images/uploads-file.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[Add-File]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
	<input type='image' src="../../applications/<?=$appname;?>/images/insert-link.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_link';" title="[Add-Link]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
	<input type='image' src="../../applications/<?=$appname;?>/images/shared.png" onclick="javascript: location.href='index.php';" title="Benvenuto in Files 3" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
-->
<input type='image' src="../../applications/<?=$appname;?>/images/system-help.png" onclick="javascript: location.href='index.php?action=help';" title="[Help]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
<?    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
			<input style="position:fixed; right: 5px; z-index: 20;" type='image' src="<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="right" />
		<?php } else { ?>
			<input style="position:fixed; right: 5px; z-index: 20;" type='image' src="../../applications/<?=$appname;?>/libs/avatars/<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="right" />
		<?php } ?>
</div>
<div id='barretta' style='position:fixed;  z-index: 20; top: 50px; height:5px; width:100%; background-color: red;' ></div>

</html>
<?php

//=======================================================================================
//
// Copyright (c) 2013-2014 by vroby & Daniele
// 
// Files - the File Manager
// Section  by vroby (http://www.sdlbasic.altervista.org - __vroby__@libero.it)
// Graphics, testing, restyling and integration by Daniele (deplano.d@gmail.com)
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//=======================================================================================


$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

//la directory dei submit
global $updatefiles;

$updatefiles="../../users/".$utente."/".$cartella."/LibreOfficeWebData/"."none_updatefiles";

// la dimensione massima di un file
$maxFileSize=200000000;

// scarica le variabili che servono
$dpath=$_GET['dpath']; //echo "PERCORSO ATTUALE: ".$dpath;

$action=$_GET['action'];
$appname ="LibreOfficeWeb";
$zip_op=$_GET['zip_op'];

$filename=$_GET['filename'];

$path_thumb = "../../users/$utente/$cartella/thumbnair";

// test da abilitare con variabili di controllo solo al bisogno
// ----------------------------------------------------------------------------------//
// echo "<h3>Nome applicazione: ".$appname."</h3><br>";
// echo "<h3>Nome applicazione Senza nulla: ".sec_title($appname)."</h3><br>";
// echo "<h3>Path: ".$dpath."</h3><br>";
// echo "<h3>Path dei files da aggiornare - updatefiles: ".$updatefiles."</h3><br>";
// echo "<h3>Updatedir: ".$updatedir."</h3><br>";
// ----------------------------------------------------------------------------------//


//*/

//fissa $siteurl se non finisce con /
if (substr($siteurl,-1)!="/")$siteurl=$siteurl."/";

$lang="it";
//carica la lingua se esiste
if (file_exists("../../applications/$appname/none_lang/$lang.inc"))
    include "../../applications/$appname/none_lang/$lang.inc";
else
    include "../../applications/$appname/none_lang/it.inc";

//style.css
echo "<link rel=\"StyleSheet\" href=\"../../applications/$appname/style.css\" type=\"text/css\">";


//startUP
//------------------------
//$user=user_getuser();

if ($utente!=""){
// se la directory datas/applications/$appname non c'e' la crea:
if(file_exists("../../users/$utente/$cartella/LibreOfficeWebData")==false){ mkdir("../../users/$utente/$cartella/LibreOfficeWebData",0775); }
if(file_exists("../../users/$utente/$cartella/LibreOfficeWebData/none_updatefiles")==false){ mkdir("../../users/$utente/$cartella/LibreOfficeWebData/none_updatefiles",0775); }
if(file_exists("$path_thumb")==false){ mkdir("$path_thumb",0775); }
	      }
//__________________________________________________________________________________________________________________________________
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

//__________________________________________________________________________________________________________________________________
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
//__________________________________________________________________________________________________________________________________
/**
 * Richiama il Path di Base della installazione di FW
 *
 * @author FW-TEAM
 * @version 20070423
 * @since   20070423
 * @return Percorso comprensivo di pagina index.php di avvio
 */
function base_path(){return substr( $_SERVER['PHP_SELF'], 0, strpos( $_SERVER['PHP_SELF'], "index.php" ));}
//__________________________________________________________________________________________________________________________________

// tocca tutte le cartelle del path per aggiornarne la data ///////// funzione temporaneamente disabilitata e chiamate remmate /////
function touch_path($path){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $cpath=$path;
    while ($cpath !=''){
	$cpath=dirname($cpath);
	if (!@touch($cpath)) return 0;
    }
}
//__________________________________________________________________________________________________________________________________

//carica in  un array l'elenco dei file di una directory
function listdir($path){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $hdir=opendir($path);
    while (false !== ($f= readdir($hdir)))
	$filename[$i++] =$f;
    closedir($hdir);
    if (count($filename))sort($filename);
    return $filename;
}
//__________________________________________________________________________________________________________________________________

//legge la descrizione di un file/dir
function readdesc($f){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if (file_exists($f)){
	$hf=fopen("$f","r");
	$desc=fread($hf,4096);
	fclose($hf);
    }
    else{
	$desc="";
    }
    return $desc;
}
//__________________________________________________________________________________________________________________________________

//scrive la descrizione di un file/dir
function writedesc($f,$desc){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

	$hf=fopen("$f","w");
	fwrite($hf,$desc);
	fclose($hf);
}
//__________________________________________________________________________________________________________________________________

// comprime una cartella in un file da scaricare al volo
function zip_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $siteurl=$_GLOBALS['siteurl'];
    $appname ="LibreOfficeWeb";
    $filename =$_GET['filename'];

    $path=$filename."/";
    $list=listfile($dpath,$path);

    $zipfile = new zipWriter("zipfolder",$filename.".zip");
    foreach($list as $filename){
	if ($filename[0]!="."){
	    if (is_dir($dpath.$filename)){
		$zipfile ->addDir($filename);
	    }
	    else{
		$filedata = file_get_contents($dpath.$filename);
		$zipfile ->addRegularFile($filename,$filedata);
	    }
	}
    }
    $zipfile ->finish();
}
//__________________________________________________________________________________________________________________________________

// visualizza la pagina di ricerca
function search($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

	$siteurl=$_GLOBALS['siteurl'];
        $appname ="LibreOfficeWeb";
if ($utente!=""){
  //Search
	echo "<br><br><div>";
    	echo "<br><br><form name='addfile' enctype='multipart/form-data' action='index.php?dpath=$dpath&action=exec_search' method='post'>";
	echo "<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >[Find]</span></button>";
	echo "&nbsp;<input class='input_text' type='text' name='file'/>";
    	echo "</form>";
    	echo "</div>";
}
}
//__________________________________________________________________________________________________________________________________

// cerca il file
function exec_search($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $siteurl=$_GLOBALS['siteurl'];
    $appname ="LibreOfficeWeb";
    $pattern=$_POST['file'];


    echo "<br><br><left><div class='black_bold'><img src='../../applications/$appname/none_images/icon2.gif' border='0'> "._FINDINGFILES." <font class='black'>\"$pattern\"</font></div></left>";
    echo "<br>";
    $pattern=str_replace("*","",$pattern);
    $path="../../users/".$utente."/".$cartella."/LibreOfficeWebData/";
    if ($pattern!="")
	searchdir($path,$pattern);


	echo "<br><div align='left'><a href='index.php' class='' title='[Home]'><span style='border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;' class='button'>[Home]</span></a>&nbsp;&nbsp;";
    	echo "<a href='index.php?action=search' class='' title='["._NEW_SEARCH."]'><span style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;' class=''>[Find]</span></a>&nbsp;&nbsp;";
}

//l'handler di ricerca(la funzione e' ricorsiva)
function searchdir($dpath,$pattern){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $siteurl=$_GLOBALS['siteurl'];
    $appname ="LibreOfficeWeb";

    $extfs=opendir("../../applications/$appname/none_images");
    while (false !== ($extimg= readdir($extfs))){
	if (substr($extimg,-4)==".png")
	    $ext[substr(substr($extimg,0,-4),-3)]=$extimg;
    }
    closedir($extfs);

    foreach(listdir($dpath) as $filename){
	if ($filename[0]!="."){
	    if (strpos(strtolower($dpath.$filename),strtolower($pattern)) || strpos(strtolower(readdesc($dpath.$filename .".description")),strtolower($pattern)))
		if (substr($dpath.$filename,-6)!=".count" && substr_count($dpath.$filename,".description")==0  && !is_dir($dpath.$filename)){
		    $f=$dpath.$filename.".count";
		    if (file_exists($f)){
			$hf=fopen("$f","r");
			$count=fread($hf,1024);
			fclose($hf);
		    }
		    else{
			$count=0;
		    }

		    $actionlink="index.php?dpath=$dpath&filename=$filename";
		    if ($utente!=""){
			$rename_file="<img src='../../applications/$appname/none_images/icon2.gif' border='0'>[<a href='$actionlink&action=rename_file'>"._REN."</a>]";
			$delete_file="<img src='../../applications/$appname/none_images/icon2.gif' border='0'>[<a href='$actionlink&action=delete_file'>"._DEL."</a>]";
			$cut_file="<img src='../../applications/$appname/none_images/icon2.gif' border='0'>[<a href='$actionlink&action=cut_file'>"._CUT."</a>]";
			}

		    if ($ext[substr($filename,-3)]!="")
			$picture="<img src='../../applications/$appname/none_images/".$ext[substr($filename,-3)]."' border='0'>";
		    else
			$picture="<img src='../../applications/$appname/none_images/unknown.png' border='0'>";
		    if (substr($filename,-2)=="gz")
			$picture="<img src='../../applications/$appname/none_images/tgz.png' border='0'>";

		 // Visualizza Files trovati
			echo "<table border='0' width='100%'><tr>";
			echo "<td valign='top'>";
			echo "<div class='file'>";
		    echo "<table border='0'><tr>";
		    echo "<td  valign='top' align='right' width='3%'>";
		    echo "$picture";
		    echo "</td>";
		    echo "<td align='justify' valign=top>";
            echo "<a href='$actionlink&action=download'><font class='red_bold'>$filename</font></a>";
			echo"<font class='black'> - "._RILASCIO." </font> ".date("j.m.y",filemtime("$dpath/$filename"))."";


			if(strtolower(substr($filename,-4))<>".lnk"){
			echo "<font class='black'> - "._SIZE_FILE." </font>".round(filesize("$dpath/$filename")/1000)."Kb ";
			}
			else
			echo "<font class='black'> - "._FILE_REMOTO." </font>";


		    echo"<font class='black'> - Downloads: </font> $count";
			$dpath1="$dpath/$filename";
			if(file_exists("$dpath1.updateby.description")){
				if(filesize("$dpath1.updateby.description")>1){
				echo "<br><font class='black'>"._UPDATEBY." </font>";
				$updateby=trim(join(file("$dpath1.updateby.description")));
				echo"<a href='forum/index.php?op=profile&amp;user=$updateby'>$updateby</a>";
				}
			}

			if(file_exists("$dpath1.version.description")){
				if(filesize("$dpath1.version.description")>1){
				echo "<font class='black'> - "._VERSION." </font>";
				readfile("$dpath1.version.description");
				}
			}
			echo "<br>";


			if(file_exists("$dpath1.description")){
				if(filesize("$dpath1.description")>1){
				echo "<font class='grey_bold'>"._DESCRIPTION." </font>";
				readfile("$dpath1.description");
				}
			}
			echo "</td>";
		    echo "<td align='right' valign=top >";
		    if ( filemtime("$dpath/$filename")> mktime (0,0,0,date("m"),date("d")-5,  date("Y")))
			echo"<img src='../../applications/$appname/none_images/new.gif'>";

			echo "</tr></table>";
			echo "</td></tr></table>";
		}
		//ricorsione!!!
		if (is_dir($dpath.$filename))searchdir($dpath.$filename."/",$pattern);
	    }
    }
}
//__________________________________________________________________________________________________________________________________

// visualizza l'help
function help($dpath){
	$siteurl=$_GLOBALS['siteurl'];
        $appname ="LibreOfficeWeb";
 	echo ""._HELP_TXT."<br />";
}
//__________________________________________________________________________________________________________________________________

// sposta il file uploadato/submitted nel file system visibile
function update_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){

	$siteurl=$_GLOBALS['siteurl'];
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$updatedir=$_GET['updatedir'];

 	copy ("$updatedir/$filename",$dpath.$filename);
	unlink("$updatedir/$filename");

	////////////////////////////////////////////////touch_path($dpath.$filename);

	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._FILE_ACCEPTED."!</font><br/>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
	}
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// chiede il nome del link
function add_link($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $myforum=$_COOKIE['myforum'];
    $appname ="LibreOfficeWeb";
    $siteurl=$_GLOBALS['siteurl'];

 // Admin form link user
    echo "<br><br><br><br><table border='0' class='file' width='100%' style='padding:10px'>
    <form  name='addfile' enctype='multipart/form-data' action='".$siteurl."index.php?dpath=$dpath&action=exec_add_link' method='post'>
    <tr>
    <td  width='20%' class='black'></td><td> <input name='name' type='text' size='30%' placeholder='"._NOME_LINK."' ></td>
    </tr>
    <tr>
    <td width='20%' class='black'></td><td> <br><input name='link' type='text' size='30%' placeholder='"._INVIA_LINK."' ></td>
    </tr>
    <tr>
    <td></td>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ADD_LINK."</span></button>
	<br><br><a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
    </td>
    </tr>
	</form>
    </table>";

}
//__________________________________________________________________________________________________________________________________

// esegue il caricamento del link
function exec_add_link($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$siteurl=$_GLOBALS['siteurl'];

	$name=$_POST['name'];
	$link=$_POST['link'];
	$desc=stripslashes($_POST['desc']);
	$vers=$_POST['vers'];

	$myforum=$_COOKIE['myforum'];
	$uploaddir = $dpath;

	if ($utente!=""){
	    $hf=fopen("$uploaddir/".$name.".lnk","w");
	    fwrite($hf,"$link");
	    fclose($hf);
	}
	else
	    echo _ERRORE_DI_AUTENTICAZIONE;
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

//crea la thumbnails di una foto
function mkthumbs($source,$dest){
    //x:y=64:n
    //n=y*64/n
    list($w,$h)=getimagesize($source);
    if ($w>160){
	$nw=160;
	$nh=160*$h/$w;
    }
    else{
	$nw=$w;
	$nh=$h;
    }
    $thumb=imagecreatetruecolor($nw,$nh);

    if (strtolower(substr($source,-3))=="gif"){
	$foto=imagecreatefromgif($source);
	imagecopyresized($thumb,$foto,0,0,0,0,$nw,$nh,$w,$h);
	imagegif($thumb,$dest);
    }

    if (strtolower(substr($source,-3))=="jpg"){
	$foto=imagecreatefromjpeg($source);
	imagecopyresized($thumb,$foto,0,0,0,0,$nw,$nh,$w,$h);
	imagejpeg($thumb,$dest);
    }

    if (strtolower(substr($source,-4))=="jpeg"){
	$foto=imagecreatefromjpeg($source);
	imagecopyresized($thumb,$foto,0,0,0,0,$nw,$nh,$w,$h);
	imagejpeg($thumb,$dest);
    }

    if (strtolower(substr($source,-3))=="png"){
	$foto=imagecreatefrompng($source);
	imagecopyresized($thumb,$foto,0,0,0,0,$nw,$nh,$w,$h);
	imagepng($thumb,$dest);
    }
}
//-------------------------------------------------------------------------------------------------------

function new_file_docx($dpath){
echo "<br>";
echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."/Writer/index.php?dpath=$dpath&action=add_new_file_docx\">";
}
//-------------------------------------------------------------------------------------------------------

function new_file_xlsx($dpath){
}
//-------------------------------------------------------------------------------------------------------

function new_file_odg($dpath){
}
//-------------------------------------------------------------------------------------------------------

function new_file_odb($dpath){
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// chiede il nome del file
function add_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $maxFileSize; $maxFileSize=200000000;
    $myforum=$_COOKIE['myforum'];
    $appname ="LibreOfficeWeb";
    $siteurl=$_GLOBALS['siteurl'];


echo "
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _('file1').files[0];
	//alert(file.name+' | '+file.size+' | '+file.type);
	var formdata = new FormData();
	formdata.append('file1', file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener('progress', progressHandler, false);
	ajax.addEventListener('load', completeHandler, false);
	ajax.addEventListener('error', errorHandler, false);
	ajax.addEventListener('abort', abortHandler, false);
	ajax.open('POST', 'file_upload_parser.php?dpath=$dpath');
	ajax.send(formdata);
}
function progressHandler(event){
//	_('loaded_n_total').innerHTML = 'Uploaded '+event.loaded+' bytes of '+event.total;
	var percent = (event.loaded / event.total) * 100;
	_('progressBar').value = Math.round(percent);
	_('status').innerHTML = Math.round(percent)+'% uploaded... please wait';
}
function completeHandler(event){
	_('status').innerHTML = event.target.responseText;
	_('progressBar').value = 0;
}
function errorHandler(event){
	_('status').innerHTML = 'Upload Failed';
}
function abortHandler(event){
	_('status').innerHTML = 'Upload Aborted';
}
</script>
";


 // Admin form link
    echo "<br><br><br><br>
	<table border='0' class='file' width='100%' style='padding:10px'>
	<form id='upload_form' enctype='multipart/form-data' method='post'>
    <tr>
    <td width='20%' class='black'><!--"._INVIA_FILE."--></td>
    <td>
	<br><br>
	<span style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;' ><input type='file' name='file1' id='file1' size='25%'></span>
    </td>
    </tr>
    <tr>
    <td></td>
    <td>
	<br><br><input type='button' value='"._ADD_FILE."' onclick='uploadFile()' style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
	<a href='index.php?dpath=$dpath' class='button red' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
  	<br><br><progress id='progressBar' value='0' max='100' style='width:300px;'></progress>
  	<h3 id='status'></h3>
 <!-- 	<p id='loaded_n_total'></p> -->
    </td>
    </tr>
	</form>
    </table>";

}
//__________________________________________________________________________________________________________________________________

// visualizza opzioni della directory
function vedi_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

$actionlink="index.php?dpath=$dpath&filename=$filename";
$actionlink_vedi="index.php?dpath=$dpath$filename/";

$zip_dir="<center><br><br><br><br><span class='cosmetica' valign='center' ><a href='index.php?zip_op=zipdir&dpath=$dpath&filename=$filename' class='' title='[Download-Zip-Directory]' align='top'>[Download Zip: $filename]</a></span></center>";

?>
<div id='menu' name='menu' style='z-index:20; width:100%; height:280px; background-color: #E8E8E8; position:fixed; top: 55; left: 0px; border: 0px solid grey;  padding: 3px 3px 3px 3px; -moz-border-radius: 3px 3px 3px 3px; -webkit-border-radius: 3px 3px 3px 3px; box-shadow: 5px 5px 3px GRAY;'>
<div class="" style="height:100%;background-color: #E8E8E8; border:none;">
<br>

<? //echo "$cut_dir  $rename_dir  $delete_dir"; ?><br>

<? echo " $zip_dir "; ?><br><br><br><center>

<img src="../../applications/<?=$appname;?>/images/delete.png" title='[Delete-Directory]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=delete_dir';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">
<img src="../../applications/<?=$appname;?>/images/rename.png" title='[Rename-Directory]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=rename_dir';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">
<img src="../../applications/<?=$appname;?>/images/clipboard.png" title='[Clipboard-Directory]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=cut_dir';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">
<img src="../../applications/<?=$appname;?>/images/folder.png" title="[Apri-Directory]" style="  width:48px; height:48px;" onclick="javascript:location='<?=$actionlink_vedi;?>';"></center>

<?php

}

//__________________________________________________________________________________________________________________________________

// visualizza opzioni del file
function vedi_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

$actionlink="index.php?dpath=$dpath&filename=$filename";
$actionlink_vedi="index.php?dpath=$dpath$filename/";
echo "<br>";
$zip_dir="<center><br><span class='cosmetica' valign='center' ><a href='index.php?zip_op=zipdir&dpath=$dpath&filename=$filename' class='' title='[Download-Zip-Directory]' align='top'>[Download Zip: $filename]</a></span></center>";

$vedilink = "<a class='' title='[View Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='visualizza(\"$viewlink\");'><span class=''>$picture</span></a>";
$modlink = "<a class='' title='[Modify Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='visualizza(\"$viewlink\");'><span class=''></span></a>";
$downlink = "<center><button style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-weight:bold; font-size: 12px;' align='center' onclick=\"location='$siteurl$dpath$filename'\" title='[Download: $filename]'>[Download: $filename]</button></center>";

$preview="$dpath/$filename";

?>
<div id='menufile' name='menufile' style='width:100%; height:80%; background-color: #E8E8E8; position:fixed; top: 55; left: 0px; border: 0px solid grey;  padding: 3px 3px 3px 3px; -moz-border-radius: 3px 3px 3px 3px; -webkit-border-radius: 3px 3px 3px 3px; box-shadow: 5px 5px 3px GRAY;'>
<div class="" style="height:100%;background-color: #E8E8E8; border:none;">


<?php if (strtolower(substr($filename,-4))=='.lnk' || strtolower(substr($filename,-4))=='.pdf' || strtolower(substr($filename,-4))=='.doc' || strtolower(substr($filename,-4))=='.xls' || strtolower(substr($filename,-4))=='xlsx' || strtolower(substr($filename,-4))=='docx' ){
   echo "<br>";
} else { echo "<center><a href='$preview' rel='lightbox'><img src='$preview' border='0' width='100' height='70'/></a></center><br>"; }

?>

<? echo " $vedilink $modlink $downlink"; ?><br><center>

<img src="../../applications/<?=$appname;?>/images/delete.png" title='[Delete-File]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=delete_file';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">
<img src="../../applications/<?=$appname;?>/images/rename.png" title='[Rename-File]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=rename_file';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">
<img src="../../applications/<?=$appname;?>/images/clipboard.png" title='[Clipboard-File]' style=" width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>&action=cut_file';">
<img src="../../applications/<?=$appname;?>/images/space.png" style=" width:28px; height:28px;">

<img src="../../applications/<?=$appname;?>/images/fileopen.png" title="[Apri-File]" style="  width:48px; height:48px;" onclick="javascript:location='<?=$actionlink;?>';"></center>

</div></div>
<?php

}

//__________________________________________________________________________________________________________________________________

// chiede il nuovo nome del file
function rename_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

 // Admin form link

    echo "<br>";

    echo "<table border='0' class='file'  width='100%' style='padding:10px'>
    <form name='renamefile' action='index.php?dpath=$dpath&filename=$filename&action=exec_rename_file' method='POST' enctype='multipart/form-data'>
    <tr>
    <td width='20%' class='black'></td><td><a>"._NUOVO_NOME_FILE."</a><br><input 'type=text name='namefile' value='$filename' size='30%'></td>
    </tr>";
    if (strtolower(substr($filename,-4))=='.lnk'){
	echo"    <tr>
		    <td width='20%' class='black'></td><td><a>"._NUOVO_FILE_LINK."</a><br><input 'type=text name='namelink' value='".join(file($dpath.$filename))."' size='30%'></td>
		</tr>";
    }

    echo"<tr>
    <td></td><td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >"._RENAME_FILE."</span></button>
	<a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>

    </tr>
	</form>
    </table>";
}
//__________________________________________________________________________________________________________________________________

// esegue la rinomina del file
function exec_rename_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];
	$namefile=$_POST['namefile'];
	if (strtolower(substr($filename,-4))=='.lnk')
		$namelink=$_POST['namelink'];
	$deletepreview= $_POST['deletepreview'];

	if (file_exists($dpath.$filename))
	    rename($dpath.$filename,$dpath.$namefile);

	if (file_exists("../../users/$utente/$cartella/thumbnair/".$filename))
	    rename("../../users/$utente/$cartella/thumbnair/".$filename,"../../users/$utente/$cartella/thumbnair/".$namefile);

	if ($filename !=$namefile)

	if (strtolower(substr($namefile,-4))=='.lnk' && trim(@join(@file($dpath.$namefile)))!=trim($namelink) ){
	    $hf=fopen($dpath.$namefile,"w");
    	    fwrite($hf,"$namelink");
	    fclose($hf);
	}

	$uploaddir = $dpath;
	if ($_FILES['file']['tmp_name']!=""){
	    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir .$namefile) ) {

		chmod($uploaddir . $namefile,0775);
	    }else {
		echo" errore <br/>";
		print_r($_FILES);
	    }
	}
	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._FILE_MODIFIED."!</font><br/>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
	}
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// esegue lo spostamento del file
function cut_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    if ($utente!=""){
	$appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];
	$updatedir="$updatefiles/";


	copy($dpath.$filename,$updatedir.$filename);
	unlink($dpath.$filename);

	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._FILE_SPOSTATO."!</font><br/>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// cancella il file
function delete_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

    echo "<br><br><br><br>";
    echo "<center><form name='deletedir' action='index.php?dpath=$dpath&filename=$filename&action=exec_delete_file' method='POST'>
	<div class='black_bold'>"._IN_FILE."$dpath$filename</div><br><br>
	<button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ELIMINA."</span></button>
	<a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
	</form></center>";
}
//__________________________________________________________________________________________________________________________________

// esegue la cancellazione del file
function exec_delete_file($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	if (unlink($dpath.$filename)!=true){ 
	    echo "<br><br><br><br><font class='black_bold'>"._IN_FILE."$dpath$filename</font><br><br>
		<input type='button' value='"._ANNULLA."' onclick=\"javascript:window.location.href='".$siteurl."index.php?dpath=$dpath';\">
	    ";
	}
	else{
	    echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class=black_bold>"._FILE_DELETED."!</font><br/>";
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
	}
		unlink("../../users/$utente/$cartella/thumbnair/".$filename);
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// chiede il nome della directory
function add_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $lang;
    $appname ="LibreOfficeWeb";
    $siteurl=$_GLOBALS['siteurl'];

 // Admin form link

    echo "<br><br><br><br>";
    echo "<table border='0' class='file' width='100%' style='padding:10px'>
    <form name='adddir' action='index.php?dpath=$dpath&action=exec_add_dir' method='POST' enctype='multipart/form-data'>
    <tr>";
    echo "<td width='20%' class='black'></td><td> <input type='text' name='namedir' value='";
	switch($lang) {
	case "it":
	echo "Nuova cartella";
	break;
	case "en":
	echo "New folder";
	break;
	default:
	echo "Nuova cartella";
	break;
	}
	echo "' size='30%'></td>";
    echo "</tr>
    <tr>
<!--    <td valign=top class='black'>"._DESC_DIR."</td><td> <textarea class='textarea' name='descdir'></textarea></td> -->
    </tr>
    <tr>
    <td></td>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ADD_DIR."</span></button>
	<br><br><a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
    </tr>
	</form>
    </table>";
}
//__________________________________________________________________________________________________________________________________

// esegue la creazione della directory
function exec_add_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$siteurl=$_GLOBALS['siteurl'];
	$namedir=$_POST['namedir'];
	$descdir=stripslashes($_POST['descdir']);



	mkdir($dpath.$namedir,0775);
	//chmod($dpath.$namedir,0775);

	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_ADDED."!</font><br/>";
    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
	}
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// chiede il nuovo nome della directory
function rename_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

 // Admin form link
    echo "<br><br><br><br>";
    echo "<table border='0' class='file'  width='100%' style='padding:10px'>
    <form name='renamedir' action='index.php?dpath=$dpath&filename=$filename&action=exec_rename_dir' method='POST' enctype='multipart/form-data'>
    <tr>
    <td width='24%' class='black'></td><td><a>"._NUOVO_NOME_DIR."</a><br><br><input type='text' name='namedir' value='$filename' size='30%'></td>
    </tr>
    <tr><td></td>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._RINOMINA_DIR."</span></button>
	<br><br><a href='index.php?dpath=$dpath&filename=$filename' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
    </tr>
	</form>
    </table>";
}
//__________________________________________________________________________________________________________________________________

// esegue la rinomina della directory
function exec_rename_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$siteurl=$_GLOBALS['siteurl'];
	$filename=$_GET['filename'];
	$namedir=$_POST['namedir'];
	$desc=stripslashes($_POST['desc']);

 	rename($dpath.$filename,$dpath.$namedir);

	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_RENAMED."!</font><br>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// taglia la directory
function cut_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	$source=$dpath.$filename;
	$dest="$updatefiles/$filename";
	copytree($source,$dest);
	deltree ($source);
    }
    echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_CUTTED."!</font><br>";
    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";

}
//__________________________________________________________________________________________________________________________________

// incolla la directory
function update_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	$source="$updatefiles/$filename";
	$dest=$dpath.$filename;
	copytree($source,$dest);
	deltree ($source);
    }
    echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_UPDATED."!</font><br>";
    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";

}
//__________________________________________________________________________________________________________________________________

// elimina la directory tagliata
function delete_update_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

    echo "<br>";
    echo "<form name=deletedir>
	<div class='black_bold'>"._IN."$updatefiles$filename</div><br><br>
	<a href='index.php?dpath=$dpath&filename=$filename&action=exec_delete_update_dir' style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._CANCELLA_DIR."</span></a>&nbsp;&nbsp;
	<a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>

	</form><br><br>";
}
//__________________________________________________________________________________________________________________________________

// esegue l'eliminazione della directory tagliata
function exec_delete_update_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	$source="$updatefiles/$filename";
	deltree($source);
    }
    echo "<br><br><img src='../../aplications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._FILE_DELETED."!</font><br/>";
    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";

}
//__________________________________________________________________________________________________________________________________

// cancella la directory
function delete_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

    echo "<br><br><br><br>";
    echo "<form name=deletedir>
	<div class='black_bold'>"._IN."$dpath$filename</div><br><br>
	<a href='index.php?dpath=$dpath&filename=$filename&action=exec_delete_dir' style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._CANCELLA_DIR."</span></a>&nbsp;&nbsp;
	<a href='index.php?dpath=$dpath' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>

	</form><br><br><br>";
}
//__________________________________________________________________________________________________________________________________

// esegue la cancellazione della directory
function exec_delete_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	if (@rmdir($dpath.$filename)!=true){
	    echo "<br><font class='red_bold'>"._DIR_IN."$dpath$filename "._NOT_EMPTY." </font><br><br>
	    <input type='button' value='"._CANCELLA_TREE."' onclick=\"javascript:window.location.href='".$siteurl."index.php?dpath=$dpath&filename=$filename&action=exec_deltree_dir';\">
	    <input type='button' value='"._ANNULLA."' onclick=\"javascript:window.location.href='".$siteurl."index.php?dpath=$dpath';\">
	    ";
	}
	else{
	    echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_DELETED."!</font><br/>";
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
	}
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

//esegue la cancellazione del'uintero albero di directory
function exec_deltree_dir($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="LibreOfficeWeb";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];


	deltree($dpath.$filename);
	echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>"._DIR_DELETED."!</font><br/>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php?dpath=$dpath\">";
    }
    else
	die(_NONPUOI);
}

//__________________________________________________________________________________________________________________________________

// esegue il download richiesto e incrementa il contatore dei download per il file
function download($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="LibreOfficeWeb";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

    if (substr($dpath.$filename,-4)==".lnk"){
	echo"<br><br><br><br><br><span ><a href='".join(file("$siteurl$dpath$filename"))."' style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' title='If do not start download please click [Download: $filename]'><span class=''></span><span class=''>[Download: $filename]</span></a></span>";
	echo "<a href='index.php?dpath=$dpath' title='"._CONTINUA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._CONTINUA."</span></a>";
    }
    else{
	echo"<br><br><br><br><br><span><a href='$siteurl$dpath$filename' style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' title='[If do not start download please click Download: $filename]'><span class=''></span><span class=''>[Download: $filename]</span></a></span>";
	echo "<span><a href='index.php?dpath=$dpath' title='[Continua]' style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class=''>[Continua]</span></a></div></span>";
    }
}
//__________________________________________________________________________________________________________________________________

// stampa il path con i relativi link
function dirtitle($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

$dalevare=7+strlen($utente)+1+strlen($cartella)+1;
//echo $dalevare."<br>$user_lung<br>$cartella_lung<br>";

    $appname ="LibreOfficeWeb";
    $a=0;
    $dirlist="";
    $out="";
    $p="";
	if ($utente!=""){
    for($i=0;$i<strlen($dpath)-1;$i++){
	if($dpath[$i]=="/"){
	    $a++;
	    $p=$p."$dirlist/";
	    if($dirlist!="users" &&$dirlist!="users")
		$out=$out."<a href='index.php?dpath=../../$p'>$dirlist/</a><br><br><br><br> ";
//		$out=$out."<a href='index.php?dpath=../../$p'>$dirlist/</a>";
//		$out=$out."<a href='index.php?dpath=../../$p'>".substr($dirlist, $dalevare)."< </a> ";
	    $dirlist="";
	}
	else{
	    $dirlist=$dirlist.$dpath[$i];
	}
    }
    $p=$p."$dirlist";
    $out=$out."$dirlist";
	echo "<img  src='../../applications/$appname/images/navigation.png' style='position: relative; top: 40px; left: 46%;z-index:10' onClick='locationcontrol()'; border='0' width='32' height='32' ><br><br><br>";
	echo "<br><div  id='divlocation' style='position: relative; top: 0px; display:none; z-index:10' ><span style='overflow: auto; white-space: nowrap;' class='location' >$out</span><br><br><br></div>";
//	echo "<div  id='divlocation' style='position: relative; top: -30px; display:none; z-index:10; overflow: auto; white-space: nowrap;' ><span style='overflow-y: auto; white-space: nowrap;' class='location' >$out</span><br><br></div>";
//	echo "<br><span class='location' >".substr($out, $dalevare)."</span><br><br><br>";
}
}
//__________________________________________________________________________________________________________________________________

// visualizza il contenuto di dpath
function dirlist($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

$appname ="LibreOfficeWeb";

$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    global $updatefiles;
    $appname ="LibreOfficeWeb";
    $siteurl=$_GLOBALS['siteurl'];
    $updatedir ="$updatefiles";

	if ($utente!=""){

    $extfs=opendir("../../applications/$appname/none_images");
    while (false !== ($extimg= readdir($extfs))){
	if (substr($extimg,-4)==".png")
	    $ext[substr(substr($extimg,0,-4),-3)]=$extimg;
    }
    closedir($extfs);

// Directory
    if (!file_exists($dpath)){
	echo _PATH_ERROR;
    }
    else{
    echo "<br>";
	foreach(listdir($dpath) as $filename){
	    if ($filename !="." && $filename !=".."){
		if (is_dir($dpath.$filename)!=false && substr_count($dpath.$filename,"/none_")==0 ){

		    $i= ($i+1)& 1;
//		    $zip_dir="<a href='".$siteurl."index.php?appname=".$appname."&zip_op=zipdir&dpath=$dpath&filename=$filename'> <font class='black_bold'>Download directory</font></a>";
		    	$actionlink="index.php?dpath=$dpath&filename=$filename";
//			$zip_dir="<br><span class='cosmetica' valign='center' ><a href='$actionlink&action=vedi_dir' class='' title='[Opzioni-Directory]' align='top'>[$filename]</a></span>";
			$zip_dir="<br><span class='cosmetica' valign='center' ><a href='index.php?dpath=$dpath$filename/' class='' title='[Opzioni-Directory]' align=''>[$filename]</a></span>";
		    if ($utente!=""){
			$cut_dir="<a href='$actionlink&action=cut_dir' class='' title='[Clipboard-Directory]'><img  src='../../applications/$appname/images/clipboard.png' align='right' border='0' width='42' height='42' ></a>";
			$rename_dir="<a href='$actionlink&action=rename_dir' class='' title='[Rename-Directory]'><img src='../../applications/$appname/images/rename.png' align='right' border='0' width='42' height='42' ></a>";
			$delete_dir="<a href='$actionlink&action=delete_dir' class='' title='[Delete-Directory]'><img src='../../applications/$appname/images/delete.png' align='right' border='0' width='42' height='42' ></a>";
			$vedi_dir="<a href='$actionlink&action=vedi_dir' class='' title='[Opzioni-Directory]'><img src='../../applications/$appname/images/info.png' align='right' border='0' width='42' height='42' hspace='5' vspace='3'></a>";
		    }
		    echo "<table border='0' width='100%' style='position:relative; top: -25px;' ><tr><td valign='top'>";
		    echo "<div class='directory'>";
		    echo "<table width='100%' border='0' cellspacing='0'><tr>";
		    echo "<td valign='midle' align='left' width='1%'>";
		    echo "</td><td align='justify' valign='midle'></tr>  ";
	     // Admin mini panel
		    if ($utente!=""){
		    echo "<td><tr><a href='index.php?dpath=$dpath$filename/' class='' title='[Apri-Directory]-[$filename]'><img src='../../applications/$appname/images/folder.png' align='left' border='0' width='42' height='42' hspace='5' vspace='3' ></a></tr></td>";
		    //echo "<!-- $cut_dir $rename_dir $delete_dir --> ";
		    echo "<td><tr>$vedi_dir</tr></td><tr>$zip_dir</tr>";
		    }
		    $dpath1="$dpath/$filename";
		    if(file_exists("$dpath1.description")){
			if(filesize("$dpath1.description")>1){
			    //echo "<font class='grey_bold'> "._DESCRIPTION."</font> ";
			    echo "&nbsp;&nbsp;&nbsp;&nbsp;"; readfile("$dpath1.description");
			}
		    }
		    echo "</td><td valign='top' align='right' width='25'>";
		    if ( filemtime("$dpath/$filename")> mktime (0,0,0,date("m"),date("d")-5,  date("Y"))){
		    }
		    echo "</table></div>";
		    echo "</td></tr></table>";
		}
	    }
	}

    // Files
	foreach(listdir($dpath) as $filename){
	    if ($filename !="." && $filename !=".." && substr_count($filename,".description")==0 && substr($filename,-6)!=".count"){
		if (is_dir("$dpath/$filename")==false){

		    echo "<a name='".str_replace("/","-",$dpath.$filename)."'>";
		    $f=$dpath.$filename.".count";
		    if (file_exists($f)){
			$hf=fopen("$f","r");
			$count=fread($hf,1024);
			fclose($hf);
		    }
		    else{
			$count=0;
		    }
		    $i= (($i+1)& 1)+2;
		    $actionlink="index.php?dpath=$dpath&filename=$filename";

$estensione=substr($filename,-3);
$radiostream="";
$ascolta_file="";

   switch($estensione){
	case "css":
	    $viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "php":
	    $viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "txt":
	    $viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "xls":
	    //$viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con google document viewer online
	    $viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
	    break;
	case "doc":
	    //$viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con google document viewer online
	    $viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
	    break;
	case "pdf":
//	    $viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path()."js/Viewer.js/index.html#../../".$dpath.$filename."";
	    break;
	case "odt":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path()."js/Viewer.js/index.html#../../".$dpath.$filename."";
	    break;
	case "ods":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path()."js/Viewer.js/index.html#../../".$dpath.$filename."";
	    break;
	case "odp":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path()."js/Viewer.js/index.html#../../".$dpath.$filename."";
	    break;
	case "ppt":
	    $viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
	    break;
//	case "mdb":
	    //$viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con google document viewer online
	    //$viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
//	    break;
	case "gif":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "png":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "jpg":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "peg":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "bmp":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "ico":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "tif":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "ico":
	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "lnk":
	    $viewlink="".file_get_contents($dpath.$filename)."";
	    break;
	case "ogv":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "mp3":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    $ascolta_file = "<div id='divplayer$filename' style='display:none;' ><table><audio id='player$filename' src='$dpath/$filename'></audio>
<tr><td>	<img src='../../applications/$appname/images/vol-play.png' onclick=\"document.getElementById('player$filename').play()\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-pause.png' onclick=\"document.getElementById('player$filename').pause()\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-stop.png' onclick=\"document.getElementById('player$filename').pause();document.getElementById('player$filename').currentTime = 0;\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-up.png' onclick=\"document.getElementById('player$filename').volume+=0.1\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-down.png' onclick=\"document.getElementById('player$filename').volume-=0.1\" align='left' border='0' width='42' height='42' ></td></tr></table></div>";
	//echo "<script>document.getElementById('divplayer$filename').style.display='none';</script>";
	    break;
	case "wma":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "mp4":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "mov":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
	case "amr":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    $ascolta_file = "<div  id='divplayer$filename' style='display:none;' ><table><audio id='player$filename' src='$dpath/$filename'></audio>
<tr><td>	<input type='image' id='amrplayer$filename' src='../../applications/$appname/images/vol-play.png' onclick='javascript:localStorage.setItem(\"filename\", \"$filename\");' align='left' border='0' width='42' height='42' ></td></tr></table></div>";
	    break;
	case "ogg":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    $ascolta_file = "<div  id='divplayer$filename' style='display:none;' ><table><audio id='player$filename' src='$dpath/$filename'></audio>
<tr><td>	<img src='../../applications/$appname/images/vol-play.png' onclick=\"document.getElementById('player$filename').play()\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-pause.png' onclick=\"document.getElementById('player$filename').pause()\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-stop.png' onclick=\"document.getElementById('player$filename').pause();document.getElementById('player$filename').currentTime = 0;\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-up.png' onclick=\"document.getElementById('player$filename').volume+=0.1\" align='left' border='0' width='42' height='42' ></td>
	<td>	<img src='../../applications/$appname/images/vol-down.png' onclick=\"document.getElementById('player$filename').volume-=0.1\" align='left' border='0' width='42' height='42' ></td></tr></table></div>";
	//echo "<script>document.getElementById('divplayer$filename').style.display='none';</script>";
	    break;
	case "emb":
 	    $viewlink="http://".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    $radiostream="".file_get_contents($dpath.$filename)."";
	    break;

    }

$estensione=substr($filename,-2);

   switch($estensione){
	case "js":
	    $viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";
	    break;
    }

$estensione=substr($filename,-4);

   switch($estensione){
	case "xlsx":
	    //$viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con google document viewer online
	    $viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
	    break;
	case "docx":
	    //$viewlink="http://docs.google.com/viewer?embedded=true&url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con google document viewer online
	    $viewlink="https://view.officeapps.live.com/op/view.aspx?src=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename.""; // con microsoft document viewer online
	    break;
    }

//echo "ECCO LA ESTENSIONE: ".$estensione;

//		    $viewlink="http://docs.google.com/viewer?url=".$_SERVER['SERVER_NAME'].base_path().$dpath.$filename."";

		    if ($utente!=""){
			$cut_file="<a href='$actionlink&action=cut_file' class='' title='[Clipboard]'><img  src='../../applications/$appname/images/clipboard.png' align='right' border='0' width='42' height='42' ></a>";
			$rename_file=" <a href='$actionlink&action=rename_file' class='' title='[Rename]'><img src='../../applications/$appname/images/rename.png' align='right' border='0' width='42' height='42' ></a>";
			$delete_file="<a href='$actionlink&action=delete_file' class='' title='[Delete]'><img src='../../applications/$appname/images/delete.png' align='right' border='0' width='42' height='42' ></a>";
//			$menu="<img src='../../applications/$appname/images/menu.png' title='[Menù]' align='right' border='0' width='25' height='25' onclick='javascript:menu($menuname);'>";

		    }

		    if ($ext[substr($filename,-3)]!="") 
			$picture="<img src='../../applications/$appname/none_images/".$ext[substr($filename,-3)]."' align='left' border='0' width='42' height='42' >";
		    else
			$picture="<img src='../../applications/$appname/none_images/unknown.png' align='left' border='0' width='42' height='42' >";
		    if (substr($filename,-2)=="gz")
			$picture="<img src='../../applications/$appname/none_images/tgz.png' align='left' border='0' width='42' height='42' >";

		    if (substr($filename,-2)=="js")
			$picture="<img src='../../applications/$appname/none_images/js.png' align='left' border='0' width='42' height='42' >";

		    if ( strtolower(substr($filename,-4))=="docx")
			$picture="<img src='../../applications/$appname/none_images/docx.png' align='left' border='0' width='42' height='42' >";

		    if ( strtolower(substr($filename,-4))=="xlsx")
			$picture="<img src='../../applications/$appname/none_images/xlsx.png' align='left' border='0' width='42' height='42' >";

		    if (strtolower(substr($filename,-3))=="jpg" || strtolower(substr($filename,-4))=="jpeg" || strtolower(substr($filename,-3))=="bmp" || strtolower(substr($filename,-3))=="tif" || strtolower(substr($filename,-3))=="gif" || strtolower(substr($filename,-3))=="png" || strtolower(substr($filename,-3))=="ico" )
			$picture="";

		    $preview="";
		    if (strtolower(substr($filename,-3))=="png" || strtolower(substr($filename,-3))=="gif" || strtolower(substr($filename,-3))=="jpg" || strtolower(substr($filename,-4))=="jpeg" || strtolower(substr($filename,-3))=="bmp" || strtolower(substr($filename,-3))=="tif" || strtolower(substr($filename,-3))=="ico")
			$preview="$dpath/$filename"; $preview_thumb="../../users/$utente/$cartella/thumbnair/$filename";

		    $ico="<img src='../../applications/$appname/none_images/icon8.gif' valign='middle' border='0'>";
		    echo "<table width='100%' border='0' style='position:relative; top: -25px;'>";
		    echo "<tr><td valign='top'>";
		    echo "<div class='file'>";
		    echo "<table width='100%' border='0' cellspacing='0'><tr>";
		    echo "<td  valign='center' align='center' width='2'>";

		    if ($preview!="")echo "<a href='$preview' rel='lightbox'><img src='$preview_thumb' border='0' width='80' height='50'/></a>";
		    //echo "$picture";
		    $vedi_file="
                               <img src='../../applications/$appname/images/info.png' title='[Vedi-File]' onClick='servicecontrol(\"$filename\");' align='right' border='0' width='42' height='42' >";

		    $actionlink="index.php?dpath=$dpath&filename=$filename";

		    $div_vedi_file = "<div  id='divservice$filename' style='display:none; z-index:1' ><table>
	<tr><td> <img src='../../applications/$appname/images/delete.png' title='[Delete-File]' style=' width:48px; height:48px;' onclick=\"javascript:location='$actionlink&action=delete_file';\"></td>
	<td> <img src='../../applications/$appname/images/rename.png' title='[Rename-File]' style=' width:48px; height:48px;' onclick=\"javascript:location='$actionlink&action=rename_file';\"></td>
	<td> <img src='../../applications/$appname/images/clipboard.png' title='[Clipboard-File]' style=' width:48px; height:48px;' onclick=\"javascript:location='$actionlink&action=cut_file';\"></td>
	<td> <img src='../../applications/$appname/images/fileopen.png' title='[Vedi-File]' style=' width:48px; height:48px;' onclick=\"javascript:location='$actionlink&action=vedi_file&vedilink=$viewlink';\"></td>
	</tr></table></div>";

			if (substr($filename,-3)=="mp3" || substr($filename,-3)=="ogg" || substr($filename,-3)=="amr" ) {
			    $vedilink = "<div  id='divtipofile$filename'><a class='' title='[View Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='audiocontrol(\"$filename\");'><span class=''>$picture</span></a></div>";
			} else if (substr($filename,-3)=="amr") {
			    $vedilink = "<div  id='divtipofile$filename'><a class='' title='[View Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='amraudiocontrol(\"$filename\");'><span class=''>$picture</span></a></div>";
			} else {  
			    $vedilink = "<div  id='divtipofile$filename'><a class='' title='[View Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='visualizza(\"$viewlink\");'><span class=''>$picture</span></a></div>";
			}

		    $modlink = "<a class='' title='[Modify Document] "._RILASCIO.date("j.m.y",filemtime("$dpath/$filename"))." - "._SIZE_FILE.round(filesize("$dpath/$filename")/1000)."Kb"."' onClick='visualizza(\"$viewlink\");'><span class=''></span></a>";
		    $downlink = "<div  id='divdownloadfile$filename'><button style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #EEEEEE; color: #000000; font-weight:bold; font-size: 12px;' align='center' onclick=\"location='$actionlink&action=download'\" title='[Download: $filename]'>$filename</button></div>";

		    echo "</td>";
		    echo "<td align='justify' valign='top'>";
		    //echo "<font class='grey_bold'>"._NOME_FILE." </font>";
	       // Admin mini panel
		    if ($utente!=""){
			if ($radiostream!="") { echo "<div  id='divradiostreamfile$filename'><span class=''> $radiostream  $div_vedi_file <!-- $vedi_file  $modlink $cut_file $rename_file $delete_file --> </span></div>";} else { echo "<table><tr><td width='20%'>$ascolta_file</td></tr></table><span class=''> <td>$vedilink</td><td width='100%'>$downlink</td> <td width='100%'>$div_vedi_file</td><!-- $div_vedi_file $vedi_file  $modlink $cut_file $rename_file $delete_file --> </span>"; }
//		    	echo "<button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' align='center' onclick=\"location='$actionlink&action=download'\" title='[Download: $filename]'>[Down: $filename]</button>";
 		    }
		    if ( filemtime("$dpath/$filename")> mktime (0,0,0,date("m"),date("d")-5,  date("Y"))){
		    }

// questo non posso toglierlo altrimenti viene fuori la descrizione della cartella
		    if(strtolower(substr($filename,-4))<>".lnk"){
//			echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$ico <font class='grey_bold'>"._SIZE_FILE." </font>".round(filesize("$dpath/$filename")/1000)."Kb ";
		    }
		    else
//			echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$ico <font class='grey_bold'>"._FILE_REMOTO." </font>";
// questo non posso toglierlo altrimenti viene fuori la descrizione della cartella

		    $dpath1="$dpath/$filename";

		    if(file_exists("$dpath1.updateby.description")){
			if(filesize("$dpath1.updateby.description")>1){
			  //  echo "<br>$ico <font class='grey_bold'>"._UPDATEBY." </font>";
			    $updateby=trim(join(file("$dpath1.updateby.description")));
			  //  echo"<a href='forum/index.php?op=profile&amp;user=$updateby'>$updateby</a>";
			}
		    }
		    if(file_exists("$dpath1.version.description")){
			if(filesize("$dpath1.version.description")>1){
			  //  echo "<br>$ico <font class='grey_bold'>"._VERSION." </font>";

			  //  readfile("$dpath1.version.description");
			}
		    }

		    if(file_exists("$dpath1.description")){
			if(filesize("$dpath1.description")>1){
			    //echo "<br>&nbsp&nbsp&nbsp&nbsp&nbsp$ico <font class='grey_bold'> "._DESCRIPTION."</font> ";
			    //readfile("$dpath1.description");
			    echo "<br>";
			}
		    }

// carica lightbox per la visualizzazione delle immagini //
echo "<script src=\"../../applications/$appname/js/lightbox2.05/js/lightbox_plus.js\" type=\"text/javascript\"></script>";
echo "<link rel=\"stylesheet\" href=\"../../applications/$appname/js/lightbox2.05/css/gallery.css\" type=\"text/css\" media=\"screen\" />";
//------------------------------------------------------ //

		    echo"</td>";
		    echo "<td align='center' valign='center' width='20%' style='padding:3'> $vedi_file";
		    echo "</td>";
		    echo "</tr></table></div>";
		    echo "</td></tr></table>";
		}
		echo "</a>";
	    }
	}
    }
    }
 // Clipboard

    if ($utente!=""){
	echo "<br>";

	echo "<table width='100%' style='position:relative; top: -25px;' ><tr><td class='clipboard_title'>&nbsp;<img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class='black_bold'>Clipboard:</font>&nbsp <img src='../../applications/$appname/none_images/mini_down.gif' align='absmiddle' border='0'> ["._UPDATE_FILES."] ";
	echo "</td></tr></table>";


	foreach(listdir("$updatedir/") as $filename){
	    if ($filename[0]!='.'){
		if (is_dir("$updatedir/$filename")==true){
		    $actionlink="index.php?dpath=$dpath&filename=$filename";
		    $update_dir="<a href='$actionlink&action=update_dir' class='' title='[Restore-Directory]'><img src='../../applications/$appname/images/update.png' align='right' border='0' width='42' height='42' ></a>";
		    $delete_dir="<a href='$actionlink&action=delete_update_dir' class='' title='[Delete-Directory]'><img src='../../applications/$appname/images/delete.png' align='right' border='0' width='42' height='42' ></a>";
		    $vedi_dir="<button style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-weight:bold; font-size: 12px;' align='right' title='[$filename]'><font class='red_bold'>[File: $filename]</font></button>";

		    echo "<table width='100%' border='0' style='position:relative; top: -25px;'>";
		    echo "<tr>";
		    echo "<td valign='top'>";
		    echo "<div class='clipboard'>";
		    echo "<table border='0' width='100%'><tr>";
		    echo "<td valign='top' align='left' width='2%'>";
		    echo "<td ><a align='left' >";

		    echo "$picture";
		    echo "</td>";
		    echo "<td align='justify' valign=top style='padding-right:20;'>";

		    echo "<br>";
		    // Admin mini panel
		    echo "<td><span class=''>$vedi_dir $delete_dir $update_dir <br><font class='black'>"._DATE_UPLOAD."</font> ".date("j.m.y",filemtime("$filename"))."</span></td>";
		    echo "</td></tr></table>\n";
		    echo "</td></tr></table>\n";
		}
	    }
 	    if (is_dir($filename)) $picture="<img src='../../applications/$appname/images/folder.png' align='left' border='0' width='42' height='42' >";
	}

	foreach(listdir("$updatedir/") as $filename){
	    if (substr_count($filename,".description")==0 && substr($filename,-6)!=".count"){
		if (is_dir("$updatedir/$filename")==false){
		    $count=0;
		    $actionlink="index.php?dpath=$dpath&updatedir=$updatedir&filename=$filename";
//		    $update_file="<a href='$actionlink&action=update_file' class='button green' title='[Restore-File]'><span class='icon icon87'></span><span class='label'>[Restore-File]</span></a>";
//		    $delete_file="<a href='$actionlink&action=delete_submitfile' class='button red' title='[Delete-File]'><span class='icon icon87'></span><span class='label'>[Delete-File]</span></a>";

		    $update_file="<a href='$actionlink&action=update_file' class='' title='[Restore-File]'><img src='../../applications/$appname/images/update.png' align='right' border='0' width='42' height='42' ></a>";
		    $delete_file="<a href='$actionlink&action=delete_file' class='' title='[Delete]'><img src='../../applications/$appname/images/delete.png' align='right' border='0' width='42' height='42' ></a>";

		    if ($ext[substr($filename,-3)]!="")
			$picture="<img src='../../applications/$appname/none_images/".$ext[substr($filename,-3)]."' border='0' width='42' height='42' >";
		    else
			$picture="<img src='../../applications/$appname/none_images/unknown.png' border='0' width='42' height='42'>";
		    if (substr($filename,-2)=="gz")
			$picture="<img src='../../applications/$appname/none_images/tgz.png' border='0' width='42' height='42'>";
		    if (substr($filename,-2)=="js")
			$picture="<img src='../../applications/$appname/none_images/js.png' border='0' width='42' height='42' >";

		    if ( strtolower(substr($filename,-4))=="docx")
			$picture="<img src='../../applications/$appname/none_images/docx.png' border='0' width='42' height='42' >";

		    if ( strtolower(substr($filename,-4))=="xlsx")
			$picture="<img src='../../applications/$appname/none_images/xlsx.png' border='0' width='42' height='42' >";

		    $preview="";
		    if (strtolower(substr($filename,-3))=="png" || strtolower(substr($filename,-3))=="gif" || strtolower(substr($filename,-3))=="jpg" || strtolower(substr($filename,-3))=="ico"|| strtolower(substr($filename,-4))=="jpeg")
			$preview="$updatedir/$filename";


		    echo "<table width='100%' border='0' style='position:relative; top: -25px;'>";
		    echo "<tr>";
		    echo "<td valign='top'>";
		    echo "<div class='clipboard'>";
		    echo "<table border='0' width='100%'><tr>";
		    echo "<td valign='top' align='left' width='2%'>";

		    echo "<td ><a align='left' >";
		    if ( $preview!="")
		    	echo "<img src='$preview' border='0' width='84'/></a>";
		    else
		    	echo "<a ><img src='../../applications/$appname/none_images/".$ext[substr($filename,-3)]."' border='0' width='42' height='42'></a>";

		    echo "</td>";

		    //echo "$picture";
		    echo "</td>";
		    echo "<td align='center' valign=center style='padding-right:20;'>";

		    if (substr($filename,-3)=="lnk")
			echo "<a valign='center'><font class='red_bold'>$filename</font></a>";
		    else
			echo "<td><a ><font class='red_bold'>$filename</font></a>";
		    echo "<br><font class='black'> - "._DATE_UPLOAD." </font> ".date("j.m.y",filemtime("$updatedir/$filename"))."";

		    if(strtolower(substr($filename,-4))<>".lnk"){
			echo "<br><font class='black'> - "._SIZE_FILE." </font>".round(filesize("$updatedir/$filename")/1000)."Kb </td>";
		    }
		    else
			echo "<br><font class='black'> - "._FILE_REMOTO." </font></td>";

		    $dpath1="$updatedir/$filename";
		   // echo " - <font class='black'>"._UPDATEBY." </font>";

			echo "<td><span class='admin_panel'>$delete_file $update_file</span></td>";

		    echo "";
			//if ($preview!="")echo "<td align='left'><a href='$preview' ><img src='$preview' border='0' width='84'/></a></td>";
		    echo "</tr></table></div>";
			echo "</td></tr></table>";
	    }
	}
    }

    }
}
//__________________________________________________________________________________________________________________________________

//protezione da path "strani"
if($dpath[0]=='.' &&$dpath[1]!='.')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='..')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='./')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='/')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='//')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='../')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='../.')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='../..')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if($dpath=='../../')$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if ($dpath=="")$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if ($dpath=="../../users/$utente/$cartella/")$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if ($dpath=="../../users/$utente/")$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";
if ($dpath=="../../users/$utente/")$dpath="../../users/$utente/$cartella/LibreOfficeWebData/";


    if ($utente!=""){

    $constants=get_defined_constants();
    $menutitle=$constants["_".strtoupper($action)];
	echo "<table border='0' width='100%'><tr><td valign='top'>";
//	echo "<div id='change'><div class='left_panel'>";
//	echo "<div class='menu_title'>";
	echo "<div id='change'><div class=''>";
	echo "<div class=''>";
	if ($utente!=""){
		echo "&nbsp;$menutitle";
		if ($menutitle=="") /*echo "Files - File Manager</br></br>";*/	dirtitle(substr($dpath, 6));
		echo "</div>";
		//	$actionlink="index.php?dpath=$dpath";
?>
		</div>
<?
		//dirtitle($dpath);
		echo "</div></div>";
    }
    echo "</td>";

// l'albero degli eventi
    switch($action){
	case "download":
	    download($dpath);
	    break;
	case "help":
	    help($dpath);
	    break;
	case "top_download":
	    top_download($dpath);
	    break;
	case "search":
	    search($dpath);
	    break;
	case "exec_search":
	    exec_search($dpath);
	    break;
	case "add_link":
	    add_link($dpath);
	    break;
	case "exec_add_link":
	    exec_add_link($dpath);
	    break;
	case "update_file":
	    update_file($dpath);
	    break;
	case "add_file":
	    add_file($dpath);
	    break;
	case "add_new_file_docx":
	    new_file_docx($dpath);
	    break;
	case "add_new_file_xlsx":
	    new_file_xlsx($dpath);
	    break;
	case "add_new_file_odg":
	    new_file_odg($dpath);
	    break;
	case "add_new_file_odb":
	    new_file_odb($dpath);
	    break;
	case "rename_file":
	    rename_file($dpath);
	    break;
	case "exec_rename_file":
	    exec_rename_file($dpath);
	    break;
	case "cut_file":
		cut_file($dpath);
		break;
	case "exec_cut_file":
	    exec_cut_file($dpath);
	    break;
	case "delete_file":
	    delete_file($dpath);
	    break;
	case "exec_delete_file":
	    exec_delete_file($dpath);
	    break;
	case "add_dir":
	    add_dir($dpath);
	    break;
	case "exec_add_dir":
	    exec_add_dir($dpath);
	    break;
	case "rename_dir":
	    rename_dir($dpath);
	    break;
	case "exec_rename_dir":
	    exec_rename_dir($dpath);
	    break;
	case "cut_dir":
	    cut_dir($dpath);
	    break;
	case "update_dir":
	    update_dir($dpath);
	    break;
	case "delete_update_dir":
	    delete_update_dir($dpath);
	    break;
	case "exec_delete_update_dir":
	    exec_delete_update_dir($dpath);
	    break;
	case "delete_dir":
	    delete_dir($dpath);
	    break;
	case "exec_delete_dir":
	    exec_delete_dir($dpath);
	    break;
	case "exec_deltree_dir":
	    exec_deltree_dir($dpath);
	    break;
	case "vedi_dir":
	    vedi_dir($dpath);
	    break;
	case "setting":
	    setting();
	    break;
	case "vedi_file":
	    vedi_file($dpath);
	    break;
	default:
	    dirlist($dpath);
	    break;
    }
    }

?>
