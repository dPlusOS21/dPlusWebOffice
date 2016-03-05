<?php #20070906 http://www.framework.altervista.org/FrameWork/libs/al_10_libPrint.inc
define('LIBPRINT','1.00');

/************************************************************************/
/* FrameWork  test preview                                              */
/* ==================================================================== */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// libprint
$print_op=$_GET['print_op'];
if( $print_op!=""){

/* structure.inc */

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function structure_openBlock($class,$title,$icon){
    if ($class=="")$class="table block";
    if ($icon=="")$icon="themes/".theme()."/images/block.png";

    echo "<div class='$class'>\n";
    createTitle($title,$title,$icon);
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function structure_closeBlock(){
    echo "</div>\n";

}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------




function print_printapp(){
    $appname=$_GET['appname'];
    $apptitle=apptitle($appname);
    $path="applications";

    echo "<html>\n";
    echo "<body><div>\n";
    if (is_dir("applications/$appname"))
	include "applications/$appname/application.inc";
    else
	include "applications/$appname";
    echo "</div></body>\n";
    echo "</html>\n";
    die();
}

function print_printappdf(){

    define('FPDF_FONTPATH','libs/fpdf/font/');
    require('libs/fpdf/fpdf.php');
    $pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->SetFillColor(220,210,100);
    $pdf->SetDrawColor(110,30,0);
    $pdf->SetLineWidth(0.5);

    $pdf->Cell(60,40,'Il MiO PrImO pDf!', 'LT',2, 'R', 1);
    $pdf->Output('miofile.pdf', I);
    // $pdf->Output();

    $appname=$_GET['appname'];
    $apptitle=apptitle($appname);
    $path="applications";

    echo "<html>\n";
    echo "<body><div>\n";
    if (is_dir("applications/$appname"))
	include "applications/$appname/application.inc";
    else
	include "applications/$appname";
    echo "</div></body>\n";
    echo "</html>\n";
    die();
}


    switch ($print_op){
	case "printapp":
	    print_printapp();
	    break;
	case "printappdf":
	    print_printappdf();
	    break;

    }
}
