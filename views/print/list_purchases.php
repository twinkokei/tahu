<?php

require('../lib/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetXY(0, $y);
$pdf->MultiCell(70, 5, 'FAKTUR PENJUALAN', 0, 'C');
$pdf->SetX(0);
$pdf->MultiCell(70, 5, $r_office['office_name'], 0, 'C');
$pdf->SetX(0);
$pdf->MultiCell(70, 5, $r_office['office_address'], 0, 'C');
$pdf->SetXY(70, $y);

$pdf->Cell(30, 5, 'PRINTED DATE', 0, 'L');
$pdf->Cell(5, 5, ':	'.format_date_only($r_purchases['purchases_date']), 0, 'L');
$pdf->SetXY(70, 15);
$pdf->Cell(30, 5, 'NO. NOTA', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_purchases['purchases_code'], 0, 'L');
$pdf->SetXY(140, $y);

$pdf->Cell(30, 5, 'KEPADA', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_purchases_supplier['supplier_name'], 0, 'L');
$pdf->SetXY(140, 15);
$pdf->Cell(30, 5, 'ALAMAT', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_purchases_supplier['supplier_addres'], 0, 'L');

$pdf->SetXY(5, 30);
$pdf->Cell(10, 5, 'NO', 1, 0,'C');
$pdf->Cell(30, 5, 'KODE BARANG', 1, 0, 'C');
$pdf->Cell(35, 5, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(30, 5, 'JML', 1, 0, 'C');
$pdf->Cell(40, 5, 'KETERANGAN BARANG', 1, 0, 'C');
$pdf->Cell(25, 5, 'HARGA', 1, 0, 'C');
$pdf->Cell(30, 5, 'SUB TOTAL', 1, 0, 'C');

$pdf->SetXY(5, 35);

$hh_ = 5;
$hh = 5;
$no = 1;
$no_ = 1;
$height = 0;
$total_berat = 0;
$purchase_id = $r_purchases['purchase_id'];
$q_purchase = get_purchase($r_purchases['purchase_id']);
while ($r_purchase = mysql_fetch_array($q_purchase)) {
	$item_id = $r_purchase['item_id'];
	$where_item_id_purchase_id = "WHERE item_id = '$item_id' AND purchase_id = '$purchase_id'";

	$where_item_id = "WHERE item_id = '$item_id'";
	$kategori_id = select_config_by('items', 'kategori_id', $where_item_id);
	$where_kategori_id = "WHERE kategori_id = '$kategori_id'";
	$keterangan_details_count = select_config_by('kategori_keterangan', 'count(*)', $where_kategori_id);
	$no = 1;
	$q_item_keterangan_details = select_config('item_keterangan_details' ,$where_item_id_purchase_id);
	$q_item_keterangan_details_ = select_config('item_keterangan_details' ,$where_item_id_purchase_id);

	while ($r_item_keterangan_details = mysql_fetch_array($q_item_keterangan_details)) {
		if ($no%$keterangan_details_count==0) {
			$hh_ = $hh_+5;
		}
		$no++;
	}

	$pdf->Cell(10, $hh_+5, $no_, 1, 0, 'C');
	$pdf->Cell(30, $hh_+5, $r_purchase['kode_barang'], 1, 0, 'C');
	$pdf->Cell(35, $hh_+5, $r_purchase['item_name'], 1, 0, 'C');
	$pdf->Cell(30, $hh_+5, $r_purchase['purchase_qty'].'('.$r_purchase['unit_name'].')', 1, 0, 'C');

	$no = 1;
	while ($r_item_keterangan_details = mysql_fetch_array($q_item_keterangan_details_)) {
		if ($no%$keterangan_details_count==0) {
			$pdf->SetX(110);
			$pdf->MultiCell(40, $hh_+5, $r_item_keterangan_details['keterangan_details'], 1, 'C');
		}
		$no++;
	}
	$pdf->SetXY(150, $hh+30);
	$pdf->Cell(25, $hh_+5, format_rupiah($r_purchase['purchase_price']), 1, 0, 'R');
	$sub_total = $r_purchase['purchase_qty']*$r_purchase['purchase_price'];
	$pdf->Cell(30, $hh_+5, format_rupiah($sub_total), 1, 0, 'R');
	$hh = $hh + 5;
	$no_++;
}
$pdf->SetXY(150, $hh_+40);
$pdf->Cell(25, $hh, 'TOTAL', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_purchases_t['purchase_total']), 1, 0, 'R');

$pdf->SetXY(150, $hh_+50);
$pdf->Cell(25, $hh, 'BAYAR', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_purchases_t['purchase_payment']), 1, 0, 'R');

$pdf->SetXY(150, $hh_+60);
$pdf->Cell(25, $hh, 'KEMBALIAN', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_purchases_t['purchase_change']), 1, 0, 'R');

$pdf->SetXY(5, $hh_+45);
$pdf->Cell(45, $hh, 'CARA PEMBAYARAN', 0, 0, 'L');
$pdf->SetX($hh+30);
$pdf->Cell(45, $hh, ': '.get_payment_method($r_purchases['payment_method']), 0, 0, 'L');

$pdf->SetXY(5, $hh_+50);
$pdf->Cell(35, $hh, 'Uang Muka', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.get_bank_name($r_purchases['bank_id_to']), 0, 0, 'L');

$pdf->SetXY(5, $hh_+55);
$pdf->Cell(35, $hh, 'Tanggal Jatuh Tempo', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.format_date_only($r_hutang['batas_tanggal']), 0, 0, 'L');

$pdf->SetXY(5, $hh_+60);
$pdf->Cell(35, $hh, 'Sisa', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.format_rupiah($r_purchases_t['purchase_total'] - $r_hutang['uang_muka']), 0, 0, 'L');

$pdf->SetXY(5, $hh_+65);
$pdf->Cell(35, $hh, 'BANK SUPPLIER', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.get_bank_name($r_purchases['bank_id_to']), 0, 0, 'L');
$pdf->SetXY(5, $hh_+70);
$pdf->Cell(35, $hh, 'NO. REKENING', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.$r_purchases['bank_account_to'] ? $r_purchases['bank_account_to'] : "-", 0, 0, 'L');

$pdf->SetXY(10, $hh_+85);
$pdf->Cell(100, $hh, 'Supplier', 0, 0, 'C');
$pdf->Cell(100, $hh, 'Hormat Kami, '.$r_office['office_name'], 0, 0, 'C');

$pdf->Image("../img/white.png",50,$hh_+120,100,0,"","home.php");

$pdf->SetXY(10, $hh_+100);
$pdf->Cell(100, $hh, $r_purchases_supplier['supplier_name'] ? $r_purchases_supplier['supplier_name'] : ".................", 0, 0, 'C');
$pdf->Cell(100, $hh, $user_name, 0, 0, 'C');


$pdf->Output();
 ?>
