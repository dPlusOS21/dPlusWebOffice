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

//	    $icona=$_GET['icona'];
	    $program=$_GET['app'];
	    $IDicona=$_GET['IDicona'];
	    $deskprogram=$_GET['deskapp'];
	    $icona=$_GET['icona'];
	    $lamia=substr($icona, 2, strlen($icona));
	    $Deskicon = "./icons/icons/".$lamia.".png";

	    $content=file("../../users/$utente/$cartella/Deskicons/$lamia.desk");
	    $riga = $content[5];
	    $lunghezza = strlen($content[5]);
	    $riga = substr($content[5], 0, $lunghezza);
	    $posizione = strpos($riga, '("')+2;
	    $riga1 = substr($riga, 0, $posizione);
	    $program = "../../".substr($riga, $posizione, -5);
	    $Deskprogram = substr($riga, $posizione, -5);	    

// --------tabs---------------------------------------------------------------------------------------------------------
//echo "icona: "."users/Deskicons/$icona.desk"."<br>";
//echo "lamia: ".$lamia."<br>";
//echo "riga:  ".$riga."<br>";
//echo "riga1: ".$riga1."<br>";
//echo "riga2: ".$program."<br>";
echo "<script type='text/javascript' src='../../js/tabs/tabpane.js'></script>";
echo "<link type='text/css' rel='StyleSheet' href='../../js/tabs/tabpane.css' />";

echo "<div STYLE='width:100%; height:100%' class='tab-pane' id='tab-pane-1' name='tabulatori'>";


echo   "<div class='tab-page' id='Treetab' name='tab1' >";
echo      "<h2 class='tab' id='Treefiles'>ICONS</h2>";
	echo "</br>";	echo "</br>";
	  echo php_file_tree("../../icons", "property.php?op=selezioneicona&icona=[link]&app=".$_GET['app']."&IDicona=".$_GET['IDicona']); 

echo 	  "<div STYLE='position:absolute; top:20px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";

	echo "<form name='selezionaicona' action='property.php?op=selezioneicona&icona=$icona&IDicona=$IDicona' method='post'>";
	echo "<h3 class='edit'>Icona Applicazione: <input type='text' id='seleicon' name='sele-icon' size='50' value='$Deskicon'> <img src='../../$Deskicon' title='$Deskicon' style='width: 50px; height: 50px;'; /></h3>";
	echo "<h3 class='edit'>___ID Applicazione: <input type='text' id='appseleicon' name='app-sele-icon' size='50' value='$lamia'></h3>";
	echo "</form>\n";
	echo "</br>";

echo "</div>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";

echo "</div>";
// ---------------------------------------------------------------------------------------------------------------------
echo   "<div class='tab-page' id='tab-$randpath'>";
echo      "<h2 class='tab' id='Treefiles'>APP</h2>";
	echo "</br>";	echo "</br>";
	echo "</br>";	echo "</br>";
	  echo php_file_tree("../../applications", "property.php?op=selezioneprogramma&app=[link]&icona=".$_GET['icona']."&IDicona=".$_GET['IDicona']); 


echo 	  "<div STYLE='position:absolute; top:20px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";
	echo "<form name='selezionafile' action='property.php?op=selezioneprogramma&app=$program' method='post'>";
	echo "<h3 class='edit'>Applicazione Selezionata: <input type='text' id='seleapp' name='sele-app' size='50' value='$program'>\n</h3>";
	echo "<h3 class='edit'>E'possibile Inserire anche un indirizzo web come Applicazione Selezionata Remota.</h3>\n";
	echo "</form>";
	echo "</br>";	echo "</br>";
	echo "</br>";	echo "</br>";
echo "</div>";
echo "</div>";
// ---------------------------------------------------------------------------------------------------------------------
echo   "<div class='tab-page' id='tab-$randpath'>";
echo      "<h2 class='tab' id='Treefiles'>SAVE</h2>";
echo 	  "<div STYLE='position:absolute; top:20px; left:10px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";
	echo "<h3>Riepilogo Dati: </h3>";
	echo "<form name='salvadati' action='property.php?op=salvadati&Deskicon=$myDI&mynamefile=$myname' method='post'>";
	echo "<input type='hidden' id='codice' name='myfile' value=''>";
	echo "<input type='hidden' id='codice1' name='myname' value='$lamia'>";
	echo "<textarea STYLE='width:100%; height:100%' id='myDeskIcon' name='myDI' rows='20' cols='300%'  wrap='physical' >";
	echo "".@join(@file("../../users/$utente/$cartella/Deskicons/$lamia.desk"));
	echo "</textarea>";
	echo "<input type='image' src='../../_images/save.png' onclick='javascript: myfile.value = myDeskIcon.value;' title='Crea Nuovo File di Desktop Icona'/>";
	echo "</form>";

echo "</div>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";

echo "</div>";


echo "</div>";
}
// ---------------------------------------------------------------------------------------------------------------------


?>

    <?php // Main function file
       include_once("../php_file_tree/php_file_tree.php");
    ?>
    <link href="../php_file_tree/styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="../php_file_tree/php_file_tree.js" type="text/javascript"></script>

			<td valign="top" width="100%">
</p>

<?php


//	    session_start();
	    //$utente="daniele";
	    $utente=$_COOKIE['utente'];
	    $cartella=$_COOKIE['cartella'];


	$op=$_GET['op'];

	if ($op==""){
	    makeform();
	}

	if ($op=="selezioneicona"){
	    $icona=$_GET['icona'];
	    $program=$_GET['app'];
	    $IDicona=$_GET['IDicona'];
	    makeform();
	}

	if ($op=="selezioneprogramma"){
	    $deskprogram=$_GET['deskapp'];
	    makeform();
	}

	if ($op=="salvadati"){
	    $Deskicon=$_POST['myfile'];
	    $mynamefile=$_POST['myname'];
            $fp=fopen("../../users/$utente/$cartella/Deskicons/$mynamefile.desk","w");
            fwrite($fp, $Deskicon);
            fclose($fp);
            echo "Nuovo file modificato !!!<br>";
            echo "nome file: $mynamefile.desk<br>";
            $mynameicona = "ID".$mynamefile;
	    // echo "contenuto file: ".$Deskicon."<br>";
	    echo "<h3 class='edit'><a href='property.php?icona=$mynameicona'>"._CONTINUA."</a></h3>";
	}

	if ($op=="cancellafile"){
            $deskapp=$_POST['delefiledeskapp'];
	    $lunghezza=strlen($deskapp);
	    $lunghezza=$lunghezza - 22;
	    $appdesk=substr($deskapp, 22, $lunghezza);
	    copy($deskapp,"../../users/$utente/$cartella/Cestino/".$appdesk);
            unlink("$deskapp");
	    echo "$appdesk eliminato !!!";
	    echo "<h3 class='edit'><a href='property.php'>"._CONTINUA."</a></h3>";
	}

?>


