<?php
$arg=urlencode($_GET['arg']);
//$service="https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&titles=$arg";
$service="https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=$arg";
$response=join(file($service));
header("Access-Control-Allow-Origin: *");
$out=print_r(json_decode($response,true),true);
$start=strpos($out,"[extract]",0)+12;
$end=strpos($out,"
                        )

                )
",$start);
$temp = substr($out,$start,$end- $start);
echo $temp;
?>
