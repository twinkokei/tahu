<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../../lib/phpexcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Purchase Code')
            ->setCellValue('D1', 'Journal Type')
            // ->setCellValue('D1', 'Meja')
            ->setCellValue('E1', 'User')
			->setCellValue('F1', 'Total')
			->setCellValue('G1', 'Client')
			// ->setCellValue('H1', 'Serv. Charge(5%)')
			->setCellValue('H1', 'Cabang')
			->setCellValue('I1', 'Nama item')
			->setCellValue('J1', 'Jumlah')
			->setCellValue('K1', 'Harga Pembelian/qty');

			$i=2;
			$k=1;

while ($row = mysql_fetch_array($query)) {



			$objPHPExcel->setActiveSheetIndex(0)
        	->setCellValue('A'.$i, $k)
            ->setCellValue('B'.$i, $row['purchase_date'])//INI INVOICE
            ->setCellValue('C'.$i, $row['purchase_code'])
            ->setCellValue('D'.$i, $row['journal_type_name'])
            // ->setCellValue('D'.$i, $row['table_name'].'('.$row['building_name'].')')
            ->setCellValue('E'.$i, $row['user_name'])
            ->setCellValue('F'.$i, 'Rp. '.number_format($row['purchase_total']))
            ->setCellValue('G'.$i, $row['CLIENT'])
			->setCellValue('H'.$i, $row['branch_name'])
			// ->setCellValue('H'.$i, 'Rp. '.number_format($svc))
			->setCellValue('I'.$i, $row['item_name'])
			->setCellValue('J'.$i, $row['purchase_qty'])
			->setCellValue('K'.$i, 'Rp. '.number_format($row['purchase_price']));
			$i++;
			$k++;
}


$objPHPExcel->getActiveSheet()->setTitle('Simple');

$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Tahu.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
