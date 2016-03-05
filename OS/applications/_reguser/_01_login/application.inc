<?php
define('APPLOGIN','1.00');
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
      <h3><?=_LOGIN;?></h3><hr />
      <?php $user=user_getuser(); if ($user==""){ ?>
        <form name="login" action="index.php?user_op=login" method="post" enctype="multipart/form-data">
        <?=_USER;?><br />
        <input name='user' type="text" value="" /> <br />
        <?=_PASSWORD;?><br />
        <input name='password' type="password" value="" />
        <hr />
        <input type="submit" value="login">
        </form>
      <?php }else{ ?>
        <?php if ($user_avatar=user_getkey($user,"user_avatar")) { ?>
	<center>
	    <?php if ($user_avatar!="") {
		if (substr($user_avatar,0,5)=="http:"){ ?>
		    <img src="<?=$user_avatar?>" />
		<?php } else { ?>
		    <img src="libs/avatars/<?=$user_avatar?>" />
		<?php } ?>
	    <?php } ?>
	</center>
	<?php } ?>
	<center><b><?=_WELCOME;?></b> <a href="index.php?appname=_reguser&subapp=02_reguser"><?=$user;?></a></center>
	<hr/>
        <form action="index.php?user_op=logout"  method="post" enctype="multipart/form-data">
        <center><input type="submit" value="logout"></center>
        </form>
      <?php }?>
