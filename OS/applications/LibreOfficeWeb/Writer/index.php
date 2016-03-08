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

$updatefiles="../../../users/".$utente."/".$cartella."/LibreOfficeWebData/"."none_updatefiles";

// la dimensione massima di un file
$maxFileSize=20000000;

//echo ini_get('upload_max_filesize'), ", " , ini_get('post_max_size');


// scarica le variabili che servono
$dpath=$_GET['dpath']; //echo "PERCORSO ATTUALE: ".$dpath;

$action=$_GET['action'];
$appname ="LibreOfficeWeb";
$zip_op=$_GET['zip_op'];

$filename=$_GET['filename'];

$progetto=$_GET["progetto"];
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

$progetto=$_GET["progetto"];

$actionlink="index.php?dpath=$dpath";


//__________________________________________________________________________________________________________________________________
/**
 * La funzione predispone un nuovo documento writer
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param 
 * @param 
 */
function add_new_file_docx($dpath){
$progetto=$_POST["progetto"];
$dpath1=$dpath.$progetto;
echo "<span style=\"position: fixed; top: -20px; left: 220px; z-index: 100;\" ><h2><b>$progetto.docx</b></h2></span>";
echo "
<br><br>
</head>
<body>
				<div id='editor' style='width: \'100%\'; ' >

				</div>
<script>
	initSample();
</script>
<style>
body {
font-family: sans-serif, Arial, Verdana, \"Trebuchet MS\";
width: 210mm;
height: 297mm;
background-color: #ffffff;
/*margin: 17mm;
padding-left: 10mm;*/
        margin-left:auto;
        margin-right:auto;
}

@page {
size: landscape;
width: 297mm;
height: 210mm;
margin: 5mm;
}
</style>
</body>
</html>
";

}


?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>Dplus - WebOffice - Writer</title>
	<meta name="description" content="LibreOfficeWeb - Writer">     
	<script type="text/javascript" src="./ckeditor_standard/jquery-1.11.1.min.js"></script>
	<script src="./ckeditor_personal/ckeditor.js"></script>
	<script src="./ckeditor_personal/samples/js/sample.js"></script>
	<link rel="stylesheet" href="./ckeditor_personal/samples/css/samples.css">
	<link rel="stylesheet" href="./ckeditor_personal/samples/toolbarconfigurator/lib/codemirror/neo.css">
<!-- caricamento dei righelli -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../js/ruler/ruler.css">
	<script type="text/javascript" src="../js/ruler/jquery.ruler.js"></script>
<script>
$(function() {
  $('body').ruler();    
});
</script>
<!-- caricamento dei righelli -->
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
<input type='image' src="../images/menu.png" id="nav_list1" border=0 WIDTH="40" HEIGHT="40" hspace="10" vspace="10"  align="left" /><br><br><br><br>
    <a href="index.php?action=search"><input type='image' src="../images/search.png" onclick="javascript: location.href='index.php?action=search';" title="[<?=_SEARCH?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_dir"><input type='image' src="../images/folder-add.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_dir';" title="[<?=_ADD_FOLDER?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_file"><input type='image' src="../images/uploads-file.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
<?php
echo "<a><input type='image' src='../../$appname/none_images/docx.png' onclick=\"javascript: getElementById('progetto').value=prompt('Nome Documento',''); if (getElementById('progetto').value != '') { newdocx.submit();};\" title=\"["._ADD_FILE."]\" border=0 WIDTH=\"32\" HEIGHT=\"32\" /></a>";
echo "<form id='newdocx' name='newdocx' action='index.php?dpath=$dpath&progetto=$progetto&action=add_new_file_docx' method='post'>";
echo "<input type='hidden' name='progetto' id='progetto' value=''>";
echo "</form>";
?>
    <a href="<?=$actionlink;?>&action=add_new_file_xlsx"><input type='image' src="../none_images/xlsx.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_new_file_odg"><input type='image' src="../none_images/odg.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="<?=$actionlink;?>&action=add_new_file_odb"><input type='image' src="../none_images/odb.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_file';" title="[<?=_ADD_FILE?>]" border=0 WIDTH="32" HEIGHT="32" /></a>

    <a href="<?=$actionlink;?>&action=add_link"><input type='image' src="../images/insert-link.png" onclick="javascript: location.href='<?=$actionlink;?>&action=add_link';" title="[<?=_ADD_LINK_WEB?>]" border=0 WIDTH="32" HEIGHT="32" /></a>
    <a href="/WEB_DESKTOP/OS/applications/_reguser/index.php?user_op=modavatar"> <input type='image' src="../images/setting.png" onclick="javascript: location.href='/WEB_DESKTOP/OS/applications/_reguser/index.php?user_op=modavatar';" title="<?=_MODIFICA_IMPOSTAZIONI?>" border=0 WIDTH="32" HEIGHT="32" /></a>


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

<input type='image' src="../images/menu.png" id="nav_list" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0"  align="left" />
<input type='image' src="../none_images/Libre-Office.png" onclick="javascript: location.href='index.php';" title="Benvenuto in Libre Office Web" border=0 WIDTH="48" HEIGHT="42" hspace="3" vspace="0" align="left" />
<input type='image' src="../images/previous.png" onclick="location.href='../index.php';" title="[Back to Home]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
<input type='image' src="../images/system-help.png" onclick="" title="[Help]" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="left" />
<?    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
			<input style="position:fixed; right: 5px; z-index: 20;" type='image' src="<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="right" />
		<?php } else { ?>
			<input style="position:fixed; right: 5px; z-index: 20;" type='image' src="../libs/avatars/<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="42" HEIGHT="42" hspace="3" vspace="0" align="right" />
		<?php } ?>
<div id='barretta' style='position:fixed;  z-index: 20; top: 50px; height:5px; width:100%; background-color: red;' ></div>
</div>


<?php

$utente=$_COOKIE["utente"];
$action=$_GET['action'];
$dpath=$_GET["dpath"];

    if ($utente!=""){

// l'albero degli eventi
    switch($action){
	case "help":
	    //help($dpath);
	    break;
	case "search":
	    search($dpath);
	    break;
	case "exec_search":
	    exec_search($dpath);
	    break;
	case "add_new_file_docx":
	    add_new_file_docx($dpath);
	    break;
	case "add_new_file_xlsx":
	    add_new_file_xlsx($dpath);
	    break;
	default:
$progetto=$_POST["progetto"];
$dpath1=$dpath.$progetto;
echo "<span style=\"position: fixed; top: -20px; left: 220px; z-index: 100;\" ><h2><b>$progetto.docx</b></h2></span>";
?>
<br><br>
</head>
<body>
				<div id="editor" style="width: '100%'; " >
					<h1>Hello world!</h1>
					<p>I'm an instance of <a href="http://ckeditor.com">CKEditor</a>.</p>
				</div>
<script>
	initSample();
</script>
<style>
body {
font-family: sans-serif, Arial, Verdana, "Trebuchet MS";
width: 210mm;
height: 297mm;
background-color: #ffffff;
/*margin: 17mm;
padding-left: 10mm;*/
        margin-left:auto;
        margin-right:auto;
}

@page {
size: landscape;
width: 297mm;
height: 210mm;
margin: 5mm;
}
</style>
</body>
</html>
<?php
}
}
?>

