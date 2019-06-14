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
    ->setCellValue('A1', 'PT.DUTAR BAROKAH GRUP')
    ->setCellValue('A2', 'Jl. Pesantren / Aruman No 2')
    ->setCellValue('A3', 'Kel.Cibabat, Kec.Cimahi Utara, Kota Cimahi')
    ->setCellValue('A4', 'Phone: 022-20660615 Fax:022-20660614')
    ->setCellValue('H1', 'TANDA TERIMA')
    ->setCellValue('F3', 'Nomor Tanda Terima')
    ->setCellValue('F4', 'Tanggal')
    ->setCellValue('F5', 'Nomor Polisi')
    ->setCellValue('F6', 'Merek/Type')
    ->setCellValue('A8', 'Telah terima dari')
    ->setCellValue('A10', 'Terbilang')
    ->setCellValue('D8', ':')
    ->setCellValue('D10', ':')
    ->setCellValue('A12', 'Uang Sejumlah')
    ->setCellValue('A13', 'Untuk Pembayaran')
    ->setCellValue('A14', 'Sisa Pembayaran')
    ->setCellValue('D12', ':')
    ->setCellValue('D13', ':')
    ->setCellValue('D14', ':')
    ->setCellValue('A15', 'Jumlah')
    ->setCellValue('A16', 'Hari')
    ->setCellValue('C15', 'Tanggal')
    ->setCellValue('C16', 'Keberangkatan')
    ->setCellValue('E15', 'Tanggal')
    ->setCellValue('E16', 'Kepulangan')
    ->setCellValue('G15', 'Harga')
    ->setCellValue('G16', 'Per Hari')
    ->setCellValue('H15', 'Jumlah')
    ->setCellValue('D18', 's/d')
    ->setCellValue('G22', 'Total')
    ->setCellValue('A24', 'Biaya belum termasuk')
    ->setCellValue('A28', 'PERHATIAN :')
    ->setCellValue('C28', '1. Pembayaran dengan transfer dapat melalui Bank Mandiri')
    ->setCellValue('C29', 'Atas nama Taufik Hamzah 132-00-1740550-8')
    ->setCellValue('C30', '2. Pelunasan maksimal 1 hari sebelum keberangkatan')
    ->setCellValue('C31', '3. Apabila terjadi pembatalan oleh konsumen maka')
    ->setCellValue('C32', '   uang muka tidak dapat diambil kembali')
    ->setCellValue('H31', 'Taufik Hamzah')
    ->setCellValue('H32', 'Manager Transportasi');




// DATA
include('koneksi.php');
$no_tanda_terima = $_GET['no_tanda_terima'];
$query = "SELECT * FROM transaksi,kendaraan,faktur,tanda_terima WHERE transaksi.nomor_polisi=kendaraan.nomor_polisi AND transaksi.no_surat_jalan=faktur.no_surat_jalan AND transaksi.no_surat_jalan=tanda_terima.no_surat_jalan AND no_tanda_terima='$no_tanda_terima'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
$jmlHari;
if ($row['tgl_keberangkatan'] == $row['tgl_kedatangan']) {
    $jmlHari = 1;
} else {
    $keberangkatan = strtotime($row['tgl_keberangkatan']);
    $kedatangan = strtotime($row['tgl_kedatangan']);
    $datediff = $kedatangan - $keberangkatan;
    $jmlHari = round($datediff / (60 * 60 * 24));
}
$totalBiaya = $row['harga_sewa'] * $jmlHari;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('H3', $row['no_tanda_terima'])
    ->setCellValue('H4', DateTime::createFromFormat("Y-m-d", $row['tanggal'])->format("d F Y"))
    ->setCellValue('H5', $row['nomor_polisi'])
    ->setCellValue('H6', $row['merk_type'])
    ->setCellValue('E8', $row['penyewa'])
    ->setCellValue('E10', $row['terbilang'])
    ->setCellValue('E12', 'Rp ' . $row['uang_sejumlah'])
    ->setCellValue('E13', $row['untuk_pembayaran'])
    ->setCellValue('E14', 'Rp ' . $row['sisa_pembayaran'])
    ->setCellValue('A18', $jmlHari)
    ->setCellValue('C18', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("d F Y"))
    ->setCellValue('E18', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("d F Y"))
    ->setCellValue('G18', 'Rp ' . $row['harga_sewa'])
    ->setCellValue('H18', 'Rp ' . $totalBiaya)
    ->setCellValue('H22', 'Rp ' . $totalBiaya);
mysqli_close($conn);

// STYLING
$objPHPExcel->getDefaultStyle()->getFont()->setName('Dotum')
    ->setSize(10);
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
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H1')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A15:I16')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A17:I22')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A23:I33')->applyFromArray($outlineborder);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('H1')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E8:E14')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A15:H22')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H31:I32')->applyFromArray($centeredText);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('H31')->getFont()->setUnderline(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(21);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(22);
for ($i = 2; $i <= 32; $i++) {
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);
}

// MERGE
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('H3:I3')
    ->mergeCells('H15:I16')
    ->mergeCells('H31:I31')
    ->mergeCells('H32:I32');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tanda Terima');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TandaTerima' . $no_tanda_terima . '.xlsx"');
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
