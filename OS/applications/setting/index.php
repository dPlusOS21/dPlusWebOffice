<?php

$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

$action=$_GET['action'];

$filename=$_GET['filename'];


// Preparazione Cartelle di lavoro -------------------------------------------------------------------------------------------------

if ($utente!=""){
	// se la directory datas/applications/$appname non c'e' la crea:
	if(file_exists("../../users/$utente/$cartella/contacts")==false){
	    mkdir("../../users/$utente/$cartella/contacts",0775);
	}
	if(file_exists("../../users/$utente/$cartella/contacts/setting")==false){
	    mkdir("../../users/$utente/$cartella/contacts/setting",0775);
	}
	      }

// Fine Preparazione Cartelle di lavoro --------------------------------------------------------------------------------------------


// FUNZIONI DI SERVIZIO PHP --------------------------------------------------------------------------------------------------------
//__________________________________________________________________________________________________________________________________

// chiede il nome del link
function mod_setting(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="contacts";
    $siteurl=$_GLOBALS['siteurl'];

	$name="setting";

	if ($utente!=""){
	    $content=file("../../users/$utente/$cartella/contacts/setting/".$name.".contact");

	    $prefisso  = $content[0];
/*	    $casa = $content[0];
	    $email1 = $content[1];
	    $email2 = $content[2];
	    $email3 = $content[3];
	    $email4 = $content[4];
	    $email5 = $content[5];

	    $cell1 = $content[6];
	    $cell2 = $content[7];

	    $lavoro = $content[8];
	    $fax = $content[9];

	    $msn = $content[10];
	    $skype = $content[11];
	    $twitter = $content[12];
	    $facebook = $content[13];
	    $whatsapp = $content[14];
	    $foto = $content[15];
	    $googleplus = $content[16];
*/

//	echo "	<meta charset='utf-8'>";
//	echo "	<meta name='viewport' content='width=device-width,initial-scale=1.0'>";

 // Admin form link user
    echo "<br><br><br><br><br><center>SETTING</center><table border='0' class='file' width='90%' style='padding:5px'>
    <form  name='addfile' enctype='multipart/form-data' action='".$siteurl."index.php?action=exec_add_setting' method='post'>
    <tr>
    <td> <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='prefisso' type='tel' value='$prefisso' size='25%' placeholder='"._PREFISSO_CONTACT."' ></td>
    </tr>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._SETTING_ADD_CONTACT."</span></button>  <span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' onclick=\"javascript:window.location.href='index.php';\" >"._ANNULLA."</span>
    </td>
    </tr>
	</form>
    </table>";
	}
}

//__________________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________________________

// esegue il caricamento del link
function exec_add_setting(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="contacts";
	$siteurl=$_GLOBALS['siteurl'];

	$name="setting";
	$prefisso=$_POST['prefisso'];
//	$desc=stripslashes($_POST['desc']);

	if ($utente!=""){
	    $hf=fopen("../../users/$utente/$cartella/contacts/setting/".$name.".contact","w");
	    fwrite($hf,"$prefisso\n");
	    fclose($hf);
	}
	else
	    echo _ERRORE_DI_AUTENTICAZIONE;
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php\">";
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________


// chiede il nome del link
function mod_contact(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $myforum=$_COOKIE['myforum'];
    $appname ="contacts";
    $siteurl=$_GLOBALS['siteurl'];

	$name=$_GET['filename'];
	$copia=$name;

	if ($utente!=""){
	    $content=file("../../users/$utente/$cartella/contacts/".$name.".contact");

	    $casa = $content[0];
	    $email1 = $content[1];
	    $email2 = $content[2];
	    $email3 = $content[3];
	    $email4 = $content[4];
	    $email5 = $content[5];

	    $cell1 = $content[6];
	    $cell2 = $content[7];

	    $lavoro = $content[8];
	    $fax = $content[9];

	    $msn = $content[10];
	    $skype = $content[11];
	    $twitter = $content[12];
	    $facebook = $content[13];
	    $whatsapp = $content[14];
	    $foto = $content[15];
	    $googleplus = $content[16];


//	echo "	<meta charset='utf-8'>";
//	echo "	<meta name='viewport' content='width=device-width,initial-scale=1.0'>";

 // Admin form link user
    echo "<br><br><br><br><br><table border='0' class='file' width='100%' style='padding:10px'>
    <form  name='addfile' enctype='multipart/form-data' action='".$siteurl."index.php?action=exec_add_contact' method='post'>
	<input type='hidden' id='copia' name='copia' value='$copia'>
    <tr>
    <td ></td><td> <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='name' type='text' value='$name' size='25%' placeholder='"._NOME_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='casa' type='tel' value='$casa' size='25%' placeholder='"._CASA_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='cell1' value='$cell1' type='tel' size='25%' placeholder='"._CELL1_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='cell2' value='$cell2' type='tel' size='25%' placeholder='"._CELL2_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='lavoro' value='$lavoro' type='tel' size='25%' placeholder='"._LAVORO_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='fax' value='$fax' type='tel' size='25%' placeholder='"._FAX_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email1' value='$email1' type='email' size='25%' placeholder='"._EMAIL1_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email2' value='$email2' type='email' size='25%' placeholder='"._EMAIL2_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email3' value='$email3' type='email' size='25%' placeholder='"._EMAIL3_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email4' value='$email4' type='email' size='25%' placeholder='"._EMAIL4_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email5' value='$email5' type='email' size='25%' placeholder='"._EMAIL5_CONTACT."' ></td>
    </tr>

    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='msn' value='$msn' type='text' size='25%' placeholder='"._MSN_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='skype' value='$skype' type='text' size='25%' placeholder='"._SKYPE_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='twitter' value='$twitter' type='text' size='25%' placeholder='"._TWITTER_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='facebook' value='$facebook' type='text' size='25%' placeholder='"._FACEBOOK_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='whatsapp' value='$whatsapp' type='text' size='25%' placeholder='"._WHATSAPP_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='googleplus' value='$googleplus' type='text' size='25%' placeholder='"._GOOGLEPLUS_CONTACT."' ></td>
    </tr>


    <tr>
    <td width='5%' class='black'></td><td> <br>
	    <select name='avatar' onchange=\"document.addfile.foto.value=document.addfile.avatar.options[avatar.selectedIndex].text\" >
";
		    $hdir=opendir("../../users/$utente/$cartella/files/foto");
		    $i=0;
		    while (false !== ($f= readdir($hdir))){
			if ($f[0]!="." && substr($f,-3,3)!="inc"){
			    $listfiles[$i]=$f;
			    $i++;
			}
		    }
		    echo("<option>Seleziona Foto ...</option>\n");
		    foreach( $listfiles as $filesel){
			    echo("<option>$filesel</option>\n");
		    }

echo "	    </select></td>
    </tr>

    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' id='foto' name='foto' value='$foto' type='text' size='25%' placeholder='"._FOTO_CONTACT."' ></td>
    </tr>

    <tr>
    <td></td>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ADD_CONTACT."</span></button>  <span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' onclick=\"javascript:window.location.href='index.php';\" >"._ANNULLA."</span>
    </td>
    </tr>
	</form>
    </table>";

	}

}

//__________________________________________________________________________________________________________________________________
// visualizza email inviate
function exec_outbox_email(){
	$utente=$_COOKIE["utente"];
	$cartella=$_COOKIE["cartella"];
	$user_avatar=$_COOKIE['user_avatar'];
	$appname ="Dplus_Mail";
	$siteurl=$_GLOBALS['siteurl'];





} // fine funzione email inviate
//__________________________________________________________________________________________________________________________________

// visualizza email nel cestino
function vedi_cestino(){
	$utente=$_COOKIE["utente"];
	$cartella=$_COOKIE["cartella"];
	$user_avatar=$_COOKIE['user_avatar'];
	$appname ="Dplus_Mail";
	$siteurl=$_GLOBALS['siteurl'];


$pop = "imap.gmail.com";
$username = "nost.ass@gmail.com";
$password = "nefertiri";
$porta = 993;
 
$inbox = imap_open("{".$pop.":".$porta."/imap/ssl/novalidate-cert}INBOX", $username, $password);

$status = imap_status($inbox, "{".$pop.":".$porta."/imap/ssl/novalidate-cert}INBOX", "DELETED");

echo "<br><br><br><br>sono qua";

print_r($status);

break;

if ($status) {
		echo "<div id='rssList'  style='width:100%;' >
		      <center>
		      <p><a style='font-weight:normal; font-size: 16px;' >"._INBOX." <font color='red' >".$status->unseen."</font></a></p>
		      </center>
		      <input type='image' src='./images/scrivi.png' style='position:relative; z-index: 10; top: -40px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />
<!--		      <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
		";

//  echo "Messages:   " . $status->messages    . "<br />\n";
//  echo "Recent:     " . $status->recent      . "<br />\n";
//  echo "Unseen:     " . $status->unseen      . "<br />\n";
//  echo "UIDnext:    " . $status->uidnext     . "<br />\n";
//  echo "UIDvalidity:" . $status->uidvalidity . "<br />\n";
} else {
  echo "imap_status failed: " . imap_last_error() . "\n";
}

			$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
			$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
			$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
			$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

$MC=imap_check($inbox); 
$MN=$MC->Nmsgs; 
$overview=imap_fetch_overview($inbox,"1:$MN",0); 
$size=sizeof($overview); 
for($i=$size-1;$i>=0;$i--){ 
$val=$overview[$i]; 
$msg=$val->msgno; 
$from=$val->from; 
$date=$val->date;
$date = date("j-n-Y G:i:s", strtotime($date));
$subj=$val->subject; 

$letto=$val->seen;
//echo "Letto: ".$letto;

//$eliminato=$val->deleted;
//echo "Eliminato: ".$eliminato;

$flagged=$val->flagged;
//echo "Flagged: ".$flagged;


//if ($letto) {$iniziobold =""; $finebold = "";} else { $iniziobold ="<b>"; $finebold = "</b>"; }

//$body = imap_fetchbody( $inbox, $msg, "1.2" );
//$headers=imap_header($inbox, $i);
//$data=date("j/n/Y G:i:s",strtotime($headers->date));

//$body = imap_body($inbox, $msg);
//echo "#$msg: From:'$from' Date:'$date' Subject:'$subj'<BR>"; 



			if ($iphone || $android || $palmpre || $ipod || $berry == true){
			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";
			} else {

if ($letto) { 

			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: white; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>";
					if ($flagged) { echo "<div style='position:relative; top: -60px; ' align='right'> <input type='image' src='./images/flagged.png' border=0 WIDTH='35' HEIGHT='35' /> </div>"; }
echo "
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";


 } else { 

			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>";
					if ($flagged) { echo "<div style='position:relative; top: -60px; ' align='right'> <input type='image' src='./images/flagged.png' border=0 WIDTH='35' HEIGHT='35' /> </div>"; }
echo "
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";


 }
			}
}
    imap_close($imap);
		echo "</div>";
	    echo "
		
		<div id='rssOutput'  style='top: 55px; left: 0px; width:100%;' ></div>
		</html>";
	    break;



} // fine funzione email cestino
//__________________________________________________________________________________________________________________________________


// chiede il nome del link
function add_email(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="Dplus_Mail";
    $siteurl=$_GLOBALS['siteurl'];

//	echo "	<meta charset='utf-8'>";
//	echo "	<meta name='viewport' content='width=device-width,initial-scale=1.0'>";

 // Admin form link user
    echo "<br><br><br><br><br><table border='0' class='file' width='100%' style='padding:10px'>
    <form  name='addfile' enctype='multipart/form-data' action='".$siteurl."index.php?action=exec_add_contact' method='post'>
    <tr>
    <td ></td><td> <input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='name' type='text' size='25%' placeholder='"._NOME_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='casa' type='tel' size='25%' placeholder='"._CASA_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='cell1' type='tel' size='25%' placeholder='"._CELL1_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='cell2' type='tel' size='25%' placeholder='"._CELL2_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='lavoro' type='tel' size='25%' placeholder='"._LAVORO_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='fax' type='tel' size='25%' placeholder='"._FAX_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email1' type='email' size='25%' placeholder='"._EMAIL1_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email2' type='email' size='25%' placeholder='"._EMAIL2_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email3' type='email' size='25%' placeholder='"._EMAIL3_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email4' type='email' size='25%' placeholder='"._EMAIL4_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='email5' type='email' size='25%' placeholder='"._EMAIL5_CONTACT."' ></td>
    </tr>

    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='msn' type='text' size='25%' placeholder='"._MSN_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='skype' type='text' size='25%' placeholder='"._SKYPE_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='twitter' type='text' size='25%' placeholder='"._TWITTER_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='facebook' type='text' size='25%' placeholder='"._FACEBOOK_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='whatsapp' type='text' size='25%' placeholder='"._WHATSAPP_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' name='googleplus' type='text' size='25%' placeholder='"._GOOGLEPLUS_CONTACT."' ></td>
    </tr>
    <tr>
    <td width='5%' class='black'></td><td> <br>
	    <select name='avatar' onchange=\"document.addfile.foto.value=document.addfile.avatar.options[avatar.selectedIndex].text\" >
";
		    $hdir=opendir("../../users/$utente/$cartella/files/foto");
		    $i=0;
		    while (false !== ($f= readdir($hdir))){
			if ($f[0]!="." && substr($f,-3,3)!="inc"){
			    $listfiles[$i]=$f;
			    $i++;
			}
		    }
		    echo("<option>Seleziona Foto ...</option>\n");
		    foreach( $listfiles as $filesel){
			    echo("<option>$filesel</option>\n");
		    }

echo "	    </select></td>
    </tr>

    <tr>
    <td width='5%' class='black'></td><td> <br><input style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' id='foto' name='foto' type='text' size='25%' placeholder='"._FOTO_CONTACT."' ></td>
    </tr>

    <tr>
    <td></td>
    <td>
	<br><button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ADD_CONTACT."</span></button>  <span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;' onclick=\"javascript:window.location.href='index.php';\" >"._ANNULLA."</span>
    </td>
    </tr>
	</form>
    </table>";

}
//__________________________________________________________________________________________________________________________________

// esegue il caricamento del link
function exec_add_email(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    if ($utente!=""){
        $appname ="contacts";
	$siteurl=$_GLOBALS['siteurl'];

	$copia=$_POST['copia'];
	$name=$_POST['name'];

	if ( $name != $copia ){ 
		unlink("../../users/$utente/$cartella/contacts/".$copia.".contact");
	}

	$casa=$_POST['casa'];

	$email1=$_POST['email1'];
	$email2=$_POST['email2'];
	$email3=$_POST['email3'];
	$email4=$_POST['email4'];
	$email5=$_POST['email5'];

	$cell1=$_POST['cell1'];
	$cell2=$_POST['cell2'];
	$lavoro=$_POST['lavoro'];
	$fax=$_POST['fax'];
	$msn=$_POST['msn'];
	$skype=$_POST['skype'];
	$twitter=$_POST['twitter'];
	$facebook=$_POST['facebook'];
	$whatsapp=$_POST['whatsapp'];
	$foto=$_POST['foto'];
    	$googleplus = $_POST['googleplus'];

if ($foto == ""){ 
	$foto = 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg';
}

	$desc=stripslashes($_POST['desc']);
	$vers=$_POST['vers'];

	$myforum=$_COOKIE['myforum'];

	if ($utente!=""){
	    $hf=fopen("../../users/$utente/$cartella/contacts/".$name.".contact","w");
	    fwrite($hf,"$casa\n");
	    fwrite($hf,"$email1\n");
	    fwrite($hf,"$email2\n");
	    fwrite($hf,"$email3\n");
	    fwrite($hf,"$email4\n");
	    fwrite($hf,"$email5\n");

	    fwrite($hf,"$cell1\n");
	    fwrite($hf,"$cell2\n");
	    fwrite($hf,"$lavoro\n");
	    fwrite($hf,"$fax\n");
	    fwrite($hf,"$msn\n");
	    fwrite($hf,"$skype\n");
	    fwrite($hf,"$twitter\n");
	    fwrite($hf,"$facebook\n");
	    fwrite($hf,"$whatsapp\n");
	    fwrite($hf,"$foto\n");
	    fwrite($hf,"$googleplus\n");

	    fclose($hf);
	}
	else
	    echo _ERRORE_DI_AUTENTICAZIONE;
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php\">";
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________________________

// cancella il file
function delete_filecontact(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $appname ="contacts";
    $filename=$_GET['filename'];
    $siteurl=$_GLOBALS['siteurl'];

    echo "<br><br><br><br><br><br>";
    echo "<form name='deletefeed' action='".$siteurl."index.php?action=exec_delete_contact&filename=$filename' method='POST'>
	<div class='black_bold'>"._ELIMINA."$filename</div><br><br>
	<button style='border: 1px solid #41A317; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #41A317; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span class='label'>"._ELIMINA."</span></button>
	<a href='index.php' title='"._ANNULLA."'><span style='border: 1px solid red; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: red; color: #FFFFFF; font-weight:bold; font-size: 12px;'>"._ANNULLA."</span></a>
	</form>";
}
//__________________________________________________________________________________________________________________________________

// esegue la cancellazione del file
function exec_delete_filecontact(){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

$dpath="../../users/$utente/$cartella/contacts/";

    if ($utente!=""){
        $appname ="contacts";
	$filename=$_GET['filename'];
	$siteurl=$_GLOBALS['siteurl'];

	if (unlink($dpath.$filename.".contact")!=true){
	    echo "<br><font class='black_bold'>"._IN_FILE."$dpath$filename</font><br><br>
		<input type='button' value='"._ANNULLA."' onclick=\"javascript:window.location.href='index.php';\">
	    ";
	}
	else{
	    echo "<br><br><img src='../../applications/$appname/none_images/icon2.gif' border='0'> <font class=black_bold>"._FILE_DELETED."!</font><br/>";
	    echo "<meta http-equiv=\"Refresh\" content=\"0; URL=".$siteurl."index.php\">";
	}
    }
    else
	die(_NONPUOI);
}
//__________________________________________________________________________________________________________________________________

// visualizza la pagina di ricerca
function search($dpath){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

	$siteurl=$_GLOBALS['siteurl'];
        $appname ="contacts";
if ($utente!=""){
  //Search
	echo "<br><br><br><br><div>";
    	echo "<br><br><form name='addfile' enctype='multipart/form-data' action='index.php?dpath=$dpath&action=exec_search' method='post'>";

/*	echo "<center>
		<button onclick=\"javascript: file.value='only A';\" style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > A </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > B </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > C </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > D </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > E </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > F </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > G </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > H </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > I </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > L </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > M </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > N </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > O </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > P </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > Q </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > R </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > S </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > T </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > U </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > V </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > W </span></button>

		<button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'>
		<span > Z </span></button>

	</center>";
*/
	echo "<center><input class='input_text' style='border: 2px solid skyblue; padding-top:8px; padding-bottom:8px; padding-right:5px; padding-left:5px;' type='text' name='file' size='25%'/></center><br><br>";
	echo "<center><button style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;'><span >["._FINDFILES."]</span></button></center>";
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
    $appname ="contacts";
    $pattern=$_POST['file'];

$dpath="../../users/".$utente."/".$cartella."/contacts/";

    echo "<div id='cerca'><br><br><br><br><left><div class='black_bold'><img src='../../applications/$appname/images/icon2.gif' border='0'> "._FINDINGFILES."  <font class='black'>\"$pattern\"</font></div></div>";
    //echo "<br>";
    $pattern=str_replace("*","",$pattern);
    $path="../../users/".$utente."/".$cartella."/contacts/";

    if ($pattern!="")
	searchdir($path,$pattern);

//	echo "<br><center><a href='index.php' class='' title='[Home]'><span style='border: 1px solid orange; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: orange; color: #FFFFFF; font-weight:bold; font-size: 12px;' class='button'>[Home]</span></a>&nbsp;&nbsp;";
//    	echo "<a href='index.php?action=search' class='' title='["._NEW_SEARCH."]'><span style='border: 1px solid #0094FF; border-radius: 3px 3px 3px 3px; padding-top:8px; padding-bottom:8px; padding-right:25px; padding-left:25px; background-color: #0094FF; color: #FFFFFF; font-weight:bold; font-size: 12px;' class=''>[Find]</span></a>&nbsp;&nbsp;</center>";

}


//l'handler di ricerca(la funzione e' ricorsiva)
function searchdir($dpath,$pattern){
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

    $siteurl=$_GLOBALS['siteurl'];
    $appname ="contacts";

$i=0;
$dpath=opendir("../../users/".$utente."/".$cartella."/contacts/");
//echo substr($pattern, 0, 5); echo "---->".substr($pattern, 5, 1);
// ciclo ordinato con il sort ------------------------------------------------------------------------------
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		echo "<div id='rssList'  style='width:100%;' ><center><a style='font-weight:bold; font-size: 16px;' >Contacts</a></center>";

		$files = array();
		while ($files[] = readdir($dpath));
		sort($files);
		closedir($dpath);

		foreach ($files as $file) {
//echo substr($file, 0, 1);
		    if( substr($file, -7) == "contact" && $file != "." && $file != ".." && strpos(strtolower($file),strtolower($pattern),0) !== false ) {

/* inizio if */   //  if( substr($pattern, 0, 5) == "only " && substr($file, 0, 1) == substr($pattern, 5, 1) ) {
		    	$content=file("../../users/$utente/$cartella/contacts/".$file); $nomefile=substr($file, 0, -8); $i++;

			$foto = $content[15]; //echo "ecccollooooooo ".$q;

			if (substr($foto,0,4)=="http"){ $foto = $foto;} else { $foto = "../../users/$utente/$cartella/files/foto/$foto"; }

			if ($iphone || $android || $palmpre || $ipod || $berry == true){

			    	echo "<div id='feed-$i' onclick='showRSS(\"$nomefile\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:18px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>  <input type='image' src='$foto' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px;' />   <span>".wordwrap(substr($file, 0, -8), 19, "<br>", true). "</span><input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> </div>";
			} else {
			    	echo "<div id='feed-$i' onclick='showRSS(\"$nomefile\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:18px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>  <input type='image' src='$foto' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px;' />   <span>".substr($file, 0, -8). "</span><input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> </div>";
			}

//		    } // fine if

		    }
		}
// ciclo ordinato con il sort ------------------------------------------------------------------------------
		echo "</div>";
	    echo "
		
		<div id='rssOutput'  style='top: 55px; left: 0px; width:100%;' ></div>
";
}
//__________________________________________________________________________________________________________________________________

// FINE FUNZIONI DI SERVIZIO PHP ---------------------------------------------------------------------------------------------------


$lang="it";
//carica la lingua se esiste
if (file_exists("./lang/$lang.inc"))
    include "./lang/$lang.inc";
else
    include "./lang/it.inc";

?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script src="../../js/jquery.min.js"></script>

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

<script>
//----------------------------------------------------------------------------------------------------------
function showRSS(str, from, date, subj)
{ //alert(str);

if (str.length==0)
  { 
  document.getElementById("rssOutput").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
    }
  }

document.getElementById("rssList").style.display='none';

xmlhttp.open("GET","getrss.php?q="+str+"&from="+from+"&date="+date+"&subj="+subj,true);
xmlhttp.send();
}
//----------------------------------------------------------------------------------------------------------
</script>

<script>
//----------------------------------------------------------------------------------------------------------
function viewitemdesc(i) {
    if(    document.getElementById("itemdesc-"+i).style.display!='none'){
    document.getElementById("itemdesc-"+i).style.display='none';
    }
    else{
    document.getElementById("itemdesc-"+i).style.display='inline';
    }
	for (var a=0; a<=250;a++) { if (a != i){ document.getElementById("itemdesc-"+a).style.display='none'; }
	}
}
//----------------------------------------------------------------------------------------------------------
function viewitemall() {
    if(    document.getElementById("itemdesc-call").style.display!='none'){
    document.getElementById("itemdesc-call").style.display='none';
    document.getElementById("itemdesc-email").style.display='none';
    document.getElementById("itemdesc-msn").style.display='none';
    document.getElementById("itemdesc-skype").style.display='none';
    document.getElementById("itemdesc-twitter").style.display='none';
    document.getElementById("itemdesc-facebook").style.display='none';
    document.getElementById("itemdesc-whatsapp").style.display='none';
    document.getElementById("itemdesc-googleplus").style.display='none';
    }
    else{
    document.getElementById("itemdesc-call").style.display='inline';
    document.getElementById("itemdesc-email").style.display='inline';
    document.getElementById("itemdesc-msn").style.display='inline';
    document.getElementById("itemdesc-skype").style.display='inline';
    document.getElementById("itemdesc-twitter").style.display='inline';
    document.getElementById("itemdesc-facebook").style.display='inline';
    document.getElementById("itemdesc-whatsapp").style.display='inline';
    document.getElementById("itemdesc-googleplus").style.display='inline';
    }
}
//----------------------------------------------------------------------------------------------------------
</script>
</head>
<body class="pushmenu-push">
<nav class="pushmenu pushmenu-left">
<input type='image' src="../../applications/Dplus_Mail/images/menu.png" id="nav_list1" border=0 WIDTH="50" HEIGHT="50" hspace="5" vspace="10"  align="left" /><br>
    <h3 style="text-align:center;" ><?=_WELCOME?> D+ Mail</h3><br>
    <a href="index.php"><input type='image' src="../../applications/Dplus_Mail/images/logo.png" onclick="javascript: location.href='index.php';" title="<?=_WELCOME?> in D+ Contacts" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> Home </a>
    <a href="index.php?action=search"><input type='image' src="../../applications/Dplus_Mail/images/search.png" onclick="javascript: location.href='index.php?action=search';" title="[<?=_FINDFILES?> File]" border=0 WIDTH="32" HEIGHT="32" /> <?=_FINDFILES?> </a>
    <a href="index.php?action=add_email"><input type='image' src="../../applications/Dplus_Mail/images/inbox.png" onclick="javascript: location.href='index.php?action=add_email';" title="[<?=_INBOX?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_INBOX?> </a>

    <a href="index.php?action=outbox"><input type='image' src="../../applications/Dplus_Mail/images/outbox.png" onclick="javascript: location.href='index.php?action=outbox';" title="[<?=_OUTBOX?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_OUTBOX?> </a>
    <a href="index.php?action=bozze"><input type='image' src="../../applications/Dplus_Mail/images/bozze.png" onclick="javascript: location.href='index.php?action=bozze';" title="[<?=_BOZZE?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_BOZZE?> </a>
    <a href="index.php?action=spam"><input type='image' src="../../applications/Dplus_Mail/images/spam.png" onclick="javascript: location.href='index.php?action=spam';" title="[<?=_SPAM?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_SPAM?> </a>
    <a href="index.php?action=cestino"><input type='image' src="../../applications/Dplus_Mail/images/cestino.png" onclick="javascript: location.href='index.php?action=cestino';" title="[<?=_CESTINO?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_CESTINO?> </a>

    <a href="index.php?action=nonletti"><input type='image' src="../../applications/Dplus_Mail/images/unread.png" onclick="javascript: location.href='index.php?action=nonletti';" title="[<?=_UNREAD?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_UNREAD?> </a>
    <a href="index.php?action=contrassegnati"><input type='image' src="../../applications/Dplus_Mail/images/flagged.png" onclick="javascript: location.href='index.php?action=contrassegnati';" title="[<?=_FLAGGED?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_FLAGGED?> </a>


<!--    <a href="index.php?action=delete_feed"><input type='image' src="../../applications/D_Plus_FeedReader/images/delete-feed.png" onclick="javascript: location.href='index.php?action=delete_feed';" title="[cancella-abbonamento]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> Delete Feed </a> -->
<!--    <a href="index.php?action=addmicrec"> <input type='image' src="../../applications/foto/images/mic-recorder.png" onclick="javascript: location.href='index.php?action=addmicrec';" title="[inserisci-mic recording]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> Mic-Recording </a> -->
    <a href="index.php?action=mod_setting"> <input type='image' src="../../applications/Dplus_Mail/images/setting.png" onclick="javascript: location.href='index.php?action=mod_setting';" title="[<?=_SETTING?>]" border=0 WIDTH="32" HEIGHT="32" hspace="3" vspace="0" /> <?=_SETTING?> </a>
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
<input type='image' src="../../applications/Dplus_Mail/images/menu.png" id="nav_list" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left" />
<input type='image' src="../../applications/Dplus_Mail/images/logo.png" onclick="javascript: location.href='index.php';" title="<?=_WELCOME?> in D+ Mail" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/>
<input type='image' src="../../applications/Dplus_Mail/images/oldsearch.png" onclick="javascript: location.href='index.php?action=search';" title="[<?=_FINDFILES?> File]" border=0 WIDTH="50" HEIGHT="50"  hspace="30" vspace="0"  align="left"/>

<!-- <input type='image' src="../../applications/D_Plus_FeedReader/images/camera-capture.png" onclick="javascript: location.href='index.php?action=camcapture';" title="[inserisci-immagine]" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/>
<input type='image' src="../../applications/D_Plus_FeedReader/images/camera-recorder.png" onclick="javascript: location.href='index.php?action=videocapture';" title="[inserisci-video]" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/>
<!-- <input type='image' src="../../applications/foto/images/mic-recorder.png" onclick="javascript: location.href='index.php?action=addmicrec';" title="[inserisci-mic recording]" border=0 WIDTH="50" HEIGHT="50" hspace="3" vspace="0"  align="left"/> -->
<?    if ($user_avatar=="")$user_avatar="avtr00.png";
		if (substr($user_avatar,0,4)=="http"){ ?>
			<input type='image' src="<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="50" HEIGHT="50" hspace="10" vspace="0" align="right" />
		<?php } else { ?>
			<input type='image' src="../../applications/contacts/libs/avatars/<?=$user_avatar;?>" onclick="javascript: location.href='../_reguser/index.php';" title="<?=_WELCOME?> <?=$utente;?>" border=0 WIDTH="50" HEIGHT="50" hspace="10" vspace="0" align="right" />
		<?php } ?>
</div>
<div id='barretta'  style='position:fixed;  z-index: 20; top: 60px; height:5px; width:100%; background-color: red;' ></div>
<?php

    if ($utente!=""){

// l'albero degli eventi
    switch($action){
	case "help":
	    //help($dpath);
	    break;
	case "outbox":
	    exec_outbox_email();
	    break;
	case "search":
	    search($dpath);
	    break;
	case "exec_search":
	    exec_search($dpath);
	    break;
	case "add_email":
	    add_email();
	    break;
	case "exec_add_email":
	    exec_add_email();
	    break;
	case "cestino":
	    vedi_cestino();
	    break;
	case "rename_contact":
	    //rename_file();
	    break;
	case "exec_rename_contact":
	    //exec_rename_file();
	    break;
	case "delete_contact":
	    delete_filecontact();
	    break;
	case "exec_delete_contact":
	    exec_delete_filecontact();
	    break;
	case "mod_contact":
	    mod_contact();
	    break;
	case "exec_mod_contact":
	    exec_mod_contact();
	    break;
	case "mod_setting":
	    mod_setting();
	    break;
	case "exec_add_setting":
	    exec_add_setting();
	    break;
	default:
		echo "<div id='barretta'  style='height:65px; width:100%; background-color: red;' ></div>";
//		echo "<div id='js_clock' align='right' style='font-weight:bold; font-size: 16px;' ><script type='text/javascript' language='javascript' src='js/Clock.js'></script></div>";

//$inbox = imap_open("{".$pop.":".$porta."/imap/ssl/novalidate-cert}INBOX", $username, $password);
//$imap = imap_open ("{localhost:995/pop3/ssl/novalidate-cert}", $username, $password);

// To connect to an IMAP server running on port 143 on the local machine,
// do the following:
//$mbox = imap_open("{localhost:143}INBOX", "user_id", "password");

// To connect to a POP3 server on port 110 on the local server, use:
//$mbox = imap_open ("{localhost:110/pop3}INBOX", "user_id", "password");

// To connect to an SSL IMAP or POP3 server, add /ssl after the protocol
// specification:
//$mbox = imap_open ("{localhost:993/imap/ssl}INBOX", "user_id", "password");

// To connect to an SSL IMAP or POP3 server with a self-signed certificate,
// add /ssl/novalidate-cert after the protocol specification:
//$mbox = imap_open ("{localhost:995/pop3/ssl/novalidate-cert}", "user_id", "password");

// To connect to an NNTP server on port 119 on the local server, use:
//$nntp = imap_open ("{localhost:119/nntp}comp.test", "", "");
// To connect to a remote server replace "localhost" with the name or the
// IP address of the server you want to connect to.

//$message_count = imap_num_msg($imap); 
//echo "Hai <b>$message_count messaggi nella tua mailbox"."<br><br>
 
//";


$pop = "imap.gmail.com";
$username = "nost.ass@gmail.com";
$password = "nefertiri";
$porta = 993;
 
$inbox = imap_open("{".$pop.":".$porta."/imap/ssl/novalidate-cert}INBOX", $username, $password);


$status = imap_status($inbox, "{".$pop.":".$porta."/imap/ssl/novalidate-cert}INBOX", SA_ALL);
if ($status) {
		echo "<div id='rssList'  style='width:100%;' >
		      <center>
		      <p><a style='font-weight:normal; font-size: 16px;' >"._INBOX." <font color='red' >".$status->unseen."</font> - Totale Messaggi:  <font color='red' >".$status->messages."</font></a></p>
		      </center>
		      <input type='image' src='./images/scrivi.png' style='position:relative; z-index: 10; top: -40px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />
<!--		      <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
		";

//  echo "Messages:   " . $status->messages    . "<br />\n";
//  echo "Recent:     " . $status->recent      . "<br />\n";
//  echo "Unseen:     " . $status->unseen      . "<br />\n";
//  echo "UIDnext:    " . $status->uidnext     . "<br />\n";
//  echo "UIDvalidity:" . $status->uidvalidity . "<br />\n";
} else {
  echo "imap_status failed: " . imap_last_error() . "\n";
}

			$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
			$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
			$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
			$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

$MC=imap_check($inbox); 
$MN=$MC->Nmsgs; 
$overview=imap_fetch_overview($inbox,"1:$MN",0); 
$size=sizeof($overview); 
for($i=$size-1;$i>=0;$i--){ 
$val=$overview[$i]; 
$msg=$val->msgno; 
$from=$val->from; 
$date=$val->date;
$date = date("j-n-Y G:i:s", strtotime($date));
$subj=$val->subject; 

$letto=$val->seen;
//echo "Letto: ".$letto;

//$eliminato=$val->deleted;
//echo "Eliminato: ".$eliminato;

$flagged=$val->flagged;
//echo "Flagged: ".$flagged;


//if ($letto) {$iniziobold =""; $finebold = "";} else { $iniziobold ="<b>"; $finebold = "</b>"; }

//$body = imap_fetchbody( $inbox, $msg, "1.2" );
//$headers=imap_header($inbox, $i);
//$data=date("j/n/Y G:i:s",strtotime($headers->date));

//$body = imap_body($inbox, $msg);
//echo "#$msg: From:'$from' Date:'$date' Subject:'$subj'<BR>"; 



			if ($iphone || $android || $palmpre || $ipod || $berry == true){
			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";
			} else {

if ($letto) { 

			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: white; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>";
					if ($flagged) { echo "<div style='position:relative; top: -60px; ' align='right'> <input type='image' src='./images/flagged.png' border=0 WIDTH='35' HEIGHT='35' /> </div>"; }
echo "
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";


 } else { 

			    	echo "  <div id='feed-$i' onclick='showRSS(\"$msg\",\"$from\",\"$date\",\"$subj\")' style='border: 1px solid #AAAAAA; border-radius: 3px 3px 3px 3px; padding-top:18px; padding-bottom:8px; padding-right:5px; padding-left:25px; background-color: #EEEEEE; color: #000000; font-size: 16px;'>
					<input type='image' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-frc1/t1.0-1/c178.0.604.604/s160x160/252231_1002029915278_1941483569_n.jpg' onclick='' title='$nomefile' border=0 WIDTH='50' HEIGHT='50' align='left' style='position:relative; z-index: 10; top: -15px; left: -15px; -moz-border-radius: 50px; -webkit-border-radius: 50px; border-radius: 50px;' />
					<div style='position:relative; top: -15px;' ><b>".substr($from, 0, 25). "</b></div>
					<div style='position:relative; top: -35px; ' align='right'><b>$date</b></div>
					<div style='position:relative; top: -35px; ' ></b>".substr($subj, 0, 25). "</div>";
					if ($flagged) { echo "<div style='position:relative; top: -60px; ' align='right'> <input type='image' src='./images/flagged.png' border=0 WIDTH='35' HEIGHT='35' /> </div>"; }
echo "
<!--					<div style='position:relative; top: -35px; left:50px;' >".substr($body, 0, 25). "---</div>
					<input type='image' src='./images/delete.png' style='position:relative; z-index: 10; top: -8px;' id='eliminafeed' onclick='javascript: location.href=\"index.php?action=delete_contact&filename=$nomefile\";' title='["._DELETE_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' />  <input type='image' style='position:relative; z-index: 10; top: -8px;' src='./images/rename.png' id='modificacontact' onclick='javascript: location.href=\"index.php?action=mod_contact&filename=$nomefile\";' title='["._MODIFY_CONTACT."]' border=0 WIDTH='35' HEIGHT='35' hspace='3' vspace='0'  align='right' /> -->
					</div>";


 }
			}
}
    imap_close($imap);
		echo "</div>";
	    echo "
		
		<div id='rssOutput'  style='top: 55px; left: 0px; width:100%;' ></div>
		</html>";
	    break;
    }
    }


//<span style='position:relative; top: -15px;' >".wordwrap($subj, 19, "<br>", true). "</span>




// Invio Email con allegati

/*
require_once('libs/PHPMailer/class.phpmailer.php');
require_once('libs/PHPMailer/class.pop3.php'); // required for POP before SMTP
 
$pop = new POP3();
$pop->Authorise('pop3.yourdomain.com', 110, 30, 'username', 'password', 1);
 
$mail = new PHPMailer();
$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->Host     = 'pop3.yourdomain.com';
 
$mail->SetFrom('name@yourdomain.com', 'First Last');
 
$mail->AddReplyTo("name@yourdomain.com","First Last");

$mail->Subject    = "PHPMailer Test Subject via POP before SMTP, basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "whoto@otherdomain.com";

$mail->AddAddress($address, "John Doe");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) { echo "Mailer Error: " . $mail->ErrorInfo; } else { echo "Message sent!"; }
*/
//------------------------------------------------------------------------------------------------------------------------------



// ricezione email da casella di posta pop3 con php semplice

/*
 
$pop = "pop3.tuodominio.com";
$username = "tua_user";
$password = "tua_password";
$porta = 110;
 
$imap = imap_open ("{".$pop.":".$porta."/pop3}INBOX", $username, $password);
$message_count = imap_num_msg($imap);
echo "Hai <b>$message_count messaggi nella tua mailbox"."
 
";
    for ($i = 1; $i < = $message_count; ++$i) {
        $header = imap_header($imap, $i);
        $body =imap_body($imap, $i);
        $prettydate = date("d/m/Y", $header->udate);
 
        if (isset($header->from[0]->personal)) {
            $personal = $header->from[0]->personal;
        } else {
            $personal = $header->from[0]->mailbox;
        }
 
        $email = "$personal < {$header->from[0]->mailbox}@{$header->from[0]->host}>";
		echo "Il $prettydate, $email ha scritto:"."";
		echo "$body" ."";
		echo "---------------------------------------------"."";
    }
 
    imap_close($imap);

*/


?>

