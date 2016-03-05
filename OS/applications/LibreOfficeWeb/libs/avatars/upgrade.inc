<?php #20070416 http://www.framework.altervista.org/FrameWork/libs/avatars/upgrade.inc

upgrade_download("http://www.framework.altervista.org/FrameWork/libs/avatars/blank.png","$path/blank.png");
upgrade_download("http://www.framework.altervista.org/FrameWork/libs/avatars/fn.png","$path/fn.png");

for($i=0;$i<31;$i++){
    $n=substr("00".$i,-2);
    upgrade_download("http://www.framework.altervista.org/FrameWork/libs/avatars/avtr$n.png","$path/avtr$n.png");
}
?>
