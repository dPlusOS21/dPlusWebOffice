<?php
define('APPLISTUSER','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//carica la lingua se esiste
$lang=lang();
if (file_exists("applications/$appname/lang/$lang.inc"))
    include "applications/$appname/lang/$lang.inc";
else
    include "applications/$appname/lang/it.inc";
?>
      <h3><?=_LISTUSER;?></h3><hr />

      <?php
	$listuser=user_listusers();
	sort($listuser);
	if (count($listuser)){
	    echo "<table class='class_table'>\n";
	    echo "<tr class='firstrow'>\n";
	    echo "<td><a href='index.php?appname=$appname'> "._USER." </a></td>";
	    echo "<td><a href='index.php?appname=$appname&order=datareg'> "._DATA_REG." </a></td>";
	    echo "<td><a href='index.php?appname=$appname&order=lastlog'> "._LAST_ACCES." </a></td>";
	    echo "<td><b> "._OPERATION." </b></td>";
	    echo "</tr>\n";

	    foreach($listuser as $user){
		$firstdaylogin[$user]=user_getkey($user,"user_firstdaylogin");

		$lastdaylogin[$user]=user_getkey($user,"user_lastdaylogin");
	    }

	    switch($_GET['order']){
		case "datareg":
		    array_multisort($firstdaylogin,SORT_STRING,$lastdaylogin,$listuser);
		break;
		case "lastlog":
		    array_multisort($lastdaylogin,SORT_STRING,$firstdaylogin,$listuser);
		break;
		default:
		    array_multisort($listuser,SORT_STRING,$firstdaylogin,$lastdaylogin);
		break;
	    }


	    foreach($listuser as $user){
		echo "<tr>\n";
		echo "<td> $user </td>";
		echo "<td> ".$firstdaylogin[$user]."</td>";
		echo "<td> ".$lastdaylogin[$user]."</td>";
		echo "<td> ";
		if (user_getuser()||admin_isadmin()){
		    echo" <a href='index.php?appname=_reguser&subapp=_viewuser&user=$user'>"._VIEW."</a> ";
		}
		if (admin_isadmin()){
		    echo" <a href='index.php?appname=_reguser&user_op=killuser&killuser=$user'>"._KILL."</a> ";
		}
		echo " <td>\n";
		echo "</tr>\n";
	    }
	    echo "</table>\n";
	}
      ?>

