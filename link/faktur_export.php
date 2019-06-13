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
    ->setCellValue('H1', 'FAKTUR')
    ->setCellValue('A6', 'Nomor Faktur')
    ->setCellValue('A7', 'Tanggal')
    ->setCellValue('A8', 'Nomor Surat Jalan')
    ->setCellValue('A9', 'Merek/Type')
    ->setCellValue('A10', 'No. Pol')
    ->setCellValue('A11', 'Driver')
    ->setCellValue('E6', 'Penyewa')
    ->setCellValue('E7', 'Alamat')
    ->setCellValue('E9', 'Tujuan')
    ->setCellValue('E11', 'Telepon')
    ->setCellValue('A14', 'Deskripsi')
    ->setCellValue('G14', 'Harga/hr')
    ->setCellValue('H14', 'Total biaya')
    ->setCellValue('B17', 'Hari')
    ->setCellValue('D17', 'sampai')
    ->setCellValue('A25', 'Terbilang')
    ->setCellValue('A29', 'Harga belum termasuk:')
    ->setCellValue('D29', 'Diterima Oleh,')
    ->setCellValue('G29', 'PT.Dutar Barokah Grup')
    ->setCellValue('G35', 'Taufik Hamzah')
    ->setCellValue('G36', 'Manager Transportasi');




// DATA
include('koneksi.php');
$no_faktur = $_GET['no_faktur'];
$query = "SELECT * FROM transaksi,kendaraan,faktur WHERE transaksi.nomor_polisi=kendaraan.nomor_polisi AND transaksi.no_surat_jalan=faktur.no_surat_jalan AND no_faktur='$no_faktur'";
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
setlocale(LC_ALL, 'IND');
$totalBiaya = $row['harga_sewa'] * $jmlHari;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C6', $row['no_faktur'])
    ->setCellValue('C7', DateTime::createFromFormat("Y-m-d", $row['tanggal_faktur'])->format("d F Y"))
    ->setCellValue('C8', $row['no_surat_jalan'])
    ->setCellValue('C9', $row['merk_type'])
    ->setCellValue('C10', $row['nomor_polisi'])
    ->setCellValue('C11', $row['driver'])
    ->setCellValue('F6', $row['penyewa'])
    ->setCellValue('F9', $row['tujuan'])
    ->setCellValue('F11', $row['telepon'])
    ->setCellValue('C17', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("d F Y"))
    ->setCellValue('E17', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("d F Y"))
    ->setCellValue('A17', $jmlHari)
    ->setCellValue('G17', $row['harga_sewa'])
    ->setCellValue('H17', $totalBiaya)
    ->setCellValue('B25', terbilang($totalBiaya))
    ->setCellValue('H25', $totalBiaya)
    ->setCellValue('D35', $row['penyewa']);
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
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H1:I2')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5:D12')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E5:I12')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A14:F15')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G14:G15')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H14:I15')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A16:F23')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G16:G23')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H16:I23')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A25:I26')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A28:C37')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D28:F37')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G28:I37')->applyFromArray($outlineborder);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('H1:I2')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A14:I15')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A17:I17')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A25:I26')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D28:I37')->applyFromArray($centeredText);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(13);
// for ($i = 1; $i <= 24; $i++) {
//     $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);
// }

// MERGE
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('H1:I2')
    ->mergeCells('A25:A26')
    ->mergeCells('B25:G26')
    ->mergeCells('H25:I26')
    ->mergeCells('A29:B29')
    ->mergeCells('D29:F29')
    ->mergeCells('D35:F35')
    ->mergeCells('G29:I29')
    ->mergeCells('G35:I35')
    ->mergeCells('G36:I36')
    ->mergeCells('H17:I17');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Faktur');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Faktur' . $no_faktur . '.xlsx"');
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

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
