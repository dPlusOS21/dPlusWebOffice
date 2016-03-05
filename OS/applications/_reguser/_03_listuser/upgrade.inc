<?php #20071003 http://www.framework.altervista.org/FrameWork/applications/_reguser/03_listuser/upgrade.inc

upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/03_listuser/application.inc","$path/application.inc");
if (!file_exists("$path/lang"))mkdir("$path//lang");
upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/03_listuser/lang/it.inc","$path/lang/it.inc");
?>
