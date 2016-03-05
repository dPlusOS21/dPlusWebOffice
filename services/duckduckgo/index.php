<?php
$arg=urlencode($_GET['arg']);
$service="http://api.duckduckgo.com/?q=$arg&format=json";
$response=join(file($service));
header("Access-Control-Allow-Origin: *");
$out=print_r(json_decode($response,true),true);
$start=strpos($out,"[Abstract]",0)+13;
$end=strpos($out," [AbstractText]",$start);
$temp = substr($out,$start,$end- $start);
echo $temp;
?>
