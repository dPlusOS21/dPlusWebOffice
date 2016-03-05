<?php

/* sintassi 
 * 

	save minimo/services/storage/?op=save&scope=scope&usermail=usermail&session=session&storage=storage
	url minimo/services/storage/?op=url&scope=scope&usermail=usermail&session=session&storage=storage&filename=filename
	rm minimo/services/storage/?op=rm&scope=scope&usermail=usermail&session=session&storage=storage&filename=filename
 
*/ 
function xmd5($key){
	return md5(strrev(md5($key)));
	}


$service="http://verticaldev.altervista.org/services/auth/index.php";

$scope=$_GET['scope'];
$usermail=$_GET['usermail'];
$session=$_GET['session'];

$response=join(file($service."?op=verify&scope=".$scope."&usermail=".$usermail."&session=".$session));
$dest=@$_GET['dest'];

//debug
echo "scope:$scope<br>";
echo "usermail:$usermail<br>";
echo "session:$session<br>";
echo "response:$response<br>";
echo "dest:$dest<br>";



if($response!="\n"){
	$basepath=substr( $_SERVER['PHP_SELF'], 0, strpos( $_SERVER['PHP_SELF'], "index.php" ));
	$storage=@$_GET['storage'];
	$storagedir=xmd5($storage);
	if(file_exists($storagedir)==false)mkdir($storagedir,0775);

	$op=@$_GET['op'];

	if ($op=='save'){
		echo "
		<form action='$basepath/index.php?op=upload&storage=$storage&scope=$scope&usermail=$usermail&session=$session&dest=$dest' method='post' enctype='multipart/form-data'>
		<input name='file' type='file' size='30%'>
		<input type='submit' >
		</form>
		
		";
	}

	if ($op=='upload'){
		if (move_uploaded_file($_FILES['file']['tmp_name'], $storagedir ."/". $_FILES['file']['name'])) {
			chmod( $storagedir ."/". $_FILES['file']['name'],0775);
			rename($storagedir ."/". $_FILES['file']['name'],$storagedir ."/". xmd5($_FILES['file']['name']));
		}
		echo"<p align='right'>ok! <a href=\"$dest\">back</a></p>";

	}

	if ($op=='url'){
		$filename=xmd5($_GET['filename']);
		if(file_exists($storagedir."/".$filename)){
			echo "http://".$_SERVER['HTTP_HOST'].$basepath.$storagedir."/".$filename;
		}	
	}
}
else{
	echo "$verifiy<br>";
	echo "<a href='$dest'>continue</a>";
}
?>
