<?php
define('APPREMEMBERPASSW','1.00');
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
      <h3><?=_FORWARD_PASSWORD;?></h3><hr />
      <?php $user=user_getuser(); if ($user==""){ ?>
        <form name="login" action="index.php?user_op=rememberpassw" method="post" enctype="multipart/form-data">
        <?=_USER;?><br />
        <input name='user' type="text" value="" /> <br />
        <hr />
        <input type="submit" value="<?=_FORWARD_ME_PASSWORD;?>">
        </form>
      <?php } ?>

