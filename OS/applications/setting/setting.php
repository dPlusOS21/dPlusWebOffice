<?php

echo "<script type='text/javascript' src='../../js/jscolor/jscolor.js'></script>";


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
	define("_ELIMINA_ICONA","Delete Prog.Icon");
	define("_PANNELLO","Panel Setting");
	define("_SETTING_DISPLAY","BackGround Setting");
	define("_WELCOME","Welcome");
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
	define("_ELIMINA_ICONA","Elimina Icona Prog.");
	define("_PANNELLO","Settaggi Pannello");
	define("_SETTING_DISPLAY","Settaggi Sfondo");
	define("_WELCOME","Benvenuto");
	break;
}

// ---------------------------------------------------------------------------------------------------------------------
function setdisplay(){
$utente=$_COOKIE['utente'];
$cartella=$_COOKIE['cartella'];

	    $icona=$_GET['icona'];
	    $program=$_GET['app'];
	    $IDicona=$_GET['IDicona'];
	    $deskprogram=$_GET['deskapp'];
	    $filedeskwall=$_GET['deskwall'];
	    $colordeskwall=$_GET['colorkwall'];



	echo "</br></br></br></br></br></br>";
//	  echo php_file_tree("../../wallpaper/", "setting.php?op=selezionesfondo&deskwall=[link]"); 
	  echo php_file_tree("../../users/$utente/$cartella/home/Immagini/", "setting.php?op=selezionesfondo&deskwall=[link]"); 


echo 	  "<div STYLE='position:absolute; top:50px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";

	echo "<h3>Seleziona Sfondo del DeskTop: </h3>";
	echo "<form name='modificadeskwall' action='setting.php?op=modificasfondo&deskwall=$filedeskwall' method='post'>";
	echo "<h3 class='edit'>Immagine Selezionata:  <br><img src='$filedeskwall' title='$filedeskwall' style='width: 60px; height: 60px;'; /> <input type='text' id='modifilewall' name='filedeskwall' size='50' value='$filedeskwall'>";
	echo "<input type='image' src='../../_images/layout_edit.png' style='width: 25px; height: 25px;' onclick='localStorage.setItem(\"wallpaper\",\"$filedeskwall\");' title='Modifica Sfondo del Desktop'/></h3>";
	echo "</form>";
	echo "</br>";
	echo "<h3>Seleziona Colore Sfondo del DeskTop: </h3>";
	echo "<form name='coloredeskwall' action='setting.php?op=modificacolore&colorkwall=$colordeskwall' method='post'>";
	echo "<h3 class='edit'>Codice Colore Selezionato: <input type='text' class='color' id='modicolorwall' name='colordeskwall' size='7' maxlength='7' value='$colordeskwall'>";
	echo "<input type='image' src='../../_images/layout_edit.png' style='width: 25px; height: 25px;' onclick='' title='Modifica Colore Sfondo del Desktop'/></h3>";
	echo "</form>";

	echo "</br>";

echo "</div>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";


}

// ---------------------------------------------------------------------------------------------------------------------

function setpannello(){

echo 	  "<div STYLE='position:absolute; top:50px; left:30px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";

echo "<table border='0' cellpadding='1' cellspacing='1' style='width: 700px; '>";
echo "	<tbody><tr><td>";
	echo "<h3>Posizione Pannello TOP: </h3>";
	echo "<form name='modificadeskpaneltop' action='setting.php?op=modificapannello&deskpanel=top' method='post'>";
//	echo "<h3 class='edit'>Immagine Selezionata:  <br><img src='$filedeskpanel' title='$filedeskpanel' style='width: 60px; height: 60px;'; />";
	echo "<input type='image' src='../../icons/iconsys/panel_top.png' style='width: 250px; height: 200px;' title='Modifica Posizione Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<h3>Posizione Pannello BOTTOM: </h3>";
	echo "<form name='modificadeskpanelbottom' action='setting.php?op=modificapannello&deskpanel=bottom' method='post'>";
//	echo "<h3 class='edit'>Immagine Selezionata:  <br><img src='$filedeskpanel' title='$filedeskpanel' style='width: 60px; height: 60px;'; />";
	echo "<input type='image' src='../../icons/iconsys/panel_bottom.png' style='width: 250px; height: 200px;' title='Modifica Posizione Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<h3>Colore: </h3>";
echo "<td>";
	echo "<form name='modificadeskpanelcolor' action='setting.php?op=modificapannellocolore&deskpanelcolor=blue' method='post'>";
	echo "<input type='image' src='../../icons/iconsys/taskbar-start-panel-blue.gif' style='width: 20px; height: 70px;' title='Modifica Colore Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<form name='modificadeskpanelcolor' action='setting.php?op=modificapannellocolore&deskpanelcolor=red' method='post'>";
	echo "<input type='image' src='../../icons/iconsys/taskbar-start-panel-red.gif' style='width: 20px; height: 70px;' title='Modifica Colore Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<form name='modificadeskpanelcolor' action='setting.php?op=modificapannellocolore&deskpanelcolor=yellow' method='post'>";
	echo "<input type='image' src='../../icons/iconsys/taskbar-start-panel-yellow.gif' style='width: 20px; height: 70px;' title='Modifica Colore Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<form name='modificadeskpanelcolor' action='setting.php?op=modificapannellocolore&deskpanelcolor=green' method='post'>";
	echo "<input type='image' src='../../icons/iconsys/taskbar-start-panel-green.gif' style='width: 20px; height: 70px;' title='Modifica Colore Pannello del Desktop'/></h3>";
	echo "</form>";
echo "<td>";
	echo "<form name='modificadeskpanelcolor' action='setting.php?op=modificapannellocolore&deskpanelcolor=black' method='post'>";
	echo "<input type='image' src='../../icons/iconsys/taskbar-start-panel-bg.gif' style='width: 20px; height: 70px;' title='Modifica Colore Pannello del Desktop'/></h3>";
	echo "</form>";

echo "</tr></tbody>";
echo "</table>";

	echo "</br>";
	echo "<h3>Clicca sull'immagine per cambiare la Posizione Pannello: </h3>";

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
}


// ---------------------------------------------------------------------------------------------------------------------
function cestino(){
$utente=$_COOKIE['utente'];
$cartella=$_COOKIE['cartella'];
$deskprogram=$_GET['deskapp'];

	echo "</br></br></br></br>";	echo "</br>";
	 // echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "prova.php?op=editfile&file=[link]"); 
	  echo php_file_tree("../../users/$utente/$cartella/Deskicons/", "setting.php?op=selezioneprogrammadacancellare&deskapp=[link]"); 


echo 	  "<div STYLE='position:absolute; top:50px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";

	echo "<h3>ELIMINAZIONE ICONE PROGRAMMI DAL DESKTOP: </h3>";
	echo "<form name='deletefile' action='setting.php?op=cancellafile&deskapp=$delefiledeskapp' method='post'>";
//	echo "<input type='hidden' id='codice2' name='myfile' value='$delefiledeskapp'>";
	echo "<h3 class='edit'>Applicazione Selezionata: <input type='text' id='delefileapp' name='delefiledeskapp' size='80' value='$deskprogram'>";
//	echo "<h3 class='edit'>Icona Applicazione: <input type='text' id='seleicon' name='sele-icon' size='50' value='$Deskicon'> <img src='../../$Deskicon' title='$Deskicon' style='width: 50px; height: 50px;'; /></h3>";
	echo "<input type='image' src='../../_images/delete.png' style='width: 25px; height: 25px;' onclick='' title='Elimina File di Desktop Icona'/></h3>";
	echo "</form>";

	echo "</br>";

echo "</div>";
	echo "</br>";
	echo "</br>";
/*	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
*/
}

// ---------------------------------------------------------------------------------------------------------------------

function makeform(){

//session_start();
$utente=$_COOKIE['utente'];
$cartella=$_COOKIE['cartella'];

	    $icona=$_GET['icona'];
	    $program=$_GET['app'];
	    $IDicona=$_GET['IDicona'];
	    $deskprogram=$_GET['deskapp'];
	    $filedeskwall=$_GET['deskwall'];
	    $colordeskwall=$_GET['colorkwall'];

// --------tabs---------------------------------------------------------------------------------------------------------
echo "<br><br><br><br>";
echo "<h3> ADD PROGRAM ON DESKTOP</h3>";
echo "<script type='text/javascript' src='../../js/tabs/tabpane.js'></script>";
echo "<link type='text/css' rel='StyleSheet' href='../../js/tabs/tabpane.css' />";

echo "<div STYLE='width:100%; height:100%' class='tab-pane' id='tab-pane-1' name='tabulatori'>";


echo   "<div class='tab-page' id='Treetab' name='tab1' >";
echo      "<h2 class='tab' id='Treefiles'>ICONS</h2>";
	echo "</br>";	echo "</br>";
	 // echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "prova.php?op=editfile&file=[link]"); 
	  echo php_file_tree("../../icons", "setting.php?op=selezioneicona&icona=[link]&app=".$_GET['app']."&IDicona=".$_GET['IDicona']); 


$pos      = strripos($icona, '/')+1;
$stringa = strlen($icona);
//$rest = substr($icona, 0, $pos);
//$des = substr($icona, -4);

$lamia = substr($icona, $pos, $stringa);
$lamia = substr($lamia, 0, -4);

$Deskicon = substr($icona, 4, $stringa);

$Deskprogramlen = strlen($program);
$Deskprogram = substr($program, 6, $Deskprogramlen);


echo 	  "<div STYLE='position:absolute; top:20px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";

	echo "<form name='selezionaicona' action='setting.php?op=selezioneicona&icona=$icona&IDicona=$IDicona' method='post'>";
	echo "<h3 class='edit'>Icona Applicazione: <input type='text' id='seleicon' name='sele-icon' size='50' value='$Deskicon'> <img src='../../$Deskicon' title='$Deskicon' style='width: 50px; height: 50px;'; /></h3>";
	echo "<h3 class='edit'>___ID Applicazione: <input type='text' id='appseleicon' name='app-sele-icon' size='50' value='$lamia'></h3>";
//	echo "<h3 class='edit'>___Controllo: <input type='text' id='appcontrollo' name='app-controllo' size='50' value='$Deskprogram'><input type='image' src='../../_images/page_add.png' onclick='' title='Crea Nuovo File'/></h3>";
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
	 // echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "prova.php?op=editfile&file=[link]"); 
	  echo php_file_tree("../../applications", "setting.php?op=selezioneprogramma&app=[link]&icona=".$_GET['icona']."&IDicona=".$_GET['IDicona']); 


echo 	  "<div STYLE='position:absolute; top:20px; left:300px' 'width:50%; height:50%'  name='tab1con' >";
	echo "</br>";


	echo "<form name='selezionafile' action='setting.php?op=selezioneprogramma&app=$program' method='post'>";
	echo "<h3 class='edit'>Applicazione Selezionata: <input type='text' id='seleapp' name='sele-app' size='50' value='$program'>\n</h3>";
	echo "<h3 class='edit'>E'possibile Inserire anche un indirizzo web come Applicazione Selezionata Remota.</h3>\n";
//	echo "<input type='image' src='../../_images/folder_add.png' onclick='' title='Crea Nuova Cartella mod'/>";
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

	echo "<form name='salvadati' action='setting.php?op=salvadati&Deskicon=$myDI&mynamefile=$myname' method='post'>";
	echo "<input type='hidden' id='codice' name='myfile' value=''>";
	echo "<input type='hidden' id='codice1' name='myname' value='$lamia'>";

	echo "<textarea STYLE='width:100%; height:100%' id='myDeskIcon' name='myDI' rows='20' cols='300%'  wrap='physical' >";

        echo "<table id=\"ID$lamia\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 50px; height: 50px; float: Left;\"><tbody>\n";
        echo "<tr><td style=\"text-align: center;\"><img id=\"IM$lamia\" src=\"$Deskicon\" style=\"width: 50px; height: 50px;\"; title=\"$lamia Window\" onclick=\"abilita('IDTXT$lamia');\" onDblClick=\"$lamia();\" /></td></tr>\n";
	echo "<tr><td style=\"text-align: center;\"><input type=\"text\" id=\"IDTXT$lamia\" name=\"IDNAME$lamia\" value=\"$lamia\" disabled=true style=\"text-align: center;\" onblur=\"disabilita('IDTXT$lamia');\" onDblClick=\"modifica('IDTXT$lamia');\" size=\"8\" maxlength=8 ></td></tr></tbody></table>\n";
	echo "function $lamia(){\n";
	echo " var win$lamia = new Window({className: \"mac_os_x\", blurClassName: \"blur_os_x\", title: \" $lamia\", width:500, height:300, top: 0, left:0}); \n";
	echo "     win$lamia.setURL(\"$Deskprogram\");\n";
	echo "     win$lamia.setStatusBar(\"$lamia\");\n";
	echo "//   win$lamia.showCenter();\n";
	echo "     win$lamia.show();\n";
	echo "}\n";
	echo "  new Draggable(\"ID$lamia\",{handle:\"$lamia\",revert:function(element){}});\n";
	echo "\n";
	echo "ID$lamia = new ContextMenu();\n";
	echo "	ID$lamia.addItem(\"apri\",   \"Apri\",   $lamia, \"_images/application_go.png\");\n";
	echo "	ID$lamia.addItem(\"taglia\",   \"Elimina\",   elimina, \"_images/application_delete.png\");\n";
	echo "	ID$lamia.addItem(\"copia\",   \"Copia\",   copia, \"_images/application_double.png\");\n";
	echo "	ID$lamia.addItem(\"rinomina\",   \"Rinomina...\",   abilita, \"_images/application_edit.png\");\n";
	echo "	ID$lamia.addSeparator();\n";
	echo "	ID$lamia.addItem(\"coordinate\",   \"Memoriza Posizione\",   rilevacoordinate, \"_images/mouse.png\");\n";
	echo "	ID$lamia.addItem(\"proprieta\",   \"Proprietà\",   property, \"_images/application_key.png\");\n";
	echo "	ID$lamia.register(\"ID$lamia\");\n";
	echo "\n";

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
// ---------------------------------------------------------------------------------------------------------------------

echo "</div>";
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
	<script src="../../js/jquery.min.js"></script>
			<td valign="top" width="100%">

</p>

<style>
body {
        margin: 0;
}
 
.pushmenu {
        background: #3c3933;
        font-family: Arial, Helvetica, sans-serif;
        position: fixed;
        width: 240px;
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
        left: -240px;   
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
        left: 240px;    
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
//        text-indent: -99999em;  
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

<script>
//----------------------------------------------------------------------------------------------------------
        $(document).ready(function() {
                $menuLeft = $('.pushmenu-left');
                $nav_list = $('#nav_list');
                $nav_list1 = $('#nav_list1');
                 
                $nav_list.click(function() {
                        $(this).toggleClass('active');
                        $('.pushmenu-push').toggleClass('pushmenu-push-toright');
                        $menuLeft.toggleClass('pushmenu-open');
                });
                $nav_list1.click(function() {
                        $(this).toggleClass('active');
                        $('.pushmenu-push').toggleClass('pushmenu-push-toright');
                        $menuLeft.toggleClass('pushmenu-open');
                });
        });
//----------------------------------------------------------------------------------------------------------
</script>

<body class="pushmenu-push">
<nav class="pushmenu pushmenu-left">
<input type='image' src="../../applications/setting/images/menu.png" id="nav_list1" border=0 WIDTH="50" HEIGHT="50" hspace="5" vspace="10"  align="left" /><br>
    <h3 style="text-align:center;" ><?=_WELCOME?> D+ Settings</h3><br>
    <a href="setting.php"><input type='image' src="../../applications/setting/images/logo.png" onclick="javascript: location.href='setting.php';" title="<?=_WELCOME?> in D+ Settings" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> Home </a>
    <a href="setting.php?op=settingdisplay"><input type='image' src="../../applications/setting/images/setting-display.png" onclick="javascript: location.href='setting.php?op=settingdisplay';" title="[<?=_SETTING_DISPLAY?>]" border=0 WIDTH="32" HEIGHT="32" /> <?=_SETTING_DISPLAY?> </a>
    <a href="setting.php?op=pannello"><input type='image' src="../../applications/setting/images/pannello.png" onclick="javascript: location.href='setting.php?op=pannello';" title="[<?=_PANNELLO?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_PANNELLO?> </a>
    <a href="setting.php?op=cestino"><input type='image' src="../../applications/setting/images/delete.png" onclick="javascript: location.href='setting.php?op=cestino';" title="[<?=_ELIMINA_ICONA?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_ELIMINA_ICONA?> </a>
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

</style>

<div class="ipuser" style="position:fixed; top: 0px; left: 0px; width:100%; z-index: 20;">
<input type='image' src="../../applications/setting/images/menu.png" id="nav_list" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left" />
<input type='image' src="../../applications/setting/images/logo.png" onclick="javascript: location.href='setting.php';" title="<?=_WELCOME?> in D+ Setting" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/>
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

//	    session_start();
	    //$utente="daniele";
	    $utente=$_COOKIE['utente'];
	    $cartella=$_COOKIE['cartella'];

	$op=$_GET['op'];


	if ($op==""){
	    makeform();
	}

	if ($op=="settingdisplay"){
	    setdisplay();
	}

	if ($op=="pannello"){
	    setpannello();
	}

	if ($op=="cestino"){
	    cestino();
	}

	if ($op=="selezioneicona"){
	    $icona=$_GET['icona'];
	    $program=$_GET['app'];
	    $IDicona=$_GET['IDicona'];
	    makeform();
	}

	if ($op=="selezioneprogrammadacancellare"){
	    $deskprogram=$_GET['deskapp'];
	    cestino();
	}

	if ($op=="selezioneprogramma"){
	    $deskprogram=$_GET['deskapp'];
	    makeform();
	}

	if ($op=="selezionesfondo"){
	    $deskprogram=$_GET['filedeskwall'];
	    setdisplay();
	}


	if ($op=="salvadati"){
	    $Deskicon=$_POST['myfile'];
	    $mynamefile=$_POST['myname'];
            $fp=fopen("../../users/".$utente."/".$cartella."/Deskicons/$mynamefile.desk","w");
            fwrite($fp, $Deskicon);
            fclose($fp);
            echo "<br><br><br><br><br>Nuovo file creato !!!<br>";
            echo "nome file: $mynamefile.desk<br>";
	    // echo "contenuto file: ".$Deskicon."<br>";
	    echo "<h3 class='edit'><a href='setting.php'>"._CONTINUA."</a></h3>";
	}

	if ($op=="cancellafile"){
            $deskapp=$_POST['delefiledeskapp'];
	    $lunghezza=strlen($deskapp);
	    $lunghezza=$lunghezza - 22;
	    $appdesk=substr($deskapp, 22, $lunghezza);
	    copy($deskapp,"../../users/".$utente."/".$cartella."/Cestino/".$appdesk);
            unlink("$deskapp");
	    echo "<br><br><br><br><br>$appdesk eliminato !!!";
	    echo "<h3 class='edit'><a href='setting.php?op=cestino'>"._CONTINUA."</a></h3>";
	}


	if ($op=="modificapannellocolore"){
            $deskpanelcolor=$_GET['deskpanelcolor']; 

	    if ($deskpanelcolor == 'black') { $deskposition = "  background:transparent url(taskbar-start-panel-bg.gif) repeat-x 0 0;"; $deskposition1 = "    background: url(taskbar-start-panel-bg.gif);"; }
	    if ($deskpanelcolor == 'blue') { $deskposition = "  background:transparent url(taskbar-start-panel-blue.gif) repeat-x 0 0;"; $deskposition1 = "    background: url(taskbar-start-panel-blue.gif);"; }
	    if ($deskpanelcolor == 'red') { $deskposition = "  background:transparent url(taskbar-start-panel-red.gif) repeat-x 0 0;"; $deskposition1 = "    background: url(taskbar-start-panel-red.gif);"; }
	    if ($deskpanelcolor == 'yellow') { $deskposition = "  background:transparent url(taskbar-start-panel-yellow.gif) repeat-x 0 0;"; $deskposition1 = "    background: url(taskbar-start-panel-yellow.gif);"; }
	    if ($deskpanelcolor == 'green') { $deskposition = "  background:transparent url(taskbar-start-panel-green.gif) repeat-x 0 0;"; $deskposition1 = "    background: url(taskbar-start-panel-green.gif);"; }

	    $content = file("../../users/$utente/$cartella/pwc-os.css");
	    $content[25] = $deskposition."\n";
	    $content[35] = $deskposition1."\n";
	    $content[92] = $deskposition1."\n";
		for ($i = 0; ; $i++) {
		    if ($i > 103) {
		        break;
		    }
	    $miofile = $miofile.$content[$i];
		}

	    // echo $miofile;

            $fp=fopen("../../users/$utente/$cartella/pwc-os.css","w");
            fwrite($fp, $miofile);
            fclose($fp);
	    echo "<br><br><br><br>Colore del Pannello modificato - Nuovo Colore: ".$deskpanelcolor."<br>";
	    echo "<h3 class='edit'><a href='setting.php?op=pannello'>"._CONTINUA."</a></h3>";
	}



	if ($op=="modificapannello"){
            $deskpanel=$_GET['deskpanel']; //echo "pannello selezionato: ".$deskpanel;

	    if ($deskpanel == 'top') { $deskposition = "  top:0;"; }

	    if ($deskpanel == 'bottom') { $deskposition = "  bottom:0;"; }

	    $content = file("../../users/$utente/$cartella/pwc-os.css");
	    $content[20] = $deskposition."\n";
		for ($i = 0; ; $i++) {
		    if ($i > 103) {
		        break;
		    }
	    $miofile = $miofile.$content[$i];
		}

	    // echo $miofile;

            $fp=fopen("../../users/$utente/$cartella/pwc-os.css","w");
            fwrite($fp, $miofile);
            fclose($fp);
	    echo "<br><br><br><br>posizione Pannello modificata - Nuova Posizione: ".$deskpanel."<br>";
	    echo "<h3 class='edit'><a href='setting.php?op=pannello'>"._CONTINUA."</a></h3>";
	}


	if ($op=="modificasfondo"){
            $deskwall=$_POST['filedeskwall'];
	    $lunghezza=strlen($deskwall);
	    $lungoutente=strlen($utente);
	    $lungocartella=strlen($cartella);
	    $lungototale=14+$lungoutente+$lungocartella;
	    $lunghezza=$lunghezza - $lungototale;
	    $walldesk=substr($deskwall, $lungototale, $lunghezza);
            $sfondo1 = "  background: #000000 url(";
	    $sfondo2 = ") no-repeat fixed center    ; background-size: 100%;";

	    $content = file("../../users/$utente/$cartella/pwc-os.css");
	    $content[4] = $sfondo1.$walldesk.$sfondo2."\n";
		for ($i = 0; ; $i++) {
		    if ($i > 103) {
		        break;
		    }
	    $miofile = $miofile.$content[$i];
		}

	    // echo $miofile;

            $fp=fopen("../../users/$utente/$cartella/pwc-os.css","w");
            fwrite($fp, $miofile);
            fclose($fp);
	    echo "<br><br><br><br>nuovo sfondo: ".$sfondo1.$walldesk.$sfondo2."<br>";
	    echo "$walldesk selezionato come sfondo !!!";
	    echo "$colordeskwall selezionato come colore !!!";
	    echo "<h3 class='edit'><a href='setting.php?op=settingdisplay'>"._CONTINUA."</a></h3>";
	}

	if ($op=="modificacolore"){
	    $colorkwall=$_POST['colordeskwall'];

	    $content = file("../../users/$utente/$cartella/pwc-os.css");
	    $riga = strlen($content[4]);
	    $riga1 = substr($content[4], 0, 15);
	    $riga2 = substr($content[4], 21, $riga);
	    echo "riga: ".$riga."<br>";
	    echo "riga1: ".$riga1."<br>";
	    echo "riga2: ".$riga2."<br>";

	    $content[4] = $riga1.$colorkwall.$riga2;
		for ($i = 0; ; $i++) {
		    if ($i > 103) {
		        break;
		    }
	    $miofile = $miofile.$content[$i];
		}

	    // echo $miofile;

            $fp=fopen("../../users/$utente/$cartella/pwc-os.css","w");
            fwrite($fp, $miofile);
            fclose($fp);
	    echo "<br><br><br><br>$colorkwall selezionato come colore !!!"."<br>";
	    echo "<h3 class='edit'><a href='setting.php?op=settingdisplay'>"._CONTINUA."</a></h3>";
	}

?>


