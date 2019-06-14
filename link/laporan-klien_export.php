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
    ->setCellValue('A1', 'LAPORAN DATA KLIEN')
    ->setCellValue('A2', 'PT DUTAR BAROKAH GRUP')
    ->setCellValue('A5', 'Penyewa')
    ->setCellValue('B5', 'Keterangan')
    ->setCellValue('C5', 'Telepon')
    ->setCellValue('D5', 'No. Surat Jalan')
    ->setCellValue('E5', 'Nomor Polisi')
    ->setCellValue('F5', 'Driver')
    ->setCellValue('G5', 'No. Golongan SIM')
    ->setCellValue('H5', 'Penjemputan')
    ->setCellValue('I5', 'Tujuan')
    ->setCellValue('J5', 'Tanggal Keberangkatan')
    ->setCellValue('K5', 'Tanggal Kedatangan');

// DATA
include('koneksi.php');
$tanggal_awal = $_GET['tanggal_awal'];
$tanggal_akhir = $_GET['tanggal_akhir'];
$query = "SELECT * FROM transaksi WHERE ((tgl_dibuat_surat_jln  BETWEEN '$tanggal_awal' AND '$tanggal_akhir') OR tgl_dibuat_surat_jln='$tanggal_awal' OR tgl_dibuat_surat_jln='$tanggal_akhir') ORDER BY tgl_dibuat_surat_jln ASC";
$result = mysqli_query($conn, $query);
$countLunas = 0;
$countBlmLunas = 0;
$countAll = 0;
$countRow = 6;
while ($row = mysqli_fetch_assoc($result)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countRow, $row['penyewa'])
        ->setCellValue('B' . $countRow, $row['keterangan'])
        ->setCellValue('C' . $countRow, $row['telepon'])
        ->setCellValue('D' . $countRow, $row['no_surat_jalan'])
        ->setCellValue('E' . $countRow, $row['nomor_polisi'])
        ->setCellValue('F' . $countRow, $row['driver'])
        ->setCellValue('G' . $countRow, $row['no_golongan_sim'])
        ->setCellValue('H' . $countRow, $row['penjemputan'])
        ->setCellValue('I' . $countRow, $row['tujuan'])
        ->setCellValue('J' . $countRow, DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("d/m/Y"))
        ->setCellValue('K' . $countRow, DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("d/m/Y"));
    if ($row['keterangan'] == "Lunas") {
        $countLunas++;
    } else {
        $countBlmLunas++;
    }
    $countAll++;
    $countRow++;
}
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', DateTime::createFromFormat("Y-m-d", $tanggal_awal)->format("l, j F Y") . ' - ' . DateTime::createFromFormat("Y-m-d", $tanggal_akhir)->format("l, j F Y"));
mysqli_close($conn);

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A' . ($countRow + 1), 'Keterangan')
    ->setCellValue('A' . ($countRow + 2), 'Lunas')
    ->setCellValue('A' . ($countRow + 3), 'Belum Lunas')
    ->setCellValue('A' . ($countRow + 4), 'Total')
    ->setCellValue('B' . ($countRow + 1), 'Jumlah')
    ->setCellValue('B' . ($countRow + 2), $countLunas)
    ->setCellValue('B' . ($countRow + 3), $countBlmLunas)
    ->setCellValue('B' . ($countRow + 4), $countAll);

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

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:K' . $countRow)->applyFromArray($centeredText);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5:K' . ($countRow - 1))->applyFromArray($allborders);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($countRow + 1) . ':B' . ($countRow + 4))->applyFromArray($allborders);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A2')->getFont()
    ->setBold(true)
    ->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5:K5')->getFont()
    ->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A6:K' . ($countRow - 1))->getFont()
    ->setSize(11);

// Calculate the column widths
foreach (range('B6', 'K' . ($countRow - 1)) as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->calculateColumnWidths();

// Set setAutoSize(false) so that the widths are not recalculated
foreach (range('B6', 'K' . ($countRow - 1)) as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
}

// MERGE
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:K1')
    ->mergeCells('A2:K2')
    ->mergeCells('A3:K3');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan Klien');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LaporanKlien' . $tanggal_awal . '-' . $tanggal_akhir . '.xlsx"');
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
