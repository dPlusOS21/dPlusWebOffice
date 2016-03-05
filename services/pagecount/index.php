<?php
// API gestione contatori pagine web e download






function xmd5($key){
	return md5(strrev(md5($key)));
	}
//-------------------------------------------------------------------------------
function filewrite($fname,$value){
	$fp=fopen($fname,"w");
	fwrite($fp,$value);
	fclose($fp);
}

//-------------------------------------------------------------------------------


$op=@$_GET['op'];
$scope=xmd5(@$_GET['scope']);

//va usato con chiamata ajax
if ($op=='add'){
	header('Access-Control-Allow-Origin: *');
	$count= (int) @join(@file($scope));
	$count++;
	filewrite($scope,(string)$count);
	echo "ok $count";

}

if ($op=='read'){
	header('Access-Control-Allow-Origin: *');
	$count= @join(@file($scope));
	echo $count;
}


?>
