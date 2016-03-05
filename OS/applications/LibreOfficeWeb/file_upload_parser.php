<?php
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

//crea la thumbnails di una foto
include "libs/SmartImage096/SmartImage.class.php";
//-------------------------------------------------------------------------------------------------------


$dpath = $_GET['dpath'];
$utente=$_COOKIE["utente"];
$cartella=$_COOKIE["cartella"];
$user_avatar=$_COOKIE['user_avatar'];

//for ($i = 0; $i < count($_FILES['file1']['name']); $i++) {
	$fileName = $_FILES["file1"]["name"]; // The file name da aggiungere [$i]
	$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder da aggiungere [$i]
	$fileType = $_FILES["file1"]["type"][$i]; // The type of file it is da aggiungere [$i]
	$fileSize = $_FILES["file1"]["size"][$i]; // File size in bytes da aggiungere [$i]
	$fileErrorMsg = $_FILES["file1"]["error"][$i]; // 0 for false... and 1 for true da aggiungere [$i]
	if (!$fileTmpLoc) { // if file not chosen
	    echo "ERROR: Please browse for a file before clicking the upload button.";
	    exit();
	}
	if(move_uploaded_file($fileTmpLoc, "$dpath/".strtolower($fileName)."")){
	    chmod($dpath . $_FILES['file1']['name'][$i],0775); // file name da aggiungere [$i]
	
	    $img = new SmartImage("$dpath/".strtolower($fileName)."");
	    $img->resize(100, 100, true);
	    $img->saveImage( "../../users/$utente/$cartella/thumbnair/".strtolower($fileName)."" );
	//    mkthumbs("$dpath/".strtolower($fileName)."", "../../users/$utente/$cartella/thumbnair/".strtolower($fileName)."");
	
	    echo "$fileName <br><br>upload is complete";
	} else {
	    echo "move_uploaded_file function failed";
	}
//}
?>
