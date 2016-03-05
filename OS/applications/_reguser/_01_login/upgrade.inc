<?php #20070423 http://www.framework.altervista.org/FrameWork/applications/_reguser/01_login/upgrade.inc

upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/01_login/application.inc","$path/application.inc");
if (!file_exists("$path/lang"))mkdir("$path//lang");
upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/01_login/lang/it.inc","$path/lang/it.inc");
?>
