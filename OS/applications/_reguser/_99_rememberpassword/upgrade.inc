<?php #20070518 http://www.framework.altervista.org/FrameWork/applications/_reguser/99_rememberpassword/upgrade.inc

upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/99_rememberpassword/application.inc","$path/application.inc");
if (!file_exists("$path/lang"))mkdir("$path//lang");
upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/99_rememberpassword/lang/it.inc","$path/lang/it.inc");
?>
