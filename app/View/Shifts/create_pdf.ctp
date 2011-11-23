<?php

App::import('Vendor','xtcpdf'); 

$base_url = "http://tarek.org/cakephp";

$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xheadertext = '';


// add a page (required witd recent versions of tcpdf)
$tcpdf->AddPage('L');

$tcpdf->setCellHeightRatio(1.5);

/*$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',10);
$tcpdf->Cell(0,30,"" , 0,1,'L');
*/

$output = $this->Calendar->makeCalendarPdf($masterSet);
$tcpdf->writeHTML($output, true, false, true, false, '');
$tcpdf->setFontSubsetting(false);

// set style for barcode
$style = array(
    'border' => 0,
    'padding' => 0,
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
$url = $base_url . "/app/webroot/pdf/EMA_Schedule-".$masterSet['calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf";
$tcpdf->write2DBarcode($url, 'QRCODE,H', 251, 5, 35, 35, $style, 'N');

if ($tcpdf->Output("/home/web/tarek/cakephp/app/webroot/pdf/EMA_Schedule-".$masterSet['calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf", 'F')) {
echo "success";
}
?> 
