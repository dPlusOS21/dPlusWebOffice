<?php #20070919 http://www.framework.altervista.org/FrameWork/applications/_reguser/_viewuser/upgrade.inc

upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/_viewuser/application.inc","$path/application.inc");
if (!file_exists("$path/lang"))mkdir("$path//lang");
upgrade_download("http://www.framework.altervista.org/FrameWork/applications/_reguser/_viewuser/lang/it.inc","$path/lang/it.inc");
?>
