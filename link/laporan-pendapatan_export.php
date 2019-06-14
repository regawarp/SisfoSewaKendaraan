<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../PHPExcel-1.8.2/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("PT. Dutar Barokah")
    ->setLastModifiedBy("PT. Dutar Barokah")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// HEADER
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'LAPORAN PENDAPATAN')
    ->setCellValue('A2', 'PT DUTAR BAROKAH GRUP')
    ->setCellValue('A5', 'Tanggal')
    ->setCellValue('B5', 'Nomor Tanda Terima')
    ->setCellValue('C5', 'Order No.')
    ->setCellValue('D5', 'Nama Klien')
    ->setCellValue('E5', 'Jumlah IDR');

// DATA
include('koneksi.php');
$tanggal_awal = $_GET['tanggal_awal'];
$tanggal_akhir = $_GET['tanggal_akhir'];
$query = "SELECT tanggal,no_tanda_terima,penyewa,uang_sejumlah FROM tanda_terima,transaksi WHERE tanda_terima.no_surat_jalan=transaksi.no_surat_jalan AND ((tanggal  BETWEEN '$tanggal_awal' AND '$tanggal_akhir') OR tanggal='$tanggal_awal' OR tanggal='$tanggal_akhir') ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);
$total = 0;
$countRow = 6;
while ($row = mysqli_fetch_assoc($result)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countRow, DateTime::createFromFormat("Y-m-d", $row['tanggal'])->format("d/m/Y"))
        ->setCellValue('B' . $countRow, $row['no_tanda_terima'])
        ->setCellValue('C' . $countRow, $countRow - 5)
        ->setCellValue('D' . $countRow, $row['penyewa'])
        ->setCellValue('E' . $countRow, $row['uang_sejumlah']);
    $total += $row['uang_sejumlah'];
    $countRow++;
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', DateTime::createFromFormat("Y-m-d", $tanggal_awal)->format("l, j F Y") . ' - ' . DateTime::createFromFormat("Y-m-d", $tanggal_akhir)->format("l, j F Y"));
mysqli_close($conn);

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('D' . $countRow, 'Total')
    ->setCellValue('E' . $countRow, $total);

// STYLING
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman')
    ->setSize(12);
// BORDER STYLING
$outlineborder = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$allborders = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$centeredText = array(
    'alignment' => array( // CENTERED TEXT
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:E' . $countRow)->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5:E' . $countRow)->applyFromArray($allborders);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A2')->getFont()
    ->setBold(true)
    ->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5:E5')->getFont()
    ->setBold(true);

// Calculate the column widths
foreach (range('A5', 'E' . ($countRow - 1)) as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->calculateColumnWidths();

// Set setAutoSize(false) so that the widths are not recalculated
foreach (range('A5', 'E' . ($countRow - 1)) as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
}

// MERGE
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:E1')
    ->mergeCells('A2:E2')
    ->mergeCells('A3:E3');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan Pendapatan');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LaporanPendapatan' . $tanggal_awal . '-' . $tanggal_akhir . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
