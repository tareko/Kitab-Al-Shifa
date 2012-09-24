<?php
if (isset($updateNotNeeded)) {
	echo "EMA_Schedule-".$masterSet['calendar']['Calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf up to date. Update not needed";
	return;
}

App::import('Vendor','xtcpdf'); 

$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("Emergency Medicine London. https://emlondon.ca");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xheadertext = '';


// add a page (required witd recent versions of tcpdf)
$tcpdf->AddPage('L');

$tcpdf->setCellHeightRatio(1.5);

$output = $this->Calendar->makeCalendarPdf($masterSet);
$output .= '<br/><br/><br/><div style="font-size:60%"><p>Notes:<br/>' . $masterSet['calendar']['Calendar']['comments'];
$output .= '<p>PDF created: '. date('Y-m-d').'</p>
<p>Schedule last updated: '.$masterSet['calendar']['lastupdated'].'</p></div>';

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
$tcpdf->write2DBarcode($this->Html->url("/app/webroot/pdf/EMA_Schedule-".$masterSet['calendar']['Calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf", true), 'QRCODE,H', 251, 5, 35, 35, $style, 'N');

if ($tcpdf->Output(WWW_ROOT ."pdf/EMA_Schedule-".$masterSet['calendar']['Calendar']['id']."-".$masterSet['calendar']['Calendar']['start_date'].".pdf", 'F')) {
echo "success";
}

?> 
