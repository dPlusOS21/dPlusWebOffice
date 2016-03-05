<?php
//	    $icona=$_GET['icona'];
//	    $program=$_GET['app'];

//carica la lingua se esiste
$lang="it";
switch($lang){
    case "en":
	define("_ADMIN_PREFERENCE","ADMIN PREFERENCE");
	define("_CHANGE_PREFERENCES","change preferences");
	define("_CHANGE_PASSWORD","Change Password");
	define("_RETYPE_PASSWORD","Retype Password");
	define("_SET_PASSWORD","change password");
	define("_ADMINISTRATION_PRIVILEGE_REQUESTED", "administration privilege requested");
	define("_CHANGE","Change");
	define("_CONTINUA","Continue");
	define("_SLANG","Current Language");
	define("_CURR_FILE","Current File");
	define("_SAVE_OK","Save Operation OK !!!");
	define("_CHOOSE_LANG","Choose Highlight Language");
	define("_CHOOSE_LANG1","Language in Highlight");
	define("_EDIT_FILE","Edit File");
	define("_BLANCK_FILE","File in Editing Closed ... Select another File !!!");
	break;
    case "it":
//    default;
	define("_ADMIN_PREFERENCE","ADMIN PREFERENCE");
	define("_CHANGE_PREFERENCES","change preferences");
	define("_CHANGE_PASSWORD","Change Password");
	define("_SET_PASSWORD","change password");
	define("_RETYPE_PASSWORD","Retype Password");
	define("_ADMINISTRATION_PRIVILEGE_REQUESTED", "administration privilege requested");
	define("_CHANGE","Change");
	define("_CONTINUA","Continua");
	define("_SLANG","Linguaggio Corrente");
	define("_CURR_FILE","File Corrente");
	define("_SAVE_OK","Operazione di Salvataggio OK !!!");
	define("_CHOOSE_LANG","Scegli il Linguaggio in Highlight");
	define("_CHOOSE_LANG1","Linguaggio in Highlight");
	define("_EDIT_FILE","Modifica File");
	define("_BLANCK_FILE","File in Editing Chiuso ... Seleziona il prossimo File !!!");
	break;
}


function makeform(){

//session_start();
$utente=$_COOKIE['utente'];
$cartella=$_COOKIE['cartella'];


	    $deskprogram=$_GET['deskapp'];
// --------tabs---------------------------------------------------------------------------------------------------------

//echo "<script type='text/javascript' src='../../js/tabs/tabpane.js'></script>";
//echo "<link type='text/css' rel='StyleSheet' href='../../js/tabs/tabpane.css' />";
//echo "<div STYLE='width:100%; height:100%' class='tab-pane' id='tab-pane-1' name='tabulatori'>";
// ---------------------------------------------------------------------------------------------------------------------
//echo   "<div class='tab-page' id='tab-$randpath'>";
//	echo "</br>";
//	echo "</br>";
//	echo "</br>";
//	echo "</br>";

//echo      "<h2 class='tab' id='Treefiles'>CESTINO</h2>";

	echo "</br></br></br>";	echo "</br>";
	 // echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "prova.php?op=editfile&file=[link]"); 
	  echo php_file_tree("../../users/$utente/$cartella/Cestino/", "cestino.php?op=selezioneprogramma&deskapp=[link]"); 

echo 	  "<div STYLE='position:absolute; top:0px; left:250px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";
	echo "<form name='deleteallfile' action='cestino.php?op=deleteallfile' method='post'>";
	echo "<h3>Svuota Cestino ... ";
	echo "<input type='image' src='../../_images/drive_delete.png' style='width: 25px; height: 25px;' onclick='' title='Svuota Cestino ... '/></h3>";
	echo "</form>";
	echo "<form name='ripristallfile' action='cestino.php?op=ripristallfile' method='post'>";
	echo "<h3>Ripristina Tutti i File ... ";
	echo "<input type='image' src='../../_images/drive_add.png' style='width: 25px; height: 25px;' onclick='' title='Ripristina Tutti i File ... '/></h3>";
	echo "</form>";
	echo "<form name='deletefile' action='cestino.php?op=cancellafile&deskapp=$delefiledeskapp' method='post'>";
	echo "<h3 class='edit'>Applicazione Selezionata: <input type='text' id='delefileapp' name='delefiledeskapp' size='50' value='$deskprogram'>";
	echo "<input type='image' src='../../_images/delete.png' style='width: 25px; height: 25px;' onclick='' title='Elimina File di Desktop Icona'/></h3>";
	echo "</form>";
	echo "<form name='ripristinafile' action='cestino.php?op=ripristinafile&deskapp=$ripristinafiledeskapp' method='post'>";
	echo "<h3 class='edit'>Applicazione Selezionata: <input type='text' id='ripristinafileapp' name='ripristinafiledeskapp' size='50' value='$deskprogram'>";
	echo "<input type='image' src='../../_images/add.png' style='width: 25px; height: 25px;' onclick='' title='Ripristina File di Desktop Icona'/></h3>";
	echo "</form>";
echo "</div>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";

//echo "</div>";
// ---------------------------------------------------------------------------------------------------------------------

//echo "</div>";
}
// ---------------------------------------------------------------------------------------------------------------------


?>


    <?php // Main function file
		$utente=$_COOKIE['utente'];
		$cartella=$_COOKIE['cartella'];
		$user_avatar=$_COOKIE['user_avatar'];

       include_once("../php_file_tree/php_file_tree.php");
    ?>
    <link href="../php_file_tree/styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="../php_file_tree/php_file_tree.js" type="text/javascript"></script>

			<td valign="top" width="100%">

</p>


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

</style>

<div class="ipuser" style="position:fixed; top: 0px; left: 0px; width:100%; z-index: 20;">
<!-- <input type='image' src="../../applications/setting/images/menu.png" id="nav_list" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left" /> -->
<input type='image' src="../../applications/setting/images/cestino.png" onclick="javascript: location.href='cestino.php';" title="<?=_WELCOME?> in D+ Cestino" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/>
<!-- <input type='image' src="../../applications/setting/images/search.png" onclick="javascript: location.href='index.php?action=search';" title="[<?=_FINDFILES?> File]" border=0 WIDTH="50" HEIGHT="50"  hspace="30" vspace="0"  align="left"/> -->

<?    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
			<input type='image' src="<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="50" HEIGHT="50" hspace="10" vspace="0" align="right" />
		<?php } else { ?>
			<input type='image' src="../../applications/contacts/libs/avatars/<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="50" HEIGHT="50" hspace="10" vspace="0" align="right" />
		<?php } ?>
</div>
<div id='barretta'  style='position:fixed;  z-index: 20; top: 60px; height:5px; width:100%; background-color: red;' ></div>

<?php

//session_start();
$utente=$_COOKIE['utente'];
$cartella=$_COOKIE['cartella'];

	$op=$_GET['op'];


	if ($op==""){
	    makeform();
	}

//	if ($op=="save"){
//	$code=$_POST['myfile'];
//        $file=$_GET['file'];
//	$slang=$_POST['campo'];
//	// $slang=$_POST['setcode'];
//        $fp=fopen($file,"w");
//           fwrite($fp, $code);
//        fclose($fp);
//        echo _CURR_FILE.": ".$file."<br>";
//        echo _SLANG.": ".$slang."<br>";
//        //echo "Contenuto File: ".$code."<br>";
//        echo _SAVE_OK."<br>";
//	    echo "<form>";
//	    echo "<h3 class='edit'><a href='editor.php?op=editfile&file=$file&campo=$slang'>"._CONTINUA."</a></h3>";
//	    echo "</form>";
//	}


	if ($op=="selezioneprogramma"){
	    $deskprogram=$_GET['deskapp'];
	    makeform();
	}


	if ($op=="cancellafile"){
            $deskapp=$_POST['delefiledeskapp'];
            unlink("$deskapp");
	    echo "</br></br></br>$deskapp Eliminato !!!";
	    echo "<h3 class='edit'><a href='cestino.php'>"._CONTINUA."</a></h3>";
	}


	if ($op=="ripristinafile"){
            $deskapp=$_POST['ripristinafiledeskapp'];
		    $comodo="../../users/$utente/$cartella/Cestino/";
		    $comodo=strlen($comodo);
	    $lunghezza=strlen($deskapp);
	    $lunghezza=$lunghezza - $comodo;
	    $appdesk=substr($deskapp, $comodo, $lunghezza); // echo "calcolo file: ".$appdesk;
	    copy($deskapp,"../../users/$utente/$cartella/Deskicons/".$appdesk);
            unlink("$deskapp");
	    echo "</br></br></br>$deskapp Ripristinato !!!"; echo "file: ".$appdesk;
	    echo "<h3 class='edit'><a href='cestino.php'>"._CONTINUA."</a></h3>";
	}

	if ($op=="deleteallfile"){
	//library auto load
	$i=0;
	$fd=opendir("../../users/$utente/$cartella/Cestino/");
	while (false !== ($nf= readdir($fd))){
	    if( substr($nf, -4) == "desk" && $nf != "." && $nf != "..") {
		$content=substr($nf, 0, strlen($nf));
		unlink("../../users/$utente/$cartella/Cestino/".$content);
		echo "</br></br></br>File: ".$content." Eliminato ... <br>";
	}
	}
	closedir($fd);

	    echo "</br></br></br>Cestino Svuotato !!!";
	    echo "<h3 class='edit'><a href='cestino.php'>"._CONTINUA."</a></h3>";
	}

	if ($op=="ripristallfile"){
	//library auto load
	$i=0;
	$fd=opendir("../../users/$utente/$cartella/Cestino/");
	while (false !== ($nf= readdir($fd))){
	    if( substr($nf, -4) == "desk" && $nf != "." && $nf != "..") {
		$content=substr($nf, 0, strlen($nf));
	        copy("../../users/$utente/$cartella/Cestino/".$content,"../../users/$utente/$cartella/Deskicons/".$content);
		unlink("../../users/$utente/$cartella/Cestino/".$content);
		echo "</br></br></br>File: ".$content." Ripristinato ... <br>";
	}
	}
	closedir($fd);

	    echo "</br></br></br>File Ripristinati e Cestino Svuotato !!!";
	    echo "<h3 class='edit'><a href='cestino.php'>"._CONTINUA."</a></h3>";
	}

?>


