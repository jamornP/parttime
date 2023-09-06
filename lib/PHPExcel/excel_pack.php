<?php
include("{$_SERVER['DOCUMENT_ROOT']}/science/lib/PHPExcel/Classes/PHPExcel.php");

$column_excel_arr = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ'];

////  สร้างตัวแปร Style ของการใส่กรอบ ใส่สี ฯลฯ
$excel_bc_red_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFffccff',],]];
$excel_bc_red_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFff99ff',],]];

$excel_bc_yellow_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFffff99',],]];
$excel_bc_yellow_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFffcc33',],]];

$excel_bc_orange_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFff9900',],]];
$excel_bc_orange_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFffcc66',],]];

$excel_bc_green_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FF99ff99',],]];
$excel_bc_green_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FF33cc33',],]];

$excel_bc_blue_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFccffff',],]];
$excel_bc_blue_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FF0099ff',],]];

$excel_bc_pink_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFffd9fc',],]];
$excel_bc_pink_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFfd2bd2',],]];

$excel_bc_violet_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FF9900ff',],]];
$excel_bc_violet_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFccccff',],]];

$excel_bc_grey = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFcccccc',],]];

$excel_bc_grey_l = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFf0f0f0',],]];
$excel_bc_grey_d = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => ['argb' => 'FFe1e1e1',],]];


$excel_font_bold = [ 	'font' => ['bold' => true] ];

$excel_border_black = [	'borders' => [ 'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN,	'color' => ['argb' => 'FF000000'],	],	],];

//============== Generate Region Excel ==============
$gExcel = new PHPExcel();

// กำหนด Property ของไฟล์ Excel
$gExcel->getProperties()->setCreator("ADMIN")
		->setLastModifiedBy("ADMIN")
		->setTitle("export_excel")
		->setSubject("export_excel")
		->setDescription('');

// Setting the default style of a workbook
$gExcel->getDefaultStyle()->getFont()->setName('Arial');
$gExcel->getDefaultStyle()->getFont()->setSize(10); 

$sheet = $gExcel->getActiveSheet();
?>