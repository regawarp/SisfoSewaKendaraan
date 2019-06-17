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

/*$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->mergeCells('A1:A3')
    ->setCellValue('B1', 'Nama Daerah Irigasi')
    ->mergeCells('B1:B3')
    ->setCellValue('C1', 'Areal (Ha)')
    ->mergeCells('C1:C3')
    ->setCellValue('D1', 'Panjang (m)')
    ->mergeCells('D1:D3')
    ->setCellValue('E1', 'Lebar rata-rata (m)')
    ->mergeCells('E1:E3')
    ->setCellValue('F1', 'Panjang Tiap Kondisi')
    ->mergeCells('F1:M1')
    ->setCellValue('F2', 'Baik')
    ->mergeCells('F2:G2')
    ->setCellValue('H2', 'Sedang')
    ->mergeCells('H2:I2')
    ->setCellValue('J2', 'Rusak Ringan')
    ->mergeCells('J2:K2')
    ->setCellValue('L2', 'Rusak Berat')
    ->mergeCells('L2:M2')
    ->setCellValue('F3', 'm')
    ->setCellValue('G3', '%')
    ->setCellValue('H3', 'm')
    ->setCellValue('I3', '%')
    ->setCellValue('J3', 'm')
    ->setCellValue('K3', '%')
    ->setCellValue('L3', 'm')
    ->setCellValue('M3', '%')
    ->setCellValue('N1', 'Rencana Penanganan')
    ->mergeCells('N1:N3')
    ->setCellValue('O1', 'Kebutuhan Anggaran (Milyar)')
    ->mergeCells('O1:O3')
    ->setCellValue('P1', 'Kemampuan')
    ->mergeCells('P1:Q1')
    ->setCellValue('P2', 'Rp. (Milyar)')
    ->mergeCells('P2:P3')
    ->setCellValue('Q2', 'm')
    ->mergeCells('Q2:Q3')
    ->setCellValue('R1', 'Usulan Pendanaan Tambahan')
    ->mergeCells('R1:T1')
    ->setCellValue('R2', 'Rp. (Milyar)')
    ->mergeCells('R2:R3')
    ->setCellValue('S2', 'm')
    ->mergeCells('S2:S3')
    ->setCellValue('T2', 'Sumber Dana')
    ->mergeCells('T2:T3');
*/


// HEADER
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('B3', 'PT. DUTAR BAROKAH RENT CAR & TRAVEL')
    ->setCellValue('B4', 'Jl. Pesantren/Aruman No 2 Cimahi Tlp (022)20660615 Fax (022)20660614 , Hp 081220272184')
    ->setCellValue('A6', 'SURAT JALAN')
    ->setCellValue('A7', 'No Polisi')
    ->setCellValue('A8', 'Merek/Type')
    ->setCellValue('A9', 'Driver')
    ->setCellValue('A10', 'No /Gol. SIM')
    ->setCellValue('A11', 'Penjemputan')
    ->setCellValue('G8', 'No.SJ :')
    ->setCellValue('G9', 'Penyewa')
    ->setCellValue('G10', 'Tlp :')
    ->setCellValue('G11', 'Tujuan :')
    ->setCellValue('B12', 'Keberangkatan')
    ->setCellValue('B13', 'Tanggal')
    ->setCellValue('C13', 'Jam')
    ->setCellValue('D13', 'Km')
    ->setCellValue('B15', 'Security')
    ->setCellValue('F12', 'Kedatangan')
    ->setCellValue('F13', 'Tanggal')
    ->setCellValue('G13', 'Jam')
    ->setCellValue('H13', 'Km')
    ->setCellValue('F15', 'Security')
    ->setCellValue('A21', 'Taufik Hamzah')
    ->setCellValue('A22', '( Manager Transportation )')
    ->setCellValue('A23', 'Cat: Harap kendaraan kembali dalam keadaan bersih')
    ->setCellValue('A24', 'Lembar 1 >> Driver')
    ->setCellValue('D22', '( Kepala Pool)')
    ->setCellValue('H22', '(  Driver )')
    ->setCellValue('I24', 'Lembar 2 >> Security');




// DATA
include('koneksi.php');
$no_surat_jalan = $_GET['no_surat_jalan'];
$query = "SELECT * FROM transaksi,kendaraan WHERE transaksi.nomor_polisi=kendaraan.nomor_polisi AND no_surat_jalan='$no_surat_jalan'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('B7', $row['nomor_polisi'])
    ->setCellValue('B8', $row['merk_type'])
    ->setCellValue('B9', $row['driver'])
    ->setCellValue('B10', $row['no_golongan_sim'])
    ->setCellValue('B11', $row['penjemputan'])
    ->setCellValue('G7', $row['tmpt_dibuat_surat_jln'] . ',')
    ->setCellValue('H7', $row['tgl_dibuat_surat_jln'])
    ->setCellValue('H8', $row['no_surat_jalan'])
    ->setCellValue('H9', $row['penyewa'])
    ->setCellValue('H10', $row['telepon'])
    ->setCellValue('H11', $row['tujuan'])
    ->setCellValue('B14', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("d/m/Y"))
    ->setCellValue('C14', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_keberangkatan'])->format("H:i:s"))
    ->setCellValue('F14', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("d/m/Y"))
    ->setCellValue('G14', DateTime::createFromFormat("Y-m-d H:i:s", $row['tgl_kedatangan'])->format("H:i:s"))
    ->setCellValue('H21', $row['driver']);
mysqli_close($conn);

// STYLING
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman')
    ->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setUnderline(true);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A24')->getFont()->setSize(7);
$objPHPExcel->getActiveSheet()->getStyle('I24')->getFont()->setSize(7);
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
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2:I5')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A6:I24')->applyFromArray($outlineborder);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:I6')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B12:D17')->applyFromArray($allborders);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F12:H17')->applyFromArray($allborders);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B12:D17')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F12:H17')->applyFromArray($centeredText);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A21:I22')->applyFromArray($centeredText);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
for ($i = 1; $i <= 24; $i++) {
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);
}

// MERGE
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B3:I3')
    ->mergeCells('B4:I4')
    ->mergeCells('A6:I6')
    ->mergeCells('B7:C7')
    ->mergeCells('B8:C8')
    ->mergeCells('H8:I8')
    ->mergeCells('B12:D12')
    ->mergeCells('B15:D17')
    ->mergeCells('F12:H12')
    ->mergeCells('F15:H17')
    ->mergeCells('A21:B21')
    ->mergeCells('A22:B22')
    ->mergeCells('A23:D23')
    ->mergeCells('D21:F21')
    ->mergeCells('D22:F22')
    ->mergeCells('H21:I21')
    ->mergeCells('H22:I22');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Surat Jalan');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="SuratJalan'.$no_surat_jalan.'.xlsx"');
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
