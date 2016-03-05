<?php
/************************************************************************/
//ini_set(session.gc_maxlifetime, '2592000'); 
//ini_set(session.cookie_lifetime, '2592000');
//session_start();
//echo "Nome Sessione: ".session_name(); //restituisce il nome della sessione
//echo "<br>";
//echo "ID Sessione: ".session_id(); //restituisce l'ID
//echo "<br>";
//$PHPSESSID=session_id();
//echo "PHPSESSID: ".$PHPSESSID;
//echo "<br>";
//echo $_SESSION['cartella'];
// session_register("nomevariabile");//Salviamo una variabile nella sessione, ne possiamo salvare quante ne vogliamo
// $nomevariabile=...;//Definiamo la variabile

$utente_tmp = $_POST['user'];

$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

//Per eliminare una specifica variabile di sessione useremo:
//unset($_SESSION['username']);

//Per eliminare tutte le variabili di sessione useremo:
//$_SESSION = array();

//Per distruggere la sessione
//session_destroy();
/************************************************************************/
define('APPREGUSER','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//carica la lingua se esiste
define("_REGUSER","Registrazione Utenti su D+");
define("_LOGIN","Accedi su D+");
define("_REGISTRAZIONE","registrazione");
define("_LISTA_UTENTI_REGISTRATI","lista utenti registrati");
define("_GRUPPI_X_GRUPPI","gruppi x gruppi");
define("_GRUPPI_X_UTENTI","gruppi x utenti");
define("_OBBLIGATORIO","<i>(Campi Obbligatori)</i>");
define("_USER","Utente:");
define("_PASSWORD","Password:");
define("_CAMBIAPASSWORD","Modifica Password D+");
define("_RICHIEDIPASSWORD","Password D+ Dimenticata");
define("_OLD_PASSWORD","Vecchia Password:");
define("_WELCOME","Benvenuto");
define("_RETYPE_PASSWORD","Nuova Password:");
define("_REINSERT_PASSWORD","Reinserisci Password:");
define("_NOME","Nome:");
define("_EMAIL","Email:");
define("_SITO_WEB","Sito WEB");
define("_PROFESSIONE","Professione");
define("_PROVENIENZA","Provenienza");
define("_AVATAR","Avatar");
define("_IMMAGINE_URL","Immagine URL");
define("_FIRMA","Firma");
define("_THEME","Theme");
define("_LANG","Lingua");
define("_CAPCHA","Capcha");
define("INSERISCI IL TESTO VISUALIZZATO QUI SOPRA","inserisci il testo visualizzato qui sopra");
define("_GRAZIE","Grazie");
define("_PER_ESSERTI_REGISTRATO","per esserti registrato");
define("_ORA_RICEVERAI_UNA_MAIL","Ora riceverai una mail");
define("_ORA_PUOI","Ora puoi");
define("_ENTRARE","entrare");
define("_PASSWORD_NON_CORRETTA_REINSERIRE","password non digitata correttamente in entrambi i campi:inserire nuovamente");
define("_REGISTER_USER","Registra Utente");
define("_UPDATE_USER","Aggiorna Utente");
define("_UPDATE_USER_D","Aggiorna Utente D+");
define("_REMOVE","Elimina");
define("_GRUPPI","Gruppi di appartenenza");
define("_USEREMAIL","Inserisci Utente");
define("_FORWARD_PASSWORD","Invio nuova Password by e-mail");
define("_FORWARD_ME_PASSWORD","Inviami una nuova Password alla mia casella e-mail");
define("_NOTIFICHE","D+ Notifiche");
define("_SPACES","D+ Spaces");
define("_COLOREDATARIO","Colore del Datario:");
define("_COLORESFONDO","Colore di Sfondo:");
define("_IMMAGINESFONDO","Immagine di Sfondo PC:");
define("_IMMAGINESFONDO_PHONE","Immagine di Sfondo Mobile:");
define("_TIMERS","D+ Timers");

define("_COMANDO_VOCALE","Comando");
define("_COMANDO_VOCALE_URL","URL Comando");

define("_ADD_SPEEK_COMMAND","Aggiungi Comando");
define("_RESET_SPEEK_COMMAND","Azzera Campi");
define("_ELIMINA_SPEEK_COMMAND","Elimina Comando");
//_________________________________________________________________________________________

// start-up le prime operazioni all'avvio la prima volta
if (!file_exists("../../users/datas"))mkdir("../../users/datas",0755);
if (!file_exists("../../users/datas/config"))mkdir("../../users/datas/config",0755);
//_________________________________________________________________________________________

// caricamento librerie

/**
 * loadlib ***************************************************************
 * La funzione include al volo una libreria (costruita per le librerie non in autoloading)
 *
 * @author FW-TEAM
 * @version 20070422
 * @since   20070422
 * @param string $lib Valore del nome della libreria da includere
 */
function loadlib($lib){
    if (!defined(strtoupper($lib))){
	if (is_dir("libs/$lib")){
	    include "libs/$lib/lib.inc";
	    return true;
	}
	else{
	    if (file_exists("libs/$lib.inc")){
		include "libs/$lib.inc";
		return true;
	    }
	}
    }
    else{
	return true;
    }
    return false;
}

loadlib('libConfig');
loadlib('libMain');
//loadlib('libAdmin');

loadlib('libUsers');
//loadlib('libGroup');
loadlib('libMsgusers');
//loadlib('libPrint');

/************************************************************************/
function user_mod_del_speak_command() {
 $user=$_COOKIE["utente"];
 $user_avatar=user_getkey($user,"user_avatar");
 $user_lang=user_getkey($user,"user_lang");$lang=substr($user_lang, 0, 2);
 $cartella=$_COOKIE["cartella"];		

echo "<html>
	<head>
<meta name='theme-color' content='#D8D8D8'>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	</head>";
/*echo"	<center>
	<form name='moddelspeakcommand' action='index.php?user_op=moddel_modspeakcommand' method='post' enctype='multipart/form-data' onsubmit=''>
	<img src='_images/icons-speak.jpg' onclick='window.location=\"index.php?user_op=user_mod_del_speak_command\";' border='0' name='speek-setting' style='position: fixed; top: 0px; left: 0px;' WIDTH='50' HEIGHT='50' />
	<br>
	<input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='comando' type='text' value='' onclick=\"this.value = document.getElementById('parla').value;\" placeholder='"._COMANDO_VOCALE."' /> <br>
	<br>
	<input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='esecuzione' type='text' value='' placeholder='"._COMANDO_VOCALE_URL."' />
	<br><br>
	PopUp: <input type=\"checkbox\" name=\"popup\" value='popup' style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />
	<br><br>
	<input style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' type='submit' value='"._ADD_SPEEK_COMMAND."'>
	<input style='border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' type='reset' value='"._RESET_SPEEK_COMMAND."'><br/>
	</form>
	<a href='index.php?user_op=modavatar'><button style='position: fixed; top: 20px; right: 0px; border: 1px solid #D8D8D8; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #D8D8D8; color: #000000; font-weight:bold; font-size: 12px;' title='[Setting]' ><span class='label'>S<br>e<br>t<br>t<br>i<br>n<br>g<br></span></button></a>
	<a href='index.php'><button style='position: fixed; top: 200px; right: 0px; border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: orange; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>H<br>o<br>m<br>e<br></span></button></a>
	</center>
</html>";
*/
echo "<br>";
echo "<br>";
echo "<br>";
echo "<img src='_images/icons-speak.jpg' onclick='window.location=\"index.php?user_op=user_mod_del_speak_command\";' border='0' name='speek-setting' style='position: absolute; top: 5px; left: 20px;' WIDTH='50' HEIGHT='50' />";
echo "<a href='index.php?user_op=modavatar'><button style='position: fixed; top: 20px; right: 0px; border: 1px solid #D8D8D8; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #D8D8D8; color: #000000; font-weight:bold; font-size: 12px;' title='[Setting]' ><span class='label'>S<br>e<br>t<br>t<br>i<br>n<br>g<br></span></button></a>";
echo "<a href='index.php'><button style='position: fixed; top: 200px; right: 0px; border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: orange; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>H<br>o<br>m<br>e<br></span></button></a>";
echo "<a href='index.php?user_op=user_mod_speak_command'><button style='position: fixed; bottom: 20px; right: 0px; border: 1px solid skyblue; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: skyblue; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>C<br>o<br>m<br>m<br>a<br>n<br>d<br></span></button></a>";

$lista=join(file("../../users/$user/$cartella/speek-".$lang.".js"));
$riga = explode("\n", $lista);
// riconteggio array 
$righe=count($riga); //echo "numero righe: ".$righe."<br><br><br>";

 for($i=0;$i<$righe-1;$i++){ 
	echo "<div style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:15px; padding-bottom:15px; padding-right:5px; padding-left:5px; background-color: GOLD; color: #000000; font-weight:bold; font-size: 16px;' href=''>";
		echo   "<div class='' id='divriga[$i]' style='width: 100%;'>";
		if (strpos($riga[$i],"window.open(\"")){ 
				$esecuzione[$i] = strpos($riga[$i],"window.open(\"") +13;
				$resto[$i] = strpos($riga[$i], "\",'");
				$resto[$i] = $resto[$i] - $esecuzione[$i];
				$finestra[$i] = 'CHECKED';}
				else { 
				$esecuzione[$i] = strpos($riga[$i],"location.href=\"") +15;
				$resto[$i] = strpos($riga[$i], "\",'");
				$resto[$i] = $resto[$i] - 4; $finestra[$i] = '';}
		if (strpos($riga[$i],"speak('")){ 
				$esecuzione[$i] = strpos($riga[$i],"speak('") +7;
				$resto[$i] = strpos($riga[$i], "')");
				$resto[$i] = $resto[$i] - $esecuzione[$i];
				$rispvoc[$i] = 'CHECKED';
		}
			$comando[$i] = strpos($riga[$i],"{") -3;
			$comando[$i] = $comando[$i] - 16;
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PopUp: <input type=\"checkbox\" name=\"popup\" value=\"popup\" $finestra[$i] style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RispVoc: <input type=\"checkbox\" name=\"rispvoc\" value=\"RispVoc\" $rispvoc[$i] style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />";
			echo "<br>";
			echo "&nbsp;&nbsp;Comando: ".substr($riga[$i], 16, $comando[$i]);
			echo "<br>";
			echo "Esecuzione: ".substr($riga[$i], $esecuzione[$i], $resto[$i]);
			echo "<br>";
		//echo "PopUp: ".$finestra;
		//echo "<br>";
		echo "</div>";
		echo "<form name=\"moddelspeakcommand$i\" id=\"moddelspeakcommand$i\" action=\"index.php?user_op=moddel_modspeakcommand&riga=$i\" method=\"post\" enctype=\"multipart/form-data\">";
		echo "<input type='submit' style='position: relative; border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:30px; padding-left:30px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' value='"._ELIMINA_SPEEK_COMMAND."' onclick='alert(\"Eliminato Comando Riga: $i\");' >";
		echo "</form>";
	echo "</div>";
//echo "<br>";
 }

// $fp=fopen("../../users/$user/$cartella/speek-".$lang.".js","r");
// echo fread($fp, filesize("../../users/$user/$cartella/speek-".$lang.".js"));  

//fwrite($fp, " if (lancia == \"".$comando."\") { location.href=\"".$esecuzione."\" };\n" );
//fwrite($fp, " if (lancia == \"".$comando."\") { window.open(\"".$esecuzione."\",'".$comando."','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no'); };\n" );

die();
}
/************************************************************************/
function user_ele_speak_command() {
 $user=$_COOKIE["utente"];
 $user_avatar=user_getkey($user,"user_avatar");
 $user_lang=user_getkey($user,"user_lang");$lang=substr($user_lang, 0, 2);
 $cartella=$_COOKIE["cartella"];		

echo "<html>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	</head>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<img src='_images/icons-speak.jpg' onclick='window.location=\"index.php?user_op=user_ele_speak_command\";' border='0' name='speek-setting' style='position: absolute; top: 5px; left: 20px;' WIDTH='50' HEIGHT='50' />";
echo "<a href='index.php?user_op=modavatar'><button style='position: fixed; top: 20px; right: 0px; border: 1px solid #D8D8D8; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #D8D8D8; color: #000000; font-weight:bold; font-size: 12px;' title='[Setting]' ><span class='label'>S<br>e<br>t<br>t<br>i<br>n<br>g<br></span></button></a>";
echo "<a href='index.php'><button style='position: fixed; top: 200px; right: 0px; border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: orange; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>H<br>o<br>m<br>e<br></span></button></a>";
echo "<a href='index.php?user_op=user_mod_speak_command'><button style='position: fixed; bottom: 20px; right: 0px; border: 1px solid skyblue; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: skyblue; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>C<br>o<br>m<br>m<br>a<br>n<br>d<br></span></button></a>";

$lista=join(file("../../users/$user/$cartella/speek-".$lang.".js"));
$riga = explode("\n", $lista);
// riconteggio array 
$righe=count($riga); //echo "numero righe: ".$righe."<br><br><br>";

 for($i=0;$i<$righe-1;$i++){ 
	echo "<div style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:15px; padding-bottom:15px; padding-right:5px; padding-left:5px; background-color: GOLD; color: #000000; font-weight:bold; font-size: 16px;' href=''>";
		echo   "<div class='' id='divriga[$i]' style='width: 100%;'>";
		if (strpos($riga[$i],"window.open(\"")){ 
				$esecuzione[$i] = strpos($riga[$i],"window.open(\"") +13;
				$resto[$i] = strpos($riga[$i], "\",'");
				$resto[$i] = $resto[$i] - $esecuzione[$i];
				$finestra[$i] = 'CHECKED';}
				else { 
				$esecuzione[$i] = strpos($riga[$i],"location.href=\"") +15;
				$resto[$i] = strpos($riga[$i], "\",'");
				$resto[$i] = $resto[$i] - 4; $finestra[$i] = '';}
		if (strpos($riga[$i],"speak('")){ 
				$esecuzione[$i] = strpos($riga[$i],"speak('") +7;
				$resto[$i] = strpos($riga[$i], "')");
				$resto[$i] = $resto[$i] - $esecuzione[$i];
				$rispvoc[$i] = 'CHECKED';
		}
			$comando[$i] = strpos($riga[$i],"{") -3;
			$comando[$i] = $comando[$i] - 16;
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PopUp: <input type=\"checkbox\" name=\"popup\" value=\"popup\" $finestra[$i] style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RispVoc: <input type=\"checkbox\" name=\"rispvoc\" value=\"RispVoc\" $rispvoc[$i] style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />";
			echo "<br>";
			echo "&nbsp;&nbsp;Comando: ".substr($riga[$i], 16, $comando[$i]);
			echo "<br>";
		//	echo "Esecuzione: ".substr($riga[$i], $esecuzione[$i], $resto[$i]);
		//	echo "<br>";
		//echo "PopUp: ".$finestra;
		//echo "<br>";
		echo "</div>";
		//echo "<form name=\"moddelspeakcommand$i\" id=\"moddelspeakcommand$i\" action=\"index.php?user_op=moddel_modspeakcommand&riga=$i\" method=\"post\" enctype=\"multipart/form-data\">";
		//echo "<input type='submit' style='position: relative; border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:30px; padding-left:30px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' value='"._ELIMINA_SPEEK_COMMAND."' onclick='alert(\"Eliminato Comando Riga: $i\");' >";
		//echo "</form>";
	echo "</div>";

 }
die();
}
/************************************************************************/
function user_mod_speak_command() {
 $user=$_COOKIE["utente"];
// $user=user_getuser();
 $user_avatar=user_getkey($user,"user_avatar");
 $user_lang=user_getkey($user,"user_lang");

echo "<html>
	<head>
<meta name='theme-color' content='orange'>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	</head>";
?>
<link rel="stylesheet" href="../../js/speech-input/speech-input.css">
<style>
.si-wrapper input {
	padding: .4em;
}
</style>
<div style="position: fixed; bottom: 2px; left: 2%;" class="si-wrapper">
	<input type="text" class="si-input" id="parla" name="parla" style="border: 0; background-color:white; width: 250px; height:50px;" onchange="" placeholder="What up">
	<button style="margin-right:0px;" class="si-btn">
		speech input
		<span style="margin-right:0px;" class="si-mic"></span>
		<span style="margin-right:0px;" class="si-holder"></span>
	</button>
</div>
<script src="../../js/speech-input/old-speech-input.js"></script>
<?php 

echo"	<center>
	<form name='modspeakcommand' action='index.php?user_op=add_modspeakcommand' method='post' enctype='multipart/form-data' onsubmit=''>
	<img src='_images/icons-speak.jpg' onclick='window.location=\"index.php?user_op=user_mod_speak_command\";' border='0' name='speek-setting' style='position: fixed; top: 0px; left: 0px;' WIDTH='50' HEIGHT='50' />
	<br>
	<input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='comando' type='text' value='' onclick=\"this.value = document.getElementById('parla').value;\" placeholder='"._COMANDO_VOCALE."' /> <br>
	<br>
	<input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='esecuzione' type='text' value='' placeholder='"._COMANDO_VOCALE_URL."' />
	<br><br>
	PopUp: <input type=\"checkbox\" name=\"popup\" value='popup' style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />
	Risposta Vocale: <input type=\"checkbox\" name=\"rispvoc\" value='rispvoc' style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />
	<br>
	Contatto: <input type=\"checkbox\" name=\"contatto\" value='contatto' style='width: 30px; height: 30px; vertical-align:middle; cursor: pointer; border: 1px solid skyblue; background-color: white; color: #000000;' />
	<br><br>
	<input style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' type='submit' value='"._ADD_SPEEK_COMMAND."'>
	<input style='border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' type='reset' value='"._RESET_SPEEK_COMMAND."'><br/>
	</form>
	<a href='index.php?user_op=modavatar'><button style='position: fixed; top: 20px; right: 0px; border: 1px solid #D8D8D8; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #D8D8D8; color: #000000; font-weight:bold; font-size: 12px;' title='[Setting]' ><span class='label'>S<br>e<br>t<br>t<br>i<br>n<br>g<br></span></button></a>
	<a href='index.php'><button style='position: fixed; top: 200px; right: 0px; border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: orange; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>H<br>o<br>m<br>e<br></span></button></a>
	<a href='index.php?user_op=user_mod_del_speak_command'><button style='position: fixed; top: 70px; left: 0px; border: 1px solid #2ECCFA; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #2ECCFA; color: #000000; font-weight:bold; font-size: 12px;' title='[Home]' ><span class='label'>M<br>o<br>d<br><br>V<br>o<br>c<br>a<br>l<br><br>C<br>o<br>m<br>m<br>a<br>n<br>d<br></span></button></a>
	</center>
</html>";
die();
}

/************************************************************************/
function rec_user_modavatar() {
 $user=$_COOKIE["utente"];
// $user=user_getuser();
 $avatar = $_POST['avatar'];
 $lang = $_POST['lang'];
 $email = $_POST['email'];
 $ext_avatar = $_POST['ext_avatar'];
 $coloredatario=$_POST['coloredatario'];
 $coloresfondo=$_POST['coloresfondo'];
 $immaginesfondo=$_POST['immaginesfondo'];
 $immaginesfondo_phone=$_POST['immaginesfondo_phone'];
if ($ext_avatar!="")$avatar=$ext_avatar;

    if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
		user_setkey($user,"user_avatar",$avatar);
		user_setkey($user,"user_lang",$lang);
		user_setkey($user,"user_email",$email);
		user_setkey($user,"user_coloredatario",$coloredatario);
		user_setkey($user,"user_coloresfondo",$coloresfondo);
		user_setkey($user,"user_immaginesfondo",$immaginesfondo);
		user_setkey($user,"user_immaginesfondo_phone",$immaginesfondo_phone);
		setcookie("user_avatar","$avatar",mktime(0,0,0,1,1,2025),"/","");
    }
    else{
	echo "Imposibile modificare l'avatar Utente <br><a href='index.php'>continua</a>";
	die();
    }

// $user_avatar=user_getkey($user,"user_avatar");

//user_setkey($user,"user_nome",$nome);
//user_setkey($user,"user_email",$email);
//user_setkey($user,"user_web",$web);
//user_setkey($user,"user_professione",$professione);
//user_setkey($user,"user_provenienza",$provenienza);
//user_setkey($user,"user_avatar",$avatar);
//user_setkey($user,"user_firma",$firma);
//user_setkey($user,"user_theme",$theme);
//user_setkey($user,"user_lang",$lang);

}

/************************************************************************/
/**
 * modifica password user
 *
 * La routine modifica le opzioni base un utente gia registrato
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_modavatar(){
 $user=$_COOKIE["utente"];
// $user=user_getuser();
 $user_avatar=user_getkey($user,"user_avatar");
 $user_lang=user_getkey($user,"user_lang");
 $user_email=user_getkey($user,"user_email");
 $user_coloredatario=user_getkey($user,"user_coloredatario");
 $user_coloresfondo=user_getkey($user,"user_coloresfondo");
 $user_immaginesfondo=user_getkey($user,"user_immaginesfondo");
 $user_immaginesfondo_phone=user_getkey($user,"user_immaginesfondo_phone");
echo "<script type='text/javascript' src='../../js/jscolor/jscolor.js'></script>";
echo "<html>
	<head>
<meta name='theme-color' content='#D8D8D8'>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	</head>";
echo      "<center><h2><font color='red'><b>"._UPDATE_USER_D."</font></b></h2></center>";
echo 	  "<div STYLE='position:center; top:10px; align:20px' 'width:100%; height:100%'  name='cambiaavatar' >";
// echo "<center><img src='libs/avatars/$user_avatar' border='1' name='pre_avatar' />";
echo "<center>";
echo"<form name='moduseravatar' action='index.php?user_op=rec_moduseravatar' method='post' enctype='multipart/form-data' onsubmit=''>";
    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
		    <img src="<?=$user_avatar?>" border='1' name='pre_avatar' WIDTH='50' HEIGHT='50' />
		<?php } else { ?>
		    <img src="libs/avatars/<?=$user_avatar?>" border='1' name='pre_avatar' WIDTH='50' HEIGHT='50' />
		<?php } ?>
	    <br />
	    <select name='avatar' onchange="document.moduseravatar.pre_avatar.src='libs/avatars/'+moduseravatar.avatar.options[moduseravatar.avatar.selectedIndex].text" style='width: 60%; border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' >
		<?php
		    $hdir=opendir("libs/avatars");
		    $i=0;
		    while (false !== ($f= readdir($hdir))){
			if ($f[0]!="." && substr($f,-3,3)!="inc"){
			    $listfiles[$i]=$f;
			    $i++;
			}
		    }
		    echo("<option style='width: 60%; height: border: 2px solid skyblue; padding-top:28px; padding-bottom:8px; padding-right:5px; padding-left:5px;' >$user_avatar</option>\n");
		    foreach( $listfiles as $filesel){
			    echo("<option style='width: 60%; border: 2px solid skyblue; padding-top:28px; padding-bottom:8px; padding-right:5px; padding-left:5px;'>$filesel</option>\n");
		    }
		?>
	    </select>
	   <br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='ext_avatar' type="text" value="" onkeyup="document.moduseravatar.pre_avatar.src=''+document.moduseravatar.ext_avatar.value" placeholder="<?=_IMMAGINE_URL;?>" /> <br />
	    <br />
	    <hr /><div>
	    <?=_LANG;?><br />
	    <select name='lang' style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' >
		<?Php echo("<option>$user_lang</option>\n"); ?>
		<option >it - italiano</option>
		<option >en - english</option>
	    </select>
		<img src="_images/icons-speak.jpg" onclick="mod_speak_command();" border="0" name="speek-setting" style="position: fixed; top: 50px; right: 5px;" WIDTH='50' HEIGHT='50' />
		<br><br><hr/>
	    <?=_EMAIL;?>
	    <br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email' type="text" value="<?=$user_email;?>" placeholder="<?=_EMAIL;?>" /><br><br>
	    <hr />
	    <?=_COLOREDATARIO;?>
	    <br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' class='color' name='coloredatario' type="text" value="<?=$user_coloredatario;?>" placeholder="<?=_COLOREDATARIO;?>" /><br><br>
	    <hr />
	    <?=_COLORESFONDO;?>
	    <br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' class='color' name='coloresfondo' type="text" value="<?=$user_coloresfondo;?>" placeholder="<?=_COLORESFONDO;?>" /><br><br>
	    <hr />
	    <?=_IMMAGINESFONDO;?>
	    <br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='immaginesfondo' type="text" value="<?=$user_immaginesfondo;?>" placeholder="<?=_IMMAGINESFONDO;?>" /><br><br>
	    <hr />
	    <?=_IMMAGINESFONDO_PHONE;?>
	    <br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='immaginesfondo_phone' type="text" value="<?=$user_immaginesfondo_phone;?>" placeholder="<?=_IMMAGINESFONDOPHONE;?>" /><br><br>
	    <hr />
	    <input style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' type="submit" value="<?=_UPDATE_USER;?>"><br />
	  </form></center>

<center><a style='border: 1px solid orange; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;' href='index.php'>Home</a></center><br><br>
<?php
echo "</div>
<!--------------------------------------------------------------------------------------------------------->
<!--
Copyright 2011 Google Inc.

Licensed under the Apache License, Version 2.0 (the \"License\");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an \"AS IS\" BASIS,
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

<div id='connection' style='position:fixed; top:20px; right:7%; z-index: 30; ' >Connecting...<div></div></div>
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
  // Get updates from server.
}, false);

window.addEventListener('offline', function(e) {
//  updateConnectionStatus('Offline', false);
  updateConnectionStatus('', false);
  // Use offine mode.
}, false);
</script>
<!--------------------------------------------------------------------------------------------------------->
</html>";

?>
<script>
//----------------------------------------------------------------------------------------------------------
function mod_speak_command() {
	window.location="index.php?user_op=user_mod_speak_command";
}
//----------------------------------------------------------------------------------------------------------
</script>
<?php

die();
}

/**
 * modifica password user
 *
 * La routine modifica le opzioni base un utente gia registrato
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_modpassword(){
    $user=$_COOKIE["utente"];
//    $user=user_getuser();
    $password=xcrypt($_POST['password']);
    $password1=xcrypt($_POST['password1']);

    if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
	if ($_POST['password1']!=$_POST['password'])
	    user_setkey($user,"user_password",$password1);
    }
    else{
	echo "Imposibile modificare la Password gia registrato <br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }
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
//echo "sono nella funzione";
//echo "Modifica Dati Utente ".$user." effettuata !!!<br>";
  if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
    $keylist=@file("../../users/$user/".sb_get($user)."/$user");
    foreach($keylist as $l=> $key_value){
	if (strpos($key_value,$key)!==false){
	    $nl=$l;
	    break;
	}
    }
    $keylist[$nl]="<?  \$$key=\"$value\";  ?>\n";
    $fp=fopen("../../users/$user/".sb_get($user)."/$user","w");
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
 * La routine registra un nuovo utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function user_reguser(){
    $user=$_POST['user'];
    $user_password=xcrypt($_POST['password1']);
    $user_nome=$_POST['nome'];
    $user_email=$_POST['email'];
    $user_web=$_POST['web'];
    $user_professione=$_POST['professione'];
    $user_provenieza=$_POST['provenienza'];
    $user_avatar=$_POST['avatar'];
    $user_ext_avatar=$_POST['ext_avatar'];
    if ($user_ext_avatar!="")$user_avatar=$ext_avatar;
    $user_firma=$_POST['firma'];

    $user_capchacode=$_POST['capchacode'];
    $user_capchakey=$_POST['capchakey'];

    $user_theme=$_POST['theme'];
    $user_lang=$_POST['lang'];

// $user_coloresfondo=$_POST['coloresfondo'];
// $user_immaginesfondo=$_POST['immaginesfondo'];

    if (!file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
/*	if (loadlib("libCapcha") && !capcha_test($capchacode,$capchakey)){
	    echo "Capcha code errato: devi ripetere la registrazione <br><a href='index.php'>continua</a>";
	    httplog();
	    die();
	} */
	//touch("../../users/$user/".sb_get($user)."/$user");
    $fp=fopen("../../users/$user/".sb_get($user)."/$user","w");
    fwrite($fp, "<?  \$user=\"$user\";  ?>\n"); //user_setkey($user,"user",$user); 
    fwrite($fp, "<?  \$user_password=\"$user_password\";  ?>\n"); //user_setkey($user,"user_password",$password);
    fwrite($fp, "<?  \$user_email=\"$user_email\";  ?>\n"); //user_setkey($user,"user_email",$email);
    fwrite($fp, "<?  \$user_avatar=\"$user_avatar\";  ?>\n"); //user_setkey($user,"user_avatar",$avatar);
    fwrite($fp, "<?  \$user_lang=\"$user_lang\";  ?>\n"); //user_setkey($user,"user_lang",$lang); */
/*    fwrite($fp, "<?  \$user_coloresfondo=\"$user_coloresfondo\";  ?>\n"); 
    fwrite($fp, "<?  \$user_immaginesfondo=\"$user_immaginesfondo\";  ?>\n"); */
    fclose($fp);

	//user_setkey($user,"user",$user);
	//user_setkey($user,"user_password",$password);
	//user_setkey($user,"user_nome",$nome);
	//user_setkey($user,"user_email",$email);
	//user_setkey($user,"user_web",$web);
	//user_setkey($user,"user_professione",$professione);
	//user_setkey($user,"user_provenienza",$provenienza);
	//user_setkey($user,"user_avatar",$avatar);
	//user_setkey($user,"user_firma",$firma);
	//user_setkey($user,"user_theme",$theme);
	//user_setkey($user,"user_lang",$lang);
	//user_setkey($user,"user_firstdaylogin",date("Y.m.d"));
	//user_setkey($user,"user_lastdaylogin",date("Y.m.d"));
	//user_setkey($user,"user_currentdaylogin",date("Y.m.d"));

	// se nella configurazione del sito allora si usa l'abilitazione utente da mail
/*	if(get_config("gestione_mails/b-reg_with_email","")=="on") {
	    $magic=rand(10,9999);
	    user_setkey($user,"user_enable_login",$magic);
	    // richiamo routine per invio mail per eventuale abilitazione utente //
	    send_mail_enabled_login($magic);
	}
	else { */
	    //user_setkey($user,"user_enable_login","1");
/*	} */
    }
    else{
	echo "user gia registrato <br><a href='index.php'>continua</a>";
//	httplog();
	die();
    }
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
function united_user_login(){
  $user=$_POST['user'];
  $password=xcrypt($_POST['password']);
  $cartella=sb_get($user);

  if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
	include "../../users/$user/".sb_get($user)."/$user";
    }
    else{
	echo "user inesistente <br><a href='index.php'>continua</a>";
	die();
    }

    if ($user_password==$password){
	setcookie("user","$user||$password",time()+899999999,"/");
	setcookie("utente","$user",mktime(0,0,0,1,1,2025),"/","");
	setcookie("cartella","$cartella",mktime(0,0,0,1,1,2025),"/","");
	setcookie("user_avatar","$user_avatar",mktime(0,0,0,1,1,2025),"/","");
	echo "<script language=javascript>window.location='index.php';</script>";
    }
    else{
	echo "password non corretta <br><a href='index.php'>continua</a>";
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
function united_user_logout(){
    setcookie("user","",NULL,"/");
    setcookie("utente","",NULL,"/");
    setcookie("cartella","",NULL,"/");
    setcookie("user_avatar","",NULL,"/");
    echo "<script language=javascript>window.location='index.php';</script>";
}

/************************************************************************/
/**
 * united reguser 
 *
 * La routine permette la registrazione utente
 *
 * @author FW-TEAM
 * @version 20070518
 * @since   20070518
 */
function united_user_reguser(){
echo 	  "<div STYLE='position:center; top:10px; align:20px' 'width:100%; height:100%'  name='register' >";
	//echo "</br>";
?>
      <center><h2><font color='red'><b><?=_REGUSER;?></b></font></h2></center><hr />
      <?php
	// $user=user_getuser(); echo $user;
	    $avatar=$_GET['avatar'];
	    if ($avatar!="")$user_avatar=$avatar;//autoreload dell'avatar
	if ($user=="" ){  //hai scelto la registrazione user
         if ($_GET['user_op']=="reguser"){
	//se ti devi registrare ?><center>
          <form name="reguser" action="index.php?user_op=reg_reguser" method="post" enctype="multipart/form-data" onsubmit="if( document.reguser.password1.value != document.reguser.password2.value ){alert('<?=_PASSWORD_NON_CORRETTA_REINSERIRE;?>');return false;} ">
            <font color='red'><b><?=_OBBLIGATORIO;?></b></font><br/>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='user' type="test" value="" placeholder="<?=_USER;?>" /><br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email' type="text" value="" placeholder="<?=_EMAIL;?>" /><br><br>
	    <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='password1' type="password" value="" placeholder="<?=_PASSWORD;?>" /><br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='password2' type="password" value="" placeholder="<?=_REINSERT_PASSWORD;?>"/>
	    <br/>
	    <?=_AVATAR;?><br />
	    <?php
    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
		    <img src="<?=$user_avatar?>" border='1' name='pre_avatar' />
		<?php } else { ?>
		    <img src="libs/avatars/<?=$user_avatar?>" border='1' name='pre_avatar' />
		<?php } ?>
	    <br />
	    <select name='avatar' onchange="document.reguser.pre_avatar.src='libs/avatars/'+reguser.avatar.options[reguser.avatar.selectedIndex].text" >
		<?php
		    $hdir=opendir("libs/avatars");
		    $i=0;
		    while (false !== ($f= readdir($hdir))){
			if ($f[0]!="." && substr($f,-3,3)!="inc"){
			    $listfiles[$i]=$f;
			    $i++;
			}
		    }
		    echo("<option>$user_avatar</option>\n");
		    foreach( $listfiles as $filesel){
			    echo("<option>$filesel</option>\n");
		    }
		?>
	    </select>
	   <br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='ext_avatar' type="text" value="" onkeyup="document.reguser.pre_avatar.src=''+document.reguser.ext_avatar.value" placeholder="<?=_IMMAGINE_URL;?>" /> <br />
	    <br />
	    <?=_LANG;?><br />
	    <select name='lang' >
		<?Php echo("<option>$user_lang</option>\n"); ?>
		<option >it - italiano</option>
		<option >en - english</option>
	    </select>
	    <br />
	    <input style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;' type="submit" value="<?=_REGISTER_USER;?>"><br />
	  </form></center>
        <?php }else{ //se ti sei appena registrato ?>
          <b> <?=_GRAZIE;?> <?=$_POST['user'] ?> <?=_PER_ESSERTI_REGISTRATO;?> <b><br/>
	  <?php if(get_config("gestione_mails/b-reg_with_email","")=="on"){ ?>
	    <b><?=_ORA_RICEVERAI_UNA_MAIL;?> <i><?=_ENTRARE;?></i></b>
	  <?php }else{ ?>
          <b><?=_ORA_PUOI;?> <i><?=_ENTRARE;?></i></b> <a href='index.php'>  continua  </a>
	  <?php } ?>
        <?php } ?>
      <?php }else{ // se sei gia autenticato ?>
	<? include "../../users/$utente_tmp/".sb_get($utente_tmp)."/users/$utente_tmp";
	$avatar=$_GET['avatar'];
	if ($avatar!="")$user_avatar=$avatar;//autoreload dell'avatar
	?>
	    <br />
	    <br />
      <?php  } ?>
<br>
<center><a style='border: 1px solid orange; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;' href='index.php'>Home</a></center>
<?php
echo "</div>";
//break;
}

/************************************************************************/
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

  if (file_exists("../../users/$user/".sb_get($user)."/$user") && $user!=""){
	include "../../users/$user/".sb_get($user)."/$user";
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

/************************************************************************/
function dirsize($dir)
{
  // apro la cartella
  @$dh = opendir($dir);
  // creo una variabile
  $size = 0;
  // ciclo il contenuto della cartella
  while ($file = @readdir($dh))
  {
    // verifico che si tratti di file o cartelle
    if ($file != "." and $file != "..") 
    {
      // percorso della risorsa
      $path = $dir."/".$file;
      
      // se è una cartella...
      if (is_dir($path))
      {
        // richiamo la funzione in modo ricorsivo
        $size += dirsize($path);
      }
      // se è un file
      elseif (is_file($path))
      {
        // incremento col peso del file
        $size += filesize($path);
      }
    }
  }
  // chiudo
  @closedir($dh);
  // restituisco la dimensione in termini di bytes
  return $size;
}
/************************************************************************/

// start-up le prime operazioni all'avvio la prima volta
if (!file_exists("../../users"))mkdir("../../users");

  if (file_exists("../../users/$utente_tmp/".sb_get($utente_tmp)."/$utente_tmp") && $utente_tmp!=""){

// if ($utente_tmp != "") {
    mkdir("../../users/$utente_tmp");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp));

// if (!file_exists("../../users/$utente_tmp/index.php")) {
    $fp=fopen("../../users/$utente_tmp/index.php","a");
    fwrite($fp,"\n");
    fclose($fp);
// }
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/Cestino");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/Syncro");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Documenti");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Immagini");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Musica");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Scaricati");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Video");

    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/files");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/files/none_updatefiles");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/files/Music");
    mkdir("../../users/$utente_tmp/".sb_get($utente_tmp)."/files/Music/mp3");

 if (!file_exists("../../users/$utente_tmp/".sb_get($utente_tmp)."/pwc-os.css")) {

    copy("../../pwc-os.css","../../users/$utente_tmp/".sb_get($utente_tmp)."/pwc-os.css");

    copy("../../wallpaper/wallpapers-computers.jpg","../../users/$utente_tmp/".sb_get($utente_tmp)."/home/Immagini/wallpapers-computers.jpg");

    copy("../../taskbar-start-panel-bg.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbar-start-panel-bg.gif");
    copy("../../taskbar-start-panel-blue.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbar-start-panel-blue.gif");
    copy("../../taskbar-start-panel-green.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbar-start-panel-green.gif");
    copy("../../taskbar-start-panel-red.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbar-start-panel-red.gif");
    copy("../../taskbar-start-panel-yellow.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbar-start-panel-yellow.gif");
    copy("../../taskbuttons-panel-bg.gif","../../users/$utente_tmp/".sb_get($utente_tmp)."/taskbuttons-panel-bg.gif");
//    copy("../../users/Deskicons/browser.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/browser.desk");
    copy("../../users/Deskicons/cachemate.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/cachemate.desk");
//    copy("../../users/Deskicons/FMRadio.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/FMRadio.desk");
//    copy("../../users/Deskicons/calculator.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/calculator.desk");
    copy("../../users/Deskicons/talk.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/talk.desk");
//    copy("../../users/Deskicons/apps_maps.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/apps_maps.desk");
//    copy("../../users/Deskicons/earth.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/earth.desk");
    copy("../../users/Deskicons/DPlus.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/DPlus.desk");
    copy("../../users/Deskicons/DPlusFeedReader.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/DPlusFeedReader.desk");
    copy("../../users/Deskicons/DPlusImages.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/DPlusImages.desk");
    copy("../../users/Deskicons/DPlusMaps.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/DPlusMaps.desk");
    copy("../../users/Deskicons/Mega.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/Mega.desk");
    copy("../../users/Deskicons/contacts.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/contacts.desk");
    copy("../../users/Deskicons/facebook.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/facebook.desk");
    copy("../../users/Deskicons/files3.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/files3.desk");
    copy("../../users/Deskicons/cachemate.desk","../../users/$utente_tmp/".sb_get($utente_tmp)."/Deskicons/cachemate.desk");
 }
// }
    }
//-------------------------------------------------------------------------------------------------------------------------
$user=$_COOKIE["utente"];
if ($user != "") {
$user_lang=user_getkey($user,"user_lang");
if ($user_lang == "it - italiano") { echo "<script>var dayarray=new Array(\"Domenica\",\"Lunedi'\",\"Martedi'\",\"Mercoledi'\",\"Giovedi'\",\"Venerdi'\",\"Sabato\"); var montharray=new Array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre')</script>"; }
if ($user_lang == "en - english") { echo "<script>var dayarray=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'); var montharray=new Array('January','February','March','April','May','June','July','August','September','October','November','December')</script>"; }
$user_coloredatario=user_getkey($user,"user_coloredatario");
if ($user_coloredatario != "") { echo "<script>var coloredatario='$user_coloredatario';</script>"; } else { echo "<script>var coloredatario='black';</script>"; }
}
//-------------------------------------------------------------------------------------------------------------------------
?>
<script>
/*
Live Date Script- © Dynamic Drive (www.dynamicdrive.com)
For full source code, installation instructions, 100's more DHTML scripts, and Terms Of Use,
visit http://www.dynamicdrive.com
*/
//var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
//var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
function getthedate(){
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var hours=mydate.getHours()
var minutes=mydate.getMinutes()
var seconds=mydate.getSeconds()
var dn="AM"
if (hours>=12)
dn="PM"
if (hours>12){
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
//change font size here
var cdate="<font color='"+coloredatario+"' face='Arial'><a title='"+dayarray[day]+" "+daym+" "+montharray[month]+" "+year+"'><b>"+hours+":"+minutes+":"+seconds+" "+dn+" <br> "+dayarray[day]+" "+daym+" "+montharray[month]+" "+year
+"</b></font>"
if (document.all)
document.all.clock.innerHTML=cdate
else if (document.getElementById)
document.getElementById("clock").innerHTML=cdate
else
document.write(cdate)
}
if (!document.all&&!document.getElementById)
getthedate()
function goforit(){
if (document.all||document.getElementById)
setInterval("getthedate()",1000)
}
</script>

<?php
//----------------------------------------------------------------------------------------------------------
$user_op=$_GET['user_op'];
if ($user_op !=""){
    switch ($user_op){
        case "reguser":
		united_user_reguser();
		break;
        case "reg_reguser":
		user_reguser();
		break;
        case "moduser":
		user_moduser();
		break;
        case "modpassword":
		user_modpassword();
		break;
        case "modavatar":
		user_modavatar();
		break;
	case "rec_moduseravatar":
		rec_user_modavatar();
		break;
        case "deluser":
		user_deluser();
		break;
        case "login":
		// aggiunto //
		echo "<script>localStorage.setItem('utente','".$_POST['user']."');\n</script>"; // salvataggio dati
		echo "<script>localStorage.setItem('password','".$_POST['password']."');\n</script>"; // salvataggio dati
		// aggiunto //
        	united_user_login();
        	break;
        case "logout":
		echo "<script>localStorage.clear();</script>"; // rimuove completamente tutte le voci dell'istanza
		setcookie("user","",NULL,"/");
		setcookie("utente","",NULL,"/");
		setcookie("cartella","",NULL,"/");
		setcookie("user_avatar","",NULL,"/");
		united_user_logout();
		break;
        case "killuser":
		user_killuser();
		break;
        case "completereg":
		user_completereg();
		break;
        case "rememberpassw":
		send_rnd_password();
        	break;
        case "user_ele_speak_command":
		user_ele_speak_command();
        	break;
        case "user_mod_del_speak_command":
		user_mod_del_speak_command();
        	break;
        case "moddel_modspeakcommand":
		$user=$_COOKIE["utente"];
		$cartella=$_COOKIE["cartella"];		
		$user_lang=user_getkey($user,"user_lang");$lang=substr($user_lang, 0, 2);
		//$fp=fopen("../../users/$user/$cartella/speek-".$lang.".js","r+");
		$riga = $_GET['riga'];
		$righe = file("../../users/$user/$cartella/speek-".$lang.".js");
		unset($righe[$riga]);
		$fp = fopen("../../users/$user/$cartella/speek-".$lang.".js", "w+");
		foreach ($righe AS $key => $rig)
		   fputs($fp, $rig);
		fclose($fp);
		//echo "Eliminata riga: ".$riga;
		header('Location: index.php?user_op=user_mod_del_speak_command');
        	break;
        case "user_mod_speak_command":
		user_mod_speak_command();
        	break;
        case "add_modspeakcommand":
		$user=$_COOKIE["utente"];
		$cartella=$_COOKIE["cartella"];		
		$user_lang=user_getkey($user,"user_lang");$lang=substr($user_lang, 0, 2);
		$comando = strtolower($_POST['comando']);
		$esecuzione = $_POST['esecuzione'];
		$popup = $_POST['popup'];
		$rispvoc = $_POST['rispvoc'];
		$contatto = $_POST['contatto'];
		if ($comando != "" || $esecuzione != "") {
			$fp=fopen("../../users/$user/$cartella/speek-".$lang.".js","a");
			if ($rispvoc <> "") {
			fwrite($fp, " if (lancia == \"".$comando."\") { meSpeak.speak('".$esecuzione."') };\n" );
			fclose($fp); 
			echo "<script>alert('Comando Caricato !!!');</script>";
			user_mod_speak_command();
			}
		if ($contatto <> "") {
			fwrite($fp, " if (lancia == \"".$comando."\") { location.href=\"http://dplus.altervista.org/WEB_DESKTOP/OS/applications/contacts/index.php?dpath=&action=exec_search&vocale=".$esecuzione."\" };\n" );
			}
		if ($contatto == "") {
			if ($popup == "") {
				fwrite($fp, " if (lancia == \"".$comando."\") { location.href=\"".$esecuzione."\" };\n" );
			} else {
				fwrite($fp, " if (lancia == \"".$comando."\") { window.open(\"".$esecuzione."\",'".$comando."','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no'); };\n" );
				}
		}
			fclose($fp); 
			echo "<script>alert('Comando Caricato !!!');</script>";
			user_mod_speak_command();
		}
		if ($comando == "" || $esecuzione == "") {
		echo "<script>alert('Inserisci il Comando e il Link per poterlo Caricare !!!');</script>";
		user_mod_speak_command();
		}
        	break;

   }
}
echo "<span style='position:fixed; top:0px; left:15px;  z-index: 20;' id='clock'></span>";
/*echo "
<div style='position:fixed; top:5px; right:75px; z-index: 20; border: 3px black solid; height: 10px; width: 30px;'> 
    <div id='indicatoreBatteria'></div> 
</div> 
";
*/
echo "<script> goforit(); </script>";
echo      "<br><br><center><h1><font color='red'><b>"._LOGIN."</font></b></h1></center>";
echo 	  "<div>";
define('APPLOGIN','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//carica la lingua se esiste
$lang=lang();
if (file_exists("../applications/_reguser/lang/$lang.inc"))
    include "../applications/_reguser/lang/$lang.inc";
else
    include "../applications/_reguser/lang/it.inc";

	$user=$_COOKIE["utente"];
//	$user=user_getuser();
	$cartella=sb_get($user);
	$user_avatar=user_getkey($user,"user_avatar");
	$user_avatar_path="libs/avatars/$user_avatar";
 	echo "<script>localStorage.setItem('cartella','".$cartella."');\n</script>"; // salvataggio dati
 	echo "<script>localStorage.setItem('user_avatar','".$user_avatar."');\n</script>"; // salvataggio dati
//	$id = xsha1($user); echo "CRIPTATO: ".$id."<br>";
//	$path = xsha1($cartella); echo "CRIPTATO: ".$path;
//				setcookie("utente","$user",mktime(0,0,0,1,1,2025),"/","");
//				setcookie("cartella","$cartella",mktime(0,0,0,1,1,2025),"/","");
//				setcookie("user_avatar","$user_avatar",mktime(0,0,0,1,1,2025),"/","");
 $coloresfondo=user_getkey($user,"user_coloresfondo");
 $immaginesfondo=user_getkey($user,"user_immaginesfondo");
 $immaginesfondo_phone=user_getkey($user,"user_immaginesfondo_phone");
if ($immaginesfondo == "")$immaginesfondo="null";
echo "<script>var sfondo = '$immaginesfondo';</script>";
$spath = "../../users/$user/$cartella/$user";
$tpath = "../D_Plus/datas/saves/$user"; //echo $spath."<br>".$tpath;
if (file_exists("../D_Plus/datas/saves/$user") && $user!=""){
	//echo "il file esiste"; echo "---------------".$spath."<br>"; echo "---------------------------".$tpath."<br>";
    } else{
	//echo "il file NON esiste";
    if (!copy($spath, $tpath)) { //echo "Copia di $spath non riuscita ...\n";
}
    }
//-------------------------------------------------------------------------------------------------------------------------
$user=$_COOKIE["utente"];
$user_coloredatario=user_getkey($user,"user_coloredatario");
if ($user_coloredatario == "") { $user_coloredatario='black'; }
?>
<html>
	<head>
		<meta name="theme-color" content="#3F51B5">
		<meta charset="utf-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	</head>

<?php
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if ($iphone || $android || $palmpre || $ipod || $berry == true){
			?> <body style="background-color:<?=$coloresfondo;?>; background-image:url(<?=$immaginesfondo_phone;?>); background-size: 100% 100%; "> <?php
		} else {
			?> <body style="background-color:<?=$coloresfondo;?>; background-image:url(<?=$immaginesfondo;?>); background-size: 100% 100%; "> <?php
		}

?>

<!--  <body style="background-color:<?=$coloresfondo;?>; background-image:url(<?=$immaginesfondo;?>); background-size: 100% 100%; "> -->


    <center><h3></h3></center><br />
      <?php /*$user=user_getuser(); */ 	$user=$_COOKIE["utente"]; $user_op=$_GET['user_op']; if ($user_op!="reguser") {
	if ($user==""){ ?>
        <form name="login" action="index.php?user_op=login" method="post" enctype="multipart/form-data">
        <center> <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='user' type="text" value="" placeholder="<?=_USER;?>" /><br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='password' type="password" value="" placeholder="<?=_PASSWORD;?>" /></center>
        <br />
	<center><button style='border: 1px solid blue; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: blue; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Login</span></button></center>
        </form>
	<center><button onclick="richiedipassword();" style='border: 1px solid orange; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Password-Dimenticata</span></button></center>
	<br>
	<div id="richiedipassword" style="display:none" class="ipuser" >
	<center><h2><font color='red'><b><?=_RICHIEDIPASSWORD;?></b></font></h2></center>
        <!--<center><h3><?=_FORWARD_PASSWORD;?></h3></center><hr/>-->
        <form name="requirepassword" action="index.php?user_op=rememberpassw" method="post" enctype="multipart/form-data">
        <center><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='user' type="text" value="" placeholder="<?=_USEREMAIL;?>" /></center>
        <br>
	<center><button style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span ><?=_FORWARD_ME_PASSWORD;?></span></button></center>
        </form>
        <br /></div>
        <form name="reguser" action="index.php?user_op=reguser" method="post" enctype="multipart/form-data">
	<center><button style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Register</span></button></center>
        </form>
     <?php }else{ ?>
        <?php if ($user_avatar=user_getkey($user,"user_avatar")) { ?>
	<center>
	    <?php if ($user_avatar!="") {
		if (substr($user_avatar,0,4)=="http"){ $_COOKIE['user_avatar'] = $user_avatar; $_COOKIE['cartella'] = sb_get($user); ?> 
	      	    <a href="index.php"><img src="<?=$user_avatar?>"  style=" -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px;" WIDTH='120' HEIGHT='120' /> <!--  <a href="../../applications/_reguser/index.php?user_op=modavatar"> <input type="image" src="_images/setting.png" onclick="javascript: location.href=\'\';" title="[Setting]" style="position:fixed; right: 0px; -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px;" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0" /></a><br></a> -->
    		    <a href="../../applications/_reguser/index.php?user_op=modavatar"><button style="position: fixed; top: 50px; right: 0px; border: 1px solid #D8D8D8; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:6px; padding-left:6px; background-color: #D8D8D8; color: #000000; font-weight:bold; font-size: 12px;" title="[Setting]" ><span class="label">S<br>e<br>t<br></span></button></a>
		<?php } else { $_COOKIE['user_avatar'] = "libs/avatars/$user_avatar";  $_COOKIE['cartella'] = sb_get($user); ?>
		    <a href="index.php"><img src="libs/avatars/<?=$user_avatar?>"  style=" -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px;" WIDTH='120' HEIGHT='120'/><a href="../../applications/_reguser/index.php?user_op=modavatar"><input type="image" src="_images/setting.png" onclick="javascript: location.href=\'\';'" title="[Setting]" style="position:fixed; right: 0px; -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px;" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0" /></a></a><br>
<!--		    <a href="../../applications/_reguser/index.php?user_op=modavatar"> <input type="image" src="_images/setting.png" onclick="javascript: location.href=\'\';" title="[Setting]" style="position:fixed; right: 0px; -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px;" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0" /></a><br></a> -->
		<?php } ?>
	    <?php } ?>
	</center>
	<?php } ?>
	<center><font color="<?=$user_coloredatario;?>" face='Arial'><b><?=_WELCOME;?></b> <a href="index.php"><?=$user;?></a></font></center>
	<br/>
        <form action="index.php?user_op=logout"  method="post" enctype="multipart/form-data">
	<center><button style='border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Logout</span></button></center>
        </form>
      <?php }
?>
      <br />
      <?php /*$user=user_getuser(); */ 	$user=$_COOKIE["utente"]; if ($user<>""){ ?>
	<center><button onclick="cambiapassword();" style='border: 1px solid blue; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: blue; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Modifica-Password</span></button></center>
	<br>
	<div id="cambiapassword" style="display:none" class="ipuser" >
	<center><h2><font color='red'><b><?=_CAMBIAPASSWORD;?></b></font></h2></center>
        <form name="modpassword" action="index.php?user_op=modpassword" method="post" enctype="multipart/form-data">
        <center><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='password' type="password" value="" placeholder="<?=_OLD_PASSWORD;?>" /><br><br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='password1' type="password" value="" placeholder="<?=_RETYPE_PASSWORD;?>" /></center>
        <br>
	<center><button style='border: 1px solid #41A317; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >Salva-Password</span></button></center>
        </form>
        <br /></div>
     <?php } 
 /*       $user=user_getuser(); if ($user<>""){ ?>
	<center><button onclick="richiedipassword();" style='border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >[Password-Dimenticata]</span></button></center>
	<br>

	<div id="richiedipassword" class="ipuser" >
	<center><h2><font color='red'><b><?=_RICHIEDIPASSWORD;?></b></font></h2></center>
        <!--<center><h3><?=_FORWARD_PASSWORD;?></h3></center><hr/>-->
        <form name="requirepassword" action="index.php?user_op=rememberpassw" method="post" enctype="multipart/form-data">
        <center><input name='user' type="text" value="" placeholder="<?=_USEREMAIL;?>" /></center>
        <br>
	<center><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span ><?=_FORWARD_ME_PASSWORD;?></span></button></center>
        </form>
        <hr /></div>
      <?php } */
	//echo "</br>";
// ---------------------------------------------------------------------------------------------------------------------
?>
<link rel="stylesheet" href="../../js/speech-input/speech-input.css">
<style>
.si-wrapper input {
	padding: .4em;
}
</style>
<div style="position: fixed; bottom: 8%; right: 0px;" class="si-wrapper">
	<input type="text" class="si-input" id="parla" name="parla" style="border: 0; background-color:transparent; width: 15px; height:70px;" onchange="javascript: var lancia = parla.value; lanciatore(lancia);" placeholder="What up"> <!--<br><input style="float:right; margin-right:0px;" type="button" id="avvia" name="avvia" value="GO" onClick="javascript: var lancia = parla.value; lanciatore(lancia);" /> -->
	<button style="margin-right:0px;" class="si-btn">
		speech input
		<span style="margin-right:0px;" class="si-mic"></span>
		<span style="margin-right:0px;" class="si-holder"></span>
	</button>
</div>
<script src="../../js/speech-input/speech-input.js"></script>
<?php 
//  echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
?>
<!--
<style>
.menu, .submenu, .item {
  content: "";
  position: absolute;
  border-radius: 50%;
  left: calc(50% - 10em);
  top: calc(50% - 10em);
  width: 20em;
  height: 20em;
}
</style>


<?php
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if ($iphone || $android || $palmpre || $ipod || $berry == true){
			?> 
				<style>
				.radialnav {
				  position: fixed;
				  width: 20em;
				  height: 20em;
				  bottom: -20%;
				  left: 1%;
				  display: block;
				  font: 500 14px/14px arial normal;
				  transform: rotate(-90deg);
				}
				</style>
			<?php
		} else {
			?> 
				<style>
				.radialnav {
				  position: fixed;
				  width: 20em;
				  height: 20em;
				  bottom: -10%;
				  right: 2%;
				  display: block;
				  font: 500 14px/14px arial normal;
				  transform: rotate(-90deg);
				}
				</style>
			<?php
		}

?>

<style>
.radialnav a {
  color: white;
  text-decoration: none;
}
.radialnav .ellipsis {
  position: absolute;
  right: 40%;
  bottom: 39%;
  z-index: 12;
  width: 60px;
  height: 60px;
  border-radius: 100%;
  background: #1976D2;
  color: white;
  text-align: center;
  transform: rotate(90deg);
  box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.44);
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.radialnav .ellipsis i {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -7px 0 0 -7px;
}
.radialnav .ellipsis:active, .radialnav .ellipsis:hover {
  box-shadow: 0px 4px 7px 0px rgba(0, 0, 0, 0.44);
  background: #2083e4;
}
.radialnav a {
  color: white;
  text-decoration: none;
}
.radialnav.active .ellipsis {
  box-shadow: 0px 4px 7px 0px rgba(0, 0, 0, 0.44);
  background: #2083e4;
}
.radialnav.active .menu {
  pointer-events: auto;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.menu, .submenu {
  position: relative;
  -webkit-transform: scale(0.1);
  -ms-transform: scale(0.1);
  -moz-transform: scale(0.1);
  transform: scale(0.1);
  pointer-events: none;
  -webkit-transition: all .15s ease;
  -moz-transition: all .15s ease;
  transition: all .15s ease;
}

.item, .item:nth-child(n+7):after {
  clip: rect(0, 20em, 20em, 10em);
}
.item a, .item:nth-child(n+7):after a {
  display: block;
  color: white;
  content: "";
  position: absolute;
  border-radius: 50%;
  left: calc(50% - 10em);
  top: calc(50% - 10em);
  width: 20em;
  height: 20em;
  clip: rect(0, 10em, 20em, 0);
  /*&:active, &:hover {
    background-color: lighten(#1976D2, 30%);
  }*/
}
.item a i, .item:nth-child(n+7):after a i {
  position: absolute;
  top: 6%;
  right: 57%;
  font-size: 21px;
}

.item:after, .item:nth-child(n+7) {
  content: "";
  position: absolute;
  border-radius: 50%;
  left: calc(50% - 10em);
  top: calc(50% - 10em);
  width: 20em;
  height: 20em;
  clip: rect(0, 10em, 20em, 0);
}

.submenu {
  z-index: 13;
}
.submenu .item a {
  /*&:active, &:hover {
    background-color: lighten(#388E3C, 30%);
  }*/
}
.submenu .item a i {
  font-size: 27px;
}
.submenu.active {
  pointer-events: auto;
  -webkit-transform: scale(0.7);
  -moz-transform: scale(0.7);
  -ms-transform: scale(0.7);
  transform: scale(0.7);
}

.item:nth-child(1):after {
  background-color: #1976D2;
  transform: rotate(30deg);
  z-index: 6;
}

.item:nth-child(1) > a {
  transform: rotate(30deg);
  z-index: 7;
}

.submenu .item:nth-child(1):after {
  background-color: #388E3C;
}

.item:nth-child(2):after {
  background-color: #03A9F4;
  transform: rotate(60deg);
  z-index: 5;
}

.item:nth-child(2) > a {
  transform: rotate(60deg);
  z-index: 6;
}

.submenu .item:nth-child(2):after {
  background-color: #8BC34A;
}

.item:nth-child(3):after {
  background-color: #1976D2;
  transform: rotate(90deg);
  z-index: 4;
}

.item:nth-child(3) > a {
  transform: rotate(90deg);
  z-index: 5;
}

.submenu .item:nth-child(3):after {
  background-color: #388E3C;
}

.item:nth-child(4):after {
  background-color: #03A9F4;
  transform: rotate(120deg);
  z-index: 3;
}

.item:nth-child(4) > a {
  transform: rotate(120deg);
  z-index: 4;
}

.submenu .item:nth-child(4):after {
  background-color: #8BC34A;
}

.item:nth-child(5):after {
  background-color: #1976D2;
  transform: rotate(150deg);
  z-index: 2;
}

.item:nth-child(5) > a {
  transform: rotate(150deg);
  z-index: 3;
}

.submenu .item:nth-child(5):after {
  background-color: #388E3C;
}

.item:nth-child(6):after {
  background-color: #03A9F4;
  transform: rotate(180deg);
  z-index: 1;
}

</style>

    <nav class="radialnav">
  <a href="#" class="ellipsis"><i class="fa fa-bars"></i></a>
  <ul class="menu">
    <li class="item">
      <a href="#"><i class="fa fa-home"></i></a>
      <ul class="submenu">
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/contacts/index.php"><i class="fa fa-user"></i></a></li>
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/index.php"><i class="fa fa-desktop"></i></a></li>
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/foto/index.php"><i class="fa fa-file-image-o"></i></a></li>
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/FW_Files/index.php"><i class="fa fa-file"></i></a></li>
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/D_Plus_FeedReader/index.php"><i class="fa fa-rss"></i></a></li>
      </ul>
    </li>
    <li class="item">
      <a href="#"><i class="fa fa-empire"></i></a>
      <ul class="submenu">
        <li class="item"><a href="javascript: window.open('https://www.facebook.com/','Facebook','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-facebook"></i></a></li>
        <li class="item"><a href="javascript: window.open('https://twitter.com/','Twitter','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-twitter"></i></a></li>
        <li class="item"><a href="javascript: window.open('https://plus.google.com/','Google Plus','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-google-plus-square"></i></a></li>

        <li class="item"><a href="http://instagram.com/wbarahona" target="_blank"><i class="fa fa-instagram"></i></a></li>
        <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/tamtam/index.php"><i class="fa fa-weixin"></i></a></li>
      </ul>
    </li>
   <li class="item"><a href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/_reguser/index.php?user_op=modavatar"><i class="fa fa-sliders"></i></a></li>
<!--   <li class="item"><a href="#"><i class="fa fa-cubes"></i></a></li> -->
<!--
    <li class="item"><a href="javascript: window.open('https://mail.google.com/','Google GMail','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-envelope"></i></a></li>
    <li class="item">
      <a href="#"><i class="fa fa-pencil"></i></a>
      <ul class="submenu">
        <li class="item"><a href="javascript: window.open('https://drive.google.com/keep/','Google Keep','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-sticky-note-o"></i></a></li>
        <li class="item"><a href="javascript: window.open('https://drive.google.com/','Google Drive','width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no');"><i class="fa fa-database"></i></a></li>
        <li class="item"><a href="#"><i class=""></i></a></li>
        <li class="item"><a href="#"><i class=""></i></a></li>
        <li class="item"><a href="#"><i class=""></i></a></li>
      </ul>
    </li>
  </ul>
</nav>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
var thisButton,
    thisMenuItem,
    thisSubmenuItem,
    pieMenu = $('.radialnav'),
    menuItems  = $('.menu > .item > a'),
    submenu = $('.submenu'),
    submenuItems = $('.submenu > .item > a'),
    submenuId = 0;

function openMenu (thisButton) {
  if(!thisButton.hasClass('active'))
    thisButton.addClass('active');
  else
    $('.radialnav, .submenu').removeClass('active');
}

/* On click of the ellipsis */
$('.ellipsis').click(function (event) {
  event.preventDefault();
  
  openMenu($('.radialnav'));
});

menuItems.each(function (index) {
  thisMenuItem = $(this);
  thisMenuItem.hover(function () {
    // console.log(index);
    
    submenuId = index;
    menuItems.eq(index).parent().find('.submenu').addClass('active');
  }, function () {
    $('.submenu').removeClass('active');
  });
});

submenuItems.each(function (index) {
  thisSubmenuItem = $(this);
  
  thisSubmenuItem.hover(function () {
    menuItems.eq(submenuId).parent().find('.submenu').addClass('active');
  }, function () {
    
  });
})
</script>
-->
<?php


echo "<input type='image' src='_images/DX-ALTO.png' onclick=\"vedinotifiche();\" title='Dplus-Notifiche' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; top: 0px; z-index: 20;' />";
echo "<input type='image' src='_images/DX-BASSO.png' onclick=\"vedispazi();\" title='Dplus-Spaces' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; bottom: 0px; z-index: 20;' />";
//echo "<input type='image' src='_images/Dplus_Time.png' onclick=\"veditimers();\" title='Dplus-Timers' style='position:fixed; right: -20px; top: 50%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />";
echo "<a href=\"#\" onclick=\"veditimers();\"><button style=\"position: fixed; top: 150px; right: 0px; border: 1px solid #2ECCFA; border-radius: 3px 3px 3px 3px; padding-top:20px; padding-bottom:20px; padding-right:5px; padding-left:5px; background-color: #2ECCFA; color: #000000; font-weight:bold; font-size: 12px;\" title=\"[Dplus-Timers]\" ><span class=\"label\">T<br>i<br>m<br>e<br></span></button></a>";
//echo "<input type='image' src='_images/Mail.png' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 70px; bottom: 10px; z-index: 20;' />";

echo "<div id='barretta' onclick=\"vediprogrammi();\" style='position:fixed; bottom: 0px; left: 0px; height:100%; width: 12px; background-color: red; z-index: 40;' ></div>";
//echo "<center><input type='image' src='_images/menu.png' onclick='vediprogrammi();' title='[Zeta]' style='position:fixed; bottom: 0px; right: 0px; border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' /></center>";

//echo "<div id='programmi' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 28%; height:100%; background-color: #4863A0;  box-shadow: 5px 5px 3px #728FCE; overflow: auto; display:none' > 
echo "<div id='programmi' style='position:fixed; left: 0px; z-index: 30; bottom: 0px; left: 0px;  width: 28%; height:100%; background-color: #4863A0; overflow: auto; display:none' > 
<center><br>
    <a href='../../applications/contacts/index.php'><input type='image' src='_images/contacts.png' onclick='javascript: location.href=\'\';' title='[Contacts]' style=' -moz-border-radius: 128px; -webkit-border-radius: 128px; border-radius: 128px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <input type='image' src='_images/D+webdesk.png' onclick='javascript: window.location.href=\"../../index.php\";' title='[Accedi a D+ Web Desktop]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' />
    <a href='../../applications/foto/index.php'><input type='image' src='_images/D+photo.png' onclick='javascript: location.href=\'index.php\';' title='[Accedi a D+ Photo]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/FW_Files/index.php'><input type='image' src='_images/files3.png' onclick='javascript: location.href=\'index.php\';' title='[Accedi a D+ Files]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
<!--    <a href='../../applications/_reguser/index.php?user_op=modavatar'> <input type='image' src='_images/setting.png' onclick='javascript: location.href=\'\';' title='[Setting]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='0' /></a><br> --><br>
    <a href='../../applications/tamtam/index.php'> <input type='image' src='_images/tamtam.png' onclick='javascript: location.href=\'\';' title='[D+ Plus - Tam Tam Chat]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/D_Plus_FeedReader/index.php'> <input type='image' src='_images/D+Feed.png' onclick='javascript: location.href=\'\';' title='[D+ Plus Feed Reader]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/D_Plus/index.php'> <input type='image' src='_images/D+Social.png' onclick='javascript: location.href=\'\';' title='[D+ Plus]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='http://deltamedia.altervista.org/index.php'> <input type='image' src='_images/zeta.png' onclick='javascript: location.href=\'\';' title='[Zeta]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/system/browser/browser.html'> <input type='image' src='_images/browser.png' onclick='javascript: location.href=\'\';' title='[D+ Plus - Browser]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/DPlus_Maps/index.php'> <input type='image' src='_images/DPlusMaps.png' onclick='javascript: location.href=\'\';' title='[D+ Plus - Maps]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <a href='../../applications/Dplus_Calls/prova.php'> <input type='image' src='_images/Dplus_Calls.png' onclick='javascript: location.href=\'\';' title='[D+ Plus - Calls]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <input type='image' src='../../icons/icons/gm.png' onclick='javascript: window.open(\"https://mail.google.com\",\"Google GMail\",\"width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no\");' title='[G-Mail]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <input type='image' src='../../icons/icons/notes.png' onclick='javascript: window.open(\"https://drive.google.com/keep/\",\"Google Keep\",\"width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no\");' title='[G-Mail]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <input type='image' src='../../icons/icons/facebook.png' onclick='javascript: window.open(\"https://www.facebook.com/\",\"Facebook\",\"width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no\");' title='[G-Mail]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
    <input type='image' src='../../icons/icons/fileexplorer.png' onclick='javascript: window.open(\"https://drive.google.com/\",\"Google Drive\",\"width=700,height=700,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no\");' title='[G-Mail]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a>
<!--    <a href='../../applications/message/index.php'> <input type='image' src='_images/browser.png' onclick='javascript: location.href=\'\';' title='[D+ Plus - Message]' style='border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' hspace='3' vspace='20' /></a> -->
<!--    <center><input type='image' src='_images/menu.png' onclick='vediprogrammi();' title='[Zeta]' style='position:fixed; bottom: 0px; right: 0px; border-radius: 30px 30px 30px 30px; ' border=0 WIDTH='52' HEIGHT='52' /></center> -->
</center><br> </div>
";

if ($user<>""){
$messaggi = "../../users/$utente/$cartella/files/msgusers";
if (!file_exists($messaggi)) mkdir($messaggi,0755);
if (!file_exists("$messaggi/received")) mkdir("$messaggi/received",0755);
if (!file_exists("$messaggi/received-tmp")) mkdir("$messaggi/received-tmp",0755);
if (!file_exists("$messaggi/sent")) mkdir("$messaggi/sent",0755);

$msgcount = messages_count("../../users/$user/$cartella/files/msgusers/received");
$msgcount2 = messages_count("../../users/$user/$cartella/files/msgusers/received-tmp");

if ($msgcount2== 0) { $notifica="push_notification_icon_0.png"; }
if ($msgcount2== 1) { $notifica="push_notification_icon_1.png"; }
if ($msgcount2== 2) { $notifica="push_notification_icon_2.png"; }
if ($msgcount2== 3) { $notifica="push_notification_icon_3.png"; }
if ($msgcount2== 4) { $notifica="push_notification_icon_4.png"; }
if ($msgcount2== 5) { $notifica="push_notification_icon_5.png"; }
if ($msgcount2== 6) { $notifica="push_notification_icon_6.png"; }
if ($msgcount2== 7) { $notifica="push_notification_icon_7.png"; }
if ($msgcount2== 8) { $notifica="push_notification_icon_8.png"; }
if ($msgcount2== 9) { $notifica="push_notification_icon_9.png"; }
if ($msgcount2>= 10) { $notifica="push_notification_icon_10piu.png"; }
}

echo "<div id='spazi' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #FFFAFA; overflow: auto; display:none' > 

	<center><h1><font color='red'><b>"._SPACES."</font></b></h1></center>

	<input type='image' src='_images/DX-ALTO.png' onclick=\"vedinotifiche();\" title='Dplus-Notifiche' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; top: 0px; z-index: 20;' />
	<input type='image' src='_images/DX-BASSO.png' onclick=\"vedispazi();\" title='Dplus-Spaces' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; bottom: 0px; z-index: 20;' />
";

$totalspace = "../../users/$user/".sb_get($user)."/";
$filesspace = "../../users/$user/".sb_get($user)."/files/";
$cestinospace = "../../users/$user/".sb_get($user)."/Cestino/";
//$space = "../../users/$user/".sb_get($user)."/Deskicons/";
//$space = "../../users/$user/".sb_get($user)."/Syncro/";
$homespace = "../../users/$user/".sb_get($user)."/home/";
$documentispace = "../../users/$user/".sb_get($user)."/home/Documenti/";
$immaginispace = "../../users/$user/".sb_get($user)."/home/Immagini/";
$musicaspace = "../../users/$user/".sb_get($user)."/home/Musica/";
$scaricatispace = "../../users/$user/".sb_get($user)."/home/Scaricati/";
$videospace = "../../users/$user/".sb_get($user)."/home/Video/";

// calcolo il peso di una ipotetica cartella contenente immagini
$totalsize = dirsize($totalspace);
$filessize = dirsize($filesspace);
$cestinosize = dirsize($cestinospace);
$homesize = dirsize($homespace);
$documentisize = dirsize($documentispace);
$immaginisize = dirsize($immaginispace);
$musicasize = dirsize($musicaspace);
$scaricatisize = dirsize($scaricatispace);
$videosize = dirsize($videospace);

// converto in MB con una precisione di tre decimali
$totalmb = number_format($totalsize/(1024*1024),3);
$filesmb = number_format($filessize/(1024*1024),3);//$basefiles=$filessize/(1024*1024)*5;
$cestinomb = number_format($cestinosize/(1024*1024),3);
$homemb = number_format($homesize/(1024*1024),3);$basehome=$homesize/(1024*1024)*5;
$documentimb = number_format($documentisize/(1024*1024),3);$basedocumenti=$documentisize/(1024*1024)*5;
$immaginimb = number_format($immaginisize/(1024*1024),3);$baseimmagini=$immaginisize/(1024*1024)*5;
$musicamb = number_format($musicasize/(1024*1024),3);
$scaricatimb = number_format($scaricatisize/(1024*1024),3);
$videomb = number_format($videosize/(1024*1024),3);
$base = 80;
$basefiles = 80;
$basehome = 80;
$basedocumenti = 80;
$baseimmagini = 80;
// stampo a video
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$base."%; height:30px; background-color: black;'>&nbsp;<span style='color:white;'><b>Occupazione Totale: ".$totalmb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$basefiles."%; height:30px; background-color: LIGHTSKYBLUE;'>&nbsp;<span style='color:white;'><b>Files: ".$filesmb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$base."%; height:30px; background-color: red;'>&nbsp;<span style='color:black;'><b>Cestino: ".$cestinomb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$basehome."%; height:30px; background-color: grey;'>&nbsp;<span style='color:white;'><b>Home: ".$homemb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$basedocumenti."%; height:30px; background-color: blue;'>&nbsp;<span style='color:white;'><b>Documenti: ".$documentimb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$baseimmagini."%; height:30px; background-color: purple;'>&nbsp;<span style='color:white;'><b>Immagini: ".$immaginimb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$base."%; height:30px; background-color: orange;'>&nbsp;<span style='color:white;'><b>Musica: ".$musicamb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$base."%; height:30px; background-color: green;'>&nbsp;<span style='color:white;'><b>Scaricati: ".$scaricatimb."Mb</b></span></div><br>";
echo "<div style='position:relative; margin:0px; margin-left: 5%; width: ".$base."%; height:30px; background-color: magenta;'>&nbsp;<span style='color:white;'><b>Video: ".$videomb."Mb</b></span></div><br>";
/*
echo "  spazio occupato   Cestino: ".$cestinomb." Mb<br><br>";
echo "  spazio occupato      Home: ".$homemb." Mb<br><br>";
echo "  spazio occupato Documenti: ".$documentimb." Mb<br><br>";
echo "  spazio occupato  Immagini: ".$immaginimb." Mb<br><br>";
echo "  spazio occupato    Musica: ".$musicamb." Mb<br><br>";
echo "  spazio occupato Scaricati: ".$scaricatimb." Mb<br><br>";
echo "  spazio occupato     Video: ".$videomb." Mb<br><br>";
*/
//	user_getquotacurrent(); 
echo "<br><br></div>";
echo "<div id='notifiche' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #FFFAFA; overflow: auto; display:none' > 
	<center><h1><font color='red'><b>"._NOTIFICHE."</font></b></h1></center>
	<input type='image' src='_images/DX-ALTO.png' onclick=\"vedinotifiche();\" title='Dplus-Notifiche' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; top: 0px; z-index: 20;' />
	<input type='image' src='_images/DX-BASSO.png' onclick=\"vedispazi();\" title='Dplus-Spaces' border=0 WIDTH='42' HEIGHT='42' style='position:fixed; right: 0px; bottom: 0px; z-index: 20;' />
<br>
<br><br>
    <input type='image' src='_images/Mail.png' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 50px; z-index: 20;' />
    <input type='image' src='_images/$notifica' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 50px; z-index: 20;' />

    <input type='image' src='_images/tamtam.png' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 200px; z-index: 20;' />
    <input type='image' src='_images/$notifica' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 200px; z-index: 20;' />
<br><br><br><br><br><br><br><br>
    <input type='image' src='_images/D+Feed.png' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 50px; z-index: 20;' />
    <input type='image' src='_images/$notifica' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 50px; z-index: 20;' />

    <input type='image' src='_images/Mail2.png' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 200px; z-index: 20;' />
    <input type='image' src='_images/$notifica' onclick='javascript: location.href=\"index.php\";' title='Benvenuto in Files 3' border=0 WIDTH='72' HEIGHT='72' style='position:fixed; left: 200px; z-index: 20;' />
<br> </div>
";
echo "</div>";
echo "<div id='timers' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #000000; overflow: auto; display:none' > 
      <input type='image' src='_images/D+ Home.png' onclick=\"veditimers();\" title='Dplus-Timers' style='position:fixed; right: -20px; bottom: 80%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
      <input type='image' src='_images/Dplus_Timers_Sveglia.png' onclick=\"javascript: document.getElementById('sveglie').style.display='inline';\" title='Dplus-Sveglia' style='position:fixed; right: -20px; bottom: 60%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
      <input type='image' src='_images/Dplus_Timers_Crono.png' onclick=\"javascript: document.getElementById('cronometer').style.display='inline';\" title='Dplus-Cronometer' style='position:fixed; right: -20px; bottom: 40%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
      <input type='image' src='_images/Dplus_Timers_Countdown.png' onclick=\"javascript: document.getElementById('countdowner').style.display='inline'; /* countdown('2015','2','28','0','0','0'); */\" title='Dplus-CountDown' style='position:fixed; right: -20px; bottom: 20%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
      <input type='image' src='_images/TimeZone.png' onclick=\"javascript: document.getElementById('timezones').style.display='inline';\" title='Dplus-Times Zones' style='position:fixed; right: -20px; bottom: 0%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
		<h1 style='position:fixed; right: 5px; z-index: 30;'><font color='red'><b>"._TIMERS."</font></b></h1>
		<div id='fancyClock' style='position:fixed; left: 0px; z-index: 20; top: 0px;' ></div>
<div id='timezones' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #000000; overflow: auto; display:none' > 
	<input type='image' src='_images/Dplus_Time.png' onclick=\"javascript: document.getElementById('timezones').style.display='none';\" title='Dplus-TimesZones' style='position:fixed; right: -20px; bottom: 0%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
	<iframe name='pippo' src='../../js/timezones/timezones.html' frameborder='0' height='100%' width='100%' ></iframe>
</div>
<div id='countdowner' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #000000; overflow: auto; display:none' >
      <input type='image' src='_images/Dplus_Time.png' onclick=\"javascript: document.getElementById('countdowner').style.display='none';\" title='Dplus-CountDown' style='position:fixed; right: -20px; bottom: 0%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
	<ul class=\"countdown\">
	<li>
	<span id='giorni' class=\"days\">00</span>
	<p class=\"days_ref\">days</p>
	</li>
	<li class=\"seperator\">.</li>
	<li>
	<span id='ore' class=\"hours\">00</span>
	<p class=\"hours_ref\">hours</p>
	</li>
	<li class=\"seperator\">:</li>
	<li>
	<span id='minuti' class=\"minutes\">00</span>
	<p class=\"minutes_ref\">minutes</p>
	</li>
	<li class=\"seperator\">:</li>
	<li>
	<span id='secondi' class=\"seconds\">00</span>
	<p class=\"seconds_ref\">seconds</p>
	</li>
	</ul>
<style>
#counter {
	border: 0;
	font-size: 250%;
	font-weight: normal;
	min-height: 3em;
	text-align: center;
}
#counter strong {
	white-space: nowrap;
}
#countdown-start,
#countdown-units {
	background-color: #EEE;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	padding: 2px;
	font-size: 150%;
/*
/*	width: 100%;*/
}
#countdown-start span,
#countdown-units span {
	line-height: 1.5em;
/*	white-space: nowrap;*/
}
#countdown-start,
#countdown-units {
	text-align: center;
}
#countdown-start label {
	font-weight: bold;
	padding: 2px;
}
#countdown-start input {
	border: 1px solid silver;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	text-align: center;
	font-weight: bold;
	font-size: 100%;
}
#countdown-units span {
	display: block;
}/*
#countdown-units label {
	font-weight: bold;
	padding: 2px;
}
#countdown-units input {
	border: 1px solid silver;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	margin-right: 0.5em;
	text-align: center;*/
}
</style>
			<fieldset id=\"countdown-start\"><span>
				<input id=\"year\"
					type=\"number\"
					min=\"-9999\"
					max=\"9999\"
					step=\"1\"
					value=\"2021\"
					size=\"4\"
					placeholder=\"year\"
				/><label for=\"month\">-</label><input id=\"month\"
					type=\"number\"
					min=\"1\"
					max=\"12\"
					step=\"1\"
					value=\"12\"
					size=\"2\"
					placeholder=\"month\"
				/><label for=\"date\">-</label><input id=\"day\"
					type=\"number\"
					min=\"1\"
					max=\"31\"
					step=\"1\"
					value=\"31\"
					size=\"2\"
					placeholder=\"day\"
				/></span>
				<span><label for=\"hours\">&nbsp;</label><input id=\"hours\"
					type=\"number\"
					min=\"0\"
					max=\"23\"
					step=\"1\"
					value=\"00\"
					size=\"2\"
					placeholder=\"hrs\"
				/><label for=\"minutes\">:</label><input id=\"minutes\"
					type=\"number\"
					min=\"0\"
					max=\"59\"
					step=\"1\"
					value=\"00\"
					size=\"2\"
					placeholder=\"min\"
				/><!--<label for=\"seconds\">:</label><input id=\"seconds\"
					type=\"number\"
					min=\"0\"
					max=\"59\"
					step=\"1\"
					value=\"20\"
					size=\"2\"
					placeholder=\"sec\"
				/><label for=\"milliseconds\">.</label><input id=\"milliseconds\"
					type=\"number\"
					min=\"0\"
					max=\"999\"
					step=\"1\"
					value=\"0\"
					size=\"3\"
					placeholder=\"ms\"
				/></span>
				<span id=\"timezone\">&nbsp;UTC</span>-->
			</fieldset>
		<br><br>
		<button style='border: 1px solid #FFFFFF; border-radius: 0px 0px 0px 0px; padding-top:18px; padding-bottom:18px; width: 100%; background-color: #FFFFFF; color: #000000; font-weight:bold; font-size: 14px;' onclick=\"javascript: countdown(''+document.getElementById('year').value+'',''+document.getElementById('month').value+'',''+document.getElementById('day').value+'',''+document.getElementById('hours').value+'',''+document.getElementById('minutes').value+'','0');\" />Imposta Data e Ora</button>
</div>
<div id='cronometer' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #000000; overflow: auto; display:none' >
      <input type='image' src='_images/Dplus_Time.png' onclick=\"javascript: document.getElementById('cronometer').style.display='none';\" title='Dplus-Timers' style='position:fixed; right: -20px; bottom: 0%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
<br><br>
		<script type=\"text/javascript\">
		var ore=0;
		var minuti=0;
		var secondi=0;
		var decimi=0;
		var visualizzazione=\"\";
		var contatore_intertempi=0;
		var stop=1; //0=attivo 1=fermo
			function avvia()
			{
			if (stop==1)
			{
			stop=0;
			cronometro();
			}
			}
			function cronometro()
			{
			if (stop==0) {
			decimi+=1;
			if (decimi>9) {decimi=0;secondi+=1;}
			if (secondi>59) {secondi=0;minuti+=1;}
			if (minuti>59) {minuti=0;ore+=1;}
			if (ore<10) {visualizzazione=\"0\" + ore;} else {visualizzazione=ore;}
			if (minuti<10) {visualizzazione=visualizzazione + \":0\" + minuti;} else {visualizzazione=visualizzazione + \":\" + minuti;}
			if (secondi<10) {visualizzazione=visualizzazione + \":0\" + secondi;} else {visualizzazione=visualizzazione + \":\" + secondi;}
				visualizzazione=visualizzazione + \":\" + decimi;
				document.getElementById(\"mostra_cronometro\").value=visualizzazione;
				setTimeout(\"cronometro()\", 100);
			}
			}
			function intertempo()
			{
			if (stop==0)
			{
		contatore_intertempi+=1;
		document.getElementById(\"intertempi\").appendChild(document.createTextNode(contatore_intertempi + \". \" + visualizzazione));
		document.getElementById(\"intertempi\").appendChild(document.createElement(\"br\"));
		}
		}
			function ferma()
			{
				stop=1;
			}
			function azzera()
			{
				if (stop==1)
			{
		ore=0;
		minuti=0;
		secondi=0;
		decimi=0;
		document.getElementById(\"mostra_cronometro\").value=\"00:00:00:0\";
		$('#intertempi').empty();
		contatore_intertempi=0;
		}
		}
	</script>
		<input id=\"mostra_cronometro\" style=\"text-align:center;background-color: #000;color: gold; font-weight: bold; padding:20px; font-size: 4em; font-family: Courier; letter-spacing: -4px; width: 100%; text-align: center; border:0px solid #063F86;\" value=\"00:00:00:0\" disabled=\"disabled\" />
		<br><br>
		<button style='position:fixed; left: 0px; border: 1px solid #00FF00; border-radius: 0px 0px 0px 0px; padding-top:18px; padding-bottom:18px; padding-right:20%; padding-left:20%; background-color: #00FF00; color: #000000; font-weight:bold; font-size: 14px;' onclick=\"javascript:avvia();\" />Inizio</button>
		<button style='position:fixed; right: 0px; border: 1px solid red; border-radius: 0px 0px 0px 0px; padding-top:18px; padding-bottom:18px; padding-right:20%; padding-left:20%; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 14px;' onclick=\"javascript:ferma();\" />Stop</button>
		<br><br><br><br><br>
		<button style='border: 1px solid #00AAFF; border-radius: 0px 0px 0px 0px; padding-top:18px; padding-bottom:18px; width: 100%; background-color: #00AAFF; color: #FFFFFF; font-weight:bold; font-size: 14px;' onclick=\"javascript:azzera();\" />Azzera</button>
		<br><br>
		<button style='border: 1px solid #FFFFFF; border-radius: 0px 0px 0px 0px; padding-top:18px; padding-bottom:18px; width: 100%; background-color: #FFFFFF; color: #000000; font-weight:bold; font-size: 14px;' onclick=\"javascript:intertempo();\" />Giro</button>
		<br><br>
		<center><div id=\"intertempi\" style='color: #FFFFFF; font-weight:bold; font-size: 18px;'  ></center>
	</div>
</div>
<div id='sveglie' style='position:fixed; left: 0px; z-index: 20; bottom: 0px; left: 0px;  width: 100%; height:100%; background-color: #000000; overflow: auto; display:none' >
      <input type='image' src='_images/Dplus_Time.png' onclick=\"javascript: document.getElementById('sveglie').style.display='none';\" title='Dplus-Timers' style='position:fixed; right: -20px; bottom: 0%;' border=0 WIDTH='60' HEIGHT='60' hspace='3' vspace='0' />
<font color='white' face='Arial'><b><a style='position:fixed; left: 20px; top: 30px; z-index: 20;' >Imposta Sveglia:</a></b></font><br><br><br><br>
<font color='white' face='Arial'><b><a style='position:fixed; left: 20px; z-index: 20;' >ORA:</a></b></font><font color='white' face='Arial'><b><a style='position:fixed; left: 50%; z-index: 20;' >MINUTI:</a></b></font><br>
	    <select id='sveglia_ore' name='sveglia_ore' style='width: 40%; position:fixed; border: 4px solid skyblue; background-color:white; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left: 20px; z-index: 20;'>
		<option>00</option>
		<option>01</option>
		<option>02</option>
		<option>03</option>
		<option>04</option>
		<option>05</option>
		<option>06</option>
		<option>07</option>
		<option>08</option>
		<option>09</option>
		<option>10</option>
		<option>11</option>
		<option>12</option>
		<option>13</option>
		<option>14</option>
		<option>15</option>
		<option>16</option>
		<option>17</option>
		<option>18</option>
		<option>19</option>
		<option>20</option>
		<option>21</option>
		<option>22</option>
		<option>23</option>
	<!--	<option>24</option> -->
	    </select> 
	    <select id='sveglia_minuti' name='sveglia_minuti' style='width: 40%; position:fixed; border: 4px solid skyblue; background-color:white; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left: 50%; z-index: 20;'>
		<option>00</option>
		<option>01</option>
		<option>02</option>
		<option>03</option>
		<option>04</option>
		<option>05</option>
		<option>06</option>
		<option>07</option>
		<option>08</option>
		<option>09</option>
		<option>10</option>
		<option>11</option>
		<option>12</option>
		<option>13</option>
		<option>14</option>
		<option>15</option>
		<option>16</option>
		<option>17</option>
		<option>18</option>
		<option>19</option>
		<option>20</option>
		<option>21</option>
		<option>22</option>
		<option>23</option>
		<option>24</option>
		<option>25</option>
		<option>26</option>
		<option>27</option>
		<option>28</option>
		<option>29</option>
		<option>30</option>
		<option>31</option>
		<option>32</option>
		<option>33</option>
		<option>34</option>
		<option>35</option>
		<option>36</option>
		<option>37</option>
		<option>38</option>
		<option>39</option>
		<option>40</option>
		<option>41</option>
		<option>42</option>
		<option>43</option>
		<option>44</option>
		<option>45</option>
		<option>46</option>
		<option>47</option>
		<option>48</option>
		<option>49</option>
		<option>50</option>
		<option>51</option>
		<option>52</option>
		<option>53</option>
		<option>54</option>
		<option>55</option>
		<option>56</option>
		<option>57</option>
		<option>58</option>
		<option>59</option>
	<!--	<option>60</option> -->
	    </select>
<br><br><br><br><br><font color='white' face='Arial'><b><a style='position:fixed; left: 20px; z-index: 20;'>Imposta Suoneria:</a></b></font><br>
	    <select name='branoautoplay' id='branoautoplay' onchange=\"player.src='../../users/$user/".sb_get($user)."/files/Music/mp3/'+this.options[this.selectedIndex].text; player.pause();\" style='width: 95%; position:fixed; border: 4px solid skyblue; background-color:yellow; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left: 20px; z-index: 20;' >";
		    $hdir=opendir('../../users/'.$user.'/'.sb_get($user).'/files/Music/mp3');
		    $i=0;
		    while (false !== ($f= readdir($hdir))){
			if ($f[0]!="." && substr($f,-3,3)!="inc"){
			    $listfiles[$i]=$f;
			    $i++;
			}
		    }
		    echo("<option>MP3 da Files/Music/mp3 ... </option>\n");
		    foreach( $listfiles as $filesel){
			    echo("<option style='position:fixed; border: 4px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left: 20px; z-index: 20;' >$filesel</option>\n");
		    }
echo "
	    </select>
        <br><br><br><br>
	<center><audio id='player' name='player' src='' loop='true' autoplay='false' preload='auto' style='position:fixed; left: 20px; z-index: 20; font-weight:bold; font-size: 14px;'></audio></center>
	<div>
	<center><br><br>
	<button style='border: 1px solid #00FF00; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #00FF00; color: #000000; font-weight:bold; font-size: 14px;' onclick=\"document.getElementById('player').play();\"><span >Play</span></button>
	<button style='border: 1px solid #00AAFF; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #00AAFF; color: #FFFFFF; font-weight:bold; font-size: 14px;' onclick=\"clearInterval(GetClock); document.getElementById('clockbox-ore').value=''; document.getElementById('clockbox-minuti').value=''; document.getElementById('player').pause(); document.getElementById('slideThree').checked = 0; \"><span >Pause</span></button>
	</center>
	</div>
<!--	<center>
	<button style='position:fixed; bottom:150px; left:35px; border: 1px solid #00FF00; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #00FF00; color: #000000; font-weight:bold; font-size: 14px;' onclick=\"GetClock(); setInterval(GetClock,1000);\"><span >Attiva Sveglia</span></button>
	<button style='position:fixed; bottom:150px; right:35px; border: 1px solid #FF0000; border-radius: 0px 0px 0px 0px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 14px;'><span >Disattiva Sveglia</span></button>
	</center>
-->
<br><br>
<style>
input[type=checkbox] {
	visibility: hidden;
}
/* SLIDE THREE */
.slideThree {
	width: 80px;
	height: 26px;
	background: #333;
	margin: 20px auto;
	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;
	position: relative;
	-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}
.slideThree:after {
	content: 'OFF';
	font: 12px/26px Arial, sans-serif;
	color: #FFF;
	position: absolute;
	right: 10px;
	z-index: 0;
	font-weight: bold;
	text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}
.slideThree:before {
	content: 'ON';
	font: 12px/26px Arial, sans-serif;
	color: #00FF00;
	position: absolute;
	left: 10px;
	z-index: 0;
	font-weight: bold;
}
.slideThree label {
	display: block;
	width: 34px;
	height: 20px;
	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;
	-webkit-transition: all .4s ease;
	-moz-transition: all .4s ease;
	-o-transition: all .4s ease;
	-ms-transition: all .4s ease;
	transition: all .4s ease;
	cursor: pointer;
	position: absolute;
	top: 3px;
	left: 3px;
	z-index: 1;
	-webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	-moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	background: #fcfff4;
	background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}
.slideThree input[type=checkbox]:checked + label {
	left: 43px;
}
</style>
<!-- Slide THREE -->
<div class='slideThree'>	
	<input type='checkbox' value='None' id='slideThree' name='check' onclick=\"  if (slideThree.checked == 1) { setInterval(function(){ GetClock() }, 1000);}else{ GetClock();} \" />
	<label for='slideThree'></label>
</div>
<input type='hidden' style='position:fixed; bottom:0px; border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left: 20px; z-index: 20;' id='clockbox-ore' name='clockbox-ore' value='' onclick=\"GetClock(); setInterval(GetClock,1000);\">
<input type='hidden' style='position:fixed; bottom:0px; border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; left:150px; z-index: 20;' id='clockbox-minuti' name='clockbox-minuti' value='' onclick=\"GetClock(); setInterval(GetClock,1000);\">
</div>
</div>
";
echo "</div>";
echo "<div style='position:fixed; left: 50px; bottom: 270px; z-index: 20;' >";
//	user_getquotacurrent();
echo "</div>";
//echo "</div></html>";
echo "</div></body></html>";
}
?>
<!--<script src="../../js/fixedbackground.js" type="text/javascript"></script> -->
<!--------------------// Speek //------------------------------------->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin" rel="stylesheet" type="text/css" />
  <link href="http://fonts.googleapis.com/css?family=Lato:300&amp;subset=latin" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="../../js/mespeak/mespeak.js"></script>
  <script type="text/javascript">
	meSpeak.loadConfig("../../js/mespeak/mespeak_config.json");

<?php
		$user=$_COOKIE["utente"];
		if ($user != "") {
		$user_lang=user_getkey($user,"user_lang");
		if ($user_lang == "it - italiano") { echo "meSpeak.loadVoice('../../js/mespeak/voices/it.json');"; }
		if ($user_lang == "en - english") { echo "meSpeak.loadVoice('../../js/mespeak/voices/en/en.json');"; }
		}
?>
  </script>
<!--------------------// Speek //------------------------------------->
<!--------------------// Timers //------------------------------------->
<link rel="stylesheet" type="text/css" href="../../js/timers/css/styles.css" />
<link rel="stylesheet" type="text/css" href="../../js/timers/css/jquery.tzineClock.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/timers/js/jquery.tzineClock.js"></script>
<script type="text/javascript" src="../../js/timers/js/script.js"></script>
<!--------------------// Timers //------------------------------------->
<!--------------------// CountDown //---------------------------------->
 <style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400);
	ul.countdown {
		list-style: none;
		margin: 75px 0;
		padding: 0;
		display: block;
		text-align: center;
	}
	ul.countdown li {
		display: inline-block;
	}
	ul.countdown li span {
		font-size: 80px;
		font-weight: 300;
		line-height: 80px;
	}
	ul.countdown li.seperator {
		font-size: 80px;
		line-height: 70px;
		vertical-align: top;
	}
	ul.countdown li p {
		color: #a7abb1;
		font-size: 14px;
	}
</style>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!--<script type="text/javascript" src="jquery.downCount.js"></script>
  <script type="text/javascript">
        function e() {
            var e = new Date;
                 e.setDate(e.getDate() + 60);
            var dd = e.getDate();
            var mm = e.getMonth() + 1;
            var y = e.getFullYear();
            var futureFormattedDate = mm + "/" + dd + "/" + y + ' 12:00:00';
            return futureFormattedDate;
        }
    </script>
    <script class="source" type="text/javascript">
        $('.countdown').downCount({
            date: e(),
            offset: -4
        }, function () {
            alert('WOOT WOOT, done!');
        });
    </script> -->
<script>
/*
$('.countdown').downCount({
date: '10/21/2015 00:00:00',
offset: +10
}, function () {
alert('WOOT WOOT, done!');
});
*/
</script>
<script>
//----------------------------------------------------------------------------------------------------------
// setting iniziale stato linea (online)
	localStorage.setItem('statolinea', 'on');
//----------------------------------------------------------------------------------------------------------
</script>
<script type="text/javascript">
function countdown(anno,mese,giorno,ore,minuti,secondi)
{
var_anno=anno;
var_mese=mese;
var_giorno=giorno;
var_ore=ore;
var_minuti=minuti;
var_secondi=secondi;
data_scandeza= new Date(var_anno,var_mese-1,var_giorno,var_ore,var_minuti,var_secondi);
data_oggi= new Date();
differenza=(data_scandeza-data_oggi);
giorni=parseInt(differenza/86400000);
differenza=differenza-(giorni*86400000);
ore=parseInt(differenza/3600000);
differenza=differenza-(ore*3600000);
minuti=parseInt(differenza/60000);
differenza=differenza-(minuti*60000);
secondi=parseInt(differenza/1000);
differenza=differenza-(secondi*1000);
if (giorni <= "0" && ore <= "0" && minuti <= "0" && secondi <= "0")
{
/*document.getElementById("countdown").innerHTML="OPS, Tempo scaduto su Wikiinfo.forumattivo.it!"; */
}
else
{
/*document.getElementById("countdown").innerHTML=giorni +' giorni '+ore+' ore '+minuti+' min '+secondi+' sec';*/
	document.getElementById("giorni").innerHTML = ""+giorni+"";
	document.getElementById("ore").innerHTML = ""+ore+"";
	document.getElementById("minuti").innerHTML = ""+minuti+"";
	document.getElementById("secondi").innerHTML = ""+secondi+"";
	setTimeout("countdown(var_anno,var_mese,var_giorno,var_ore,var_minuti,var_secondi)",1000)
}
}
</script>
<!--------------------// CountDown //---------------------------------->
<script src="http://dplus.altervista.org/WEB_DESKTOP/OS/js/services/wikipedia/api.js"></script>
<script src="http://dplus.altervista.org/WEB_DESKTOP/OS/js/services/duckduckgo/api.js"></script>
<!--<textarea id='output' name='output' style='right:5px;width:80%;height:200px;'></textarea>-->
<script>
//----------------------------------------------------------------------------------------------------------
function cambiaavatar() {
    if(    document.getElementById("cambiaavatar").style.display!='none'){
    document.getElementById("cambiaavatar").style.display='none';
    }
    else{
    document.getElementById("cambiaavatar").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function cambiapassword() {
    if(    document.getElementById("cambiapassword").style.display!='none'){
    document.getElementById("cambiapassword").style.display='none';
    }
    else{
    document.getElementById("cambiapassword").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function richiedipassword() {
    if(    document.getElementById("richiedipassword").style.display!='none'){
    document.getElementById("richiedipassword").style.display='none';
    }
    else{
    document.getElementById("richiedipassword").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function vediprogrammi() {
    if(    document.getElementById("programmi").style.display!='none'){
    document.getElementById("programmi").style.display='none';
    }
    else{
    document.getElementById("programmi").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function vedispazi() {
    if(    document.getElementById("spazi").style.display!='none'){
    document.getElementById("spazi").style.display='none';
    document.getElementById("notifiche").style.display='none';
    }
    else{
    document.getElementById("spazi").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function vedinotifiche() {
    if(    document.getElementById("notifiche").style.display!='none'){
    document.getElementById("notifiche").style.display='none';
    document.getElementById("spazi").style.display='none';
    }
    else{
    document.getElementById("notifiche").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function veditimers() {
    if(    document.getElementById("timers").style.display!='none'){
    document.getElementById("timers").style.display='none';
    document.getElementById("notifiche").style.display='none';
    document.getElementById("spazi").style.display='none';
    }
    else{
    document.getElementById("timers").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
function lanciatore(lancia) { 
	lancia = lancia.toLowerCase();
//if ($user_lang == "it - italiano") { 
	if (lancia.substr(0, 6) == "chiama") { location.href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/contacts/index.php?dpath=&action=exec_search&vocale="+lancia.substr(7,lancia.length)+"" };
	if (lancia.substr(0, 10) == "parlami di") { 
//var url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles="+lancia.substr(11,lancia.length)+"";

String.prototype.toCapitalCase = function() {
  var regEx = /([a-z]*)([^a-z]*)([\s\S]*)/i;
  var matchArray = regEx.exec(this);
  var text = "";
  while (matchArray) {
  text += matchArray[1].charAt(0).toUpperCase() + matchArray[1].slice(1).toLowerCase() + matchArray[2];
  temp = matchArray[3];
  if (matchArray[3]) matchArray = regEx.exec(matchArray[3]);
  else matchArray = false;
  }
  if (window.temp) text +=temp.charAt(0).toUpperCase() + temp.slice(1).toLowerCase()
  return text;
}
//----------------------------------------------------------------------------------------------------------
var out = lancia.substr(11,lancia.length).toCapitalCase();
alert(wikirequest(out));
//alert(duckduckgorequest(out));
//meSpeak.speak(wikirequest(out));

/*
<?php
	//echo "var url = \"https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=\"+lancia.substr(11,lancia.length)+\"\";";
	echo "var pippo = localStorage.setItem('wikipediaresult',''+lancia.substr(11,lancia.length)+'');\n"; // salvataggio dati
	//$myphpvar = "localStorage.getItem('wikipediaresult');";
	$myphpvar = ucwords($myphpvar);$myphpvar = "Alan Turing";
	header("Access-Control-Allow-Origin: *");
	$pagina=join(file("https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=".$myphpvar.""));
	//$pagina=join(file("http://api.duckduckgo.com/?q=".$myphpvar."&format=json&pretty=1")); //$temp = "".$json_output["Abstract"]."";
	//$json_output = json_decode($pagina, true); $temp = "".$json_output[extract]."";  //echo "var risultato = ".$json_output[extract]."";
	$start=strpos($pagina,"\"extract\":",0);
	$end=strpos($pagina,"\"}",0);
	$temp = substr($pagina,$start+11,$end-($start+10));
	$temp = str_replace("'","\'",$temp);
	//echo "var pippo = localStorage.setItem('wikipediaresult','".$temp."');\n"; // salvataggio dati
	echo "alert('".$temp."');";
?>
*/

	//var out  = localStorage.getItem('wikipediaresult'); // rilevamento dati salvati
	//alert(out);

	};
//}
//if ($user_lang == "en - english") { 
//	if (lancia.substr(0, 6) == "call") { location.href="http://dplus.altervista.org/WEB_DESKTOP/OS/applications/contacts/index.php?dpath=&action=exec_search&vocale="+lancia.substr(7,lancia.length)+"" };
//}
	<?php
		$user=$_COOKIE["utente"];
		$cartella=$_COOKIE["cartella"];
		if ($user != "") {
		$user_lang=user_getkey($user,"user_lang");
		if ($user_lang == "it - italiano") { include_once "lang/speek-it.js"; include_once "../../users/".$user."/".$cartella."/speek-it.js"; }
		if ($user_lang == "en - english") { include_once "lang/speek-en.js";  include_once "../../users/".$user."/".$cartella."/speek-en.js"; }
		}
	?>
}
//----------------------------------------------------------------------------------------------------------
function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear(),nhour=d.getHours(),nmin=d.getMinutes();
if(nyear<1000) nyear+=1900;
if(nhour<=9) nhour="0"+nhour
if(nmin<=9) nmin="0"+nmin
//document.getElementById('clockbox').innerHTML=""+(nmonth+1)+"/"+ndate+"/"+nyear+" "+nhour+":"+nmin+"";
document.getElementById('clockbox-ore').value=""+nhour+"";
document.getElementById('clockbox-minuti').value=""+nmin+"";
if (document.getElementById("sveglia_ore").value == document.getElementById('clockbox-ore').value && document.getElementById("sveglia_minuti").value == document.getElementById('clockbox-minuti').value) {
	document.getElementById('player').play();
}
if (document.getElementById("slideThree").checked == 0) {
	clearInterval(GetClock);
	document.getElementById('clockbox-ore').value="";
	document.getElementById('clockbox-minuti').value="";
	document.getElementById('player').pause();
}
}
//----------------------------------------------------------------------------------------------------------
</script>
<script>
if (sfondo != "null") {
//	fixedBackground(sfondo);
}
// ---------------------------------------------------------------------------------------------------------------------
function aggiornaInfoStatoBatteria() {
    // Gestione dello stato della batteria  
var isBatterySupported = (navigator.battery || navigator.mozBattery); 
var indicatoreBatteria1 = document.getElementById("indicatoreBatteria"); 
var battery = navigator.battery;
if (isBatterySupported) { 
    // Gestione dello stato della batteria  
	if (navigator.battery.charging) { 
	    indicatoreBatteria.style.backgroundColor = "Green"; 
	    indicatoreBatteria.style.width = battery.level * 100 + "%";
	    infoBox.innerText = "La batteria sarà carica in " + battery.chargingTime + " secondi!"; 
	} else { 
	    indicatoreBatteria.style.backgroundColor = "Yellow"; 
	    indicatoreBatteria.style.width = battery.level * 100 + "%";
	    infoBox.innerText = "La batteria sarà scarica in " + battery.dischargingTime + " secondi!"; 
	} 
	if (navigator.battery.level < 0.1) {
	    indicatoreBatteria.style.backgroundColor = "Red"; 
	}
	if (navigator.battery.level < 0.3) {
	    indicatoreBatteria.style.backgroundColor = "Orange"; 
	}
	} else { 
	    indicatoreBatteria.style.backgroundColor = "LightGray";
	   // indicatoreBatteria.style.width = battery.level * 100 + "%";
	} 
    // Fine Gestione dello stato della batteria  
/*battery.addEventListener("chargingchange", aggiornaInfoStatoBatteria); 
battery.addEventListener("chargingtimechange", aggiornaInfoStatoBatteria); 
battery.addEventListener("dischargingtimechange", aggiornaInfoStatoBatteria); 
battery.addEventListener("levelchange", aggiornaInfoStatoBatteria); 
*/
}
// ---------------------------------------------------------------------------------------------------------------------
function checkBattery()
{
  var indicatoreBatteria = document.getElementById("indicatoreBatteria"); 
  var battery = navigator.battery || navigator.webkitBattery || navigator.mozBattery;
//  var battery = navigator.battery; // W3C standard API
  if (!battery)
    battery = navigator.mozBattery; // Mozilla specific API
  if (!battery) // Battery Status API not supported
  {
 //   alert("Il tuo browser non supporta Battery Status API");
    return;
  }
/*
var livellobatteria = Math.round(battery.level * 100);
if (livellobatteria < 30) {
    indicatoreBatteria.style.backgroundColor = "Orange"; 
}
if (livellobatteria < 10) {
    indicatoreBatteria.style.backgroundColor = "Red"; 
}
*/	
  var Status = Math.round(battery.level * 100);
/*
if (Status > 50) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; background-color: green; top:3px; right:65px; z-index: 20; border: 2px black solid; height: 20px; width: 50px;'  ><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "<br>in carica</b></div>" : "</b></div>");
}
if (Status <= 40) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; background-color: yellow; top:3px; right:65px; z-index: 20; border: 2px black solid; height: 20px; width: 50px;'  ><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "<br>in carica</b></div>" : "</b></div>");
}
if (Status <= 30) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; background-color: orange; top:3px; right:65px; z-index: 20; border: 2px black solid; height: 20px; width: 50px;'  ><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "<br>in carica</b></div>" : "</b></div>");
}
if (Status <= 10) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; background-color: red; top:3px; right:65px; z-index: 20; border: 2px black solid; height: 20px; width: 50px;'  ><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "<br>in carica</b></div>" : "</b></div>");
}
*/
if (Status <= 100) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "</font><img src='_images/gpm-battery-100-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-100.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "green"; 
}
if (Status <= 80) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "</font><img src='_images/gpm-battery-080-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-080.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "yellow"; 
}
if (Status <= 60) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "</font><img src='_images/gpm-battery-060-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-060.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "yellow"; 
}
if (Status <= 40) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "</font><img src='_images/gpm-battery-040-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-040.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "yellow"; 
}
if (Status <= 20) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "</font><img src='_images/gpm-battery-020-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-020.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "orange"; 
}
if (Status <= 10) {
  var batteryStatus = "<div id='indicatoreBatteria' style='position:fixed; top:3px; right:42px; z-index: 10; height: 20px; width: 90px;'  ><font color='"+coloredatario+"' face='Arial'><b> " + Math.round(battery.level * 100) + "% " + ((battery.charging) ? "<img src='_images/gpm-battery-000-charging.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ><br>&nbsp;&nbsp;&nbsp;&nbsp;in carica</b></div>" : "</b><img src='_images/gpm-battery-000.png' style='position:fixed; top:-10px; right:35px; z-index: 10;' WIDTH='48' HEIGHT='48' ></div>");
//    document.getElementById("indicatoreBatteria").style.backgroundColor = "red"; 
}
	document.write(batteryStatus);
//  alert(batteryStatus);
}
checkBattery();
</script>
<script>
if (!window.indexedDB) {
	// Il browser non supporta indexedDB
	var indexedDBStatus = "<div id='indicatoreDB' style='position:fixed; bottom:0px; left:20px; z-index: 10; height: 25px; width: 25px;'  ><img src='_images/LS_OFF.png' style='position:fixed; bottom: -4px; left: 10px; z-index: 10;' WIDTH='35' HEIGHT='35' title='IndexedDB OFF' ></div>";
	document.write(indexedDBStatus);
} else {
	// Il browser supporta indexedDB
	var indexedDBStatus = "<div id='indicatoreDB' style='position:fixed; bottom:0px; left:20px; z-index: 10; height: 25px; width: 25px;'  ><img src='_images/LS_ON.png' style='position:fixed; bottom: -4px; left: 10px; z-index: 10;' WIDTH='35' HEIGHT='35'  title='IndexedDB ON'></div>";
	document.write(indexedDBStatus);
}
if (window['localStorage']) {
	    var localstorageStatus = "<div id='indicatoreLS' style='position:fixed; bottom:0px; left:45px; z-index: 10; height: 25px; width: 25px;'  ><img src='_images/Sync_ON.png' style='position:fixed; bottom: 0px; left: 40px; z-index: 10;' WIDTH='25' HEIGHT='25'  title='LocalStorage ON'></div>";
	    document.write(localstorageStatus);
	    // alert('// window.localStorage disponibile!');
	} else {
	    var localstorageStatus = "<div id='indicatoreLS' style='position:fixed; bottom:0px; left:45px; z-index: 10; height: 25px; width: 25px;'  ><img src='_images/Sync_OFF.png' style='position:fixed; bottom: 0px; left: 40px; z-index: 10;' WIDTH='25' HEIGHT='25' title='LocalStorage OFF' ></div>";
	    document.write(localstorageStatus);
	    // alert('// localstorage non supportato! :(');
	}
</script>
<!--------------------------------------------------------------------------------------------------------->
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
<div id="connection" style="position:fixed; bottom:5px; left:60px; z-index: 10; " >Connecting...<div></div></div>
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
