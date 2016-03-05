<?php
define('APPVIEWUSER','1.00');
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

	<h3><?=_VIEWUSER;?></h3><hr />
	<?php
	    $user=$_GET['user'];
	    if (file_exists("datas/sb/".sb_get()."/users/$user")&& $user!="")
		include "datas/sb/".sb_get()."/users/$user";
	?>
        <b><?=_USER;?></b> <?=$user;?><br />
        <hr />
	<b><?=_DATA_REG;?></b> <?=$user_firstdaylogin?><br />
	<b><?=_LAST_ACCES;?></b> <?=$user_lastdaylogin?><br />
        <hr />
	<b><?=_NOME;?></b> <?=$user_nome?><br />
	<b><?=_EMAIL;?></b> <?=$user_email?><br />
	<b><?=_SITO_WEB;?></b> <?=$user_web?><br />
	<b><?=_PROFESSIONE;?></b> <?=$user_professione?><br />
	<b><?=_PROVENIENZA;?></b> <?=$user_provenienza?><br />
	<b><?=_AVATAR;?></b> <br />
	    <?php if ($user_avatar!="") {
		if (substr($user_avatar,0,5)=="http:"){?>
		    <img src="<?=$user_avatar?>" />
		<?php } else { ?>
		    <img src="libs/avatars/<?=$user_avatar?>" />
		<?php } ?>
	    <?php } ?>
		<br />
	<b><?=_FIRMA;?></b> <?=$user_firma?><br />
	<hr />
	<b><?=_GRUPPI;?></b><br />

	<?=@implode("<br/>",group_usergroups($user));?><br />
        <hr />
