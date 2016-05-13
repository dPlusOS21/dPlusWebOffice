<?php
define('LIBARCHIVEDIR','1.00');
/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//libARCHIVEDIR
//-------------------------------------------------------------------------------------------------------------------------
include "archive.php";
include "DeepDir.php";

//-------------------------------------------------------------------------------------------------------------------------

// zipdir comprime nell'archivio $dest il contenuto di $path e le eventuali sottocartelle
function zipdir($dest,$path){
//echo "D: ".$dest."<br>";
//echo "P: ".$path."<br>";
    $zip=new zip_file($dest); //qui creiamo lo zip file vuoto
    $zip->set_options(array('inmemory'=>"0",'overwrite'=>1,'storepaths','prepend','level','type'=>"zip"));
    $dir = new DeepDir();
    $dir->setDir($path);
    $dir->load();

    foreach($dir->files as $nf){
	$zip->add_files($nf);
    }
    $zip->create_archive();
}
//-------------------------------------------------------------------------------------------------------------------------

?>
