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
$pdf->Cell(5, 5, ':	'.format_date_only($r_invoice['transaction_date']), 0, 'L');
$pdf->SetXY(70, 15);
$pdf->Cell(30, 5, 'NO. NOTA', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_invoice['transaction_code'], 0, 'L');
$pdf->SetXY(140, $y);

$pdf->Cell(30, 5, 'KEPADA', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_member['member_name'], 0, 'L');
$pdf->SetXY(140, 15);
$pdf->Cell(30, 5, 'ALAMAT', 0, 'L');
$pdf->Cell(5, 5, ':	'.$r_member['member_alamat'], 0, 'L');

$pdf->SetXY(5, 30);
$pdf->Cell(10, 5, 'NO', 1, 0,'C');
$pdf->Cell(25, 5, 'KODE BARANG', 1, 0, 'C');
$pdf->Cell(30, 5, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(20, 5, 'JML', 1, 0, 'C');
$pdf->Cell(25, 5, 'JML KONVERSI', 1, 0, 'C');
$pdf->Cell(35, 5, 'KETERANGAN BARANG', 1, 0, 'C');
$pdf->Cell(25, 5, 'HARGA', 1, 0, 'C');
$pdf->Cell(30, 5, 'SUB TOTAL', 1, 0, 'C');

$pdf->SetXY(5, 35);
$no = 1;
$hh = 5;
$total_berat = 0;
$total_jml = 0;
$q_invo = get_detail_transaction($r_invoice['transaction_id']);
$transaction_id = $r_invoice['transaction_id'];
while ($r_invo = mysql_fetch_array($q_invo)) {
	$pdf->Cell(10, $hh+5, $no, 1, 0, 'C');
	$pdf->Cell(25, $hh+5, $r_invo['kode_barang'], 1, 0, 'C');
	$pdf->Cell(30, $hh+5, $r_invo['item_name'], 1, 0, 'C');
	$pdf->Cell(20, $hh+5, $r_invo['transaction_detail_qty_real'].'('.$r_invo['unit_utama_name'].')', 1, 0, 'C');
	$unit_id_utama = get_unit_id($r_invo['item_id']);
	$pdf->Cell(25, $hh+5, konversi_total_jumlah($unit_id_utama, $r_invo['item_id'],$r_invo['transaction_detail_qty_real'],$r_invo['transaction_detail_unit']), 1, 0, 'C');
	$item_id = $r_invo['item_id'];
							$where_item_id = "WHERE item_id = '$item_id' AND transaction_id = '$transaction_id'";
							$q_item_keterangan_details = select_config('transaction_details_item' ,$where_item_id);
	while ($r_item_keterangan_details = mysql_fetch_array($q_item_keterangan_details)) {
				 $keterangan_item = $r_item_keterangan_details['keterangan_item'];
				 $where_keterangan_item = "WHERE item_keterangan_details_id = '$keterangan_item'";
				 $q_item_keterangan_details_id = select_config_by('item_keterangan_details', 'keterangan_details', $where_keterangan_item);
	}
	$pdf->Cell(35, $hh+5,$q_item_keterangan_details_id, 1, 0,'C');
	$pdf->Cell(25, $hh+5, format_rupiah($r_invo['transaction_detail_price']), 1, 0, 'R');
	$pdf->Cell(30, $hh+5, format_rupiah($r_invo['transaction_detail_price']*$r_invo['transaction_detail_qty']), 1, 0, 'R');
	$no++;
					$total_jml = $total_jml + $r_invo['transaction_detail_qty_real'];
					$total_berat = $total_berat + $r_invo['item_berat'];
	$hh = $hh + 5;
}
$pdf->SetXY(150, $hh+35);
$pdf->Cell(25, $hh, 'TOTAL', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_invoice['transaction_grand_total']), 1, 0, 'R');
$pdf->SetXY(150, $hh+45);
$pdf->Cell(25, $hh, 'BAYAR', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_invoice['transaction_payment']), 1, 0, 'R');
$pdf->SetXY(150, $hh+55);
$pdf->Cell(25, $hh, 'KEMBALIAN', 0, 0, 'R');
$pdf->Cell(30, $hh, format_rupiah($r_invoice['transaction_change']), 1, 0, 'R');

$pdf->SetXY(5, $hh+40);
$pdf->Cell(25, $hh, 'CARA PEMBAYARAN', 0, 0, 'L');
$pdf->SetX($hh+30);
$pdf->Cell(45, $hh, ': '.get_payment_method($r_invoice['payment_method_id']), 0, 0, 'L');
$pdf->SetXY(5, $hh+45);
$pdf->Cell(25, $hh, 'BANK PEMBELI', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.get_bank_name($r_invoice['bank_id']), 0, 0, 'L');
$pdf->SetXY(5, $hh+50);
$pdf->Cell(25, $hh, 'NO. REKENING', 0, 0, 'L');
$pdf->Cell(30, $hh, ': '.get_bank_name($r_invoice['bank_id']), 0, 0, 'L');

$pdf->SetXY(10, $hh+70);
$pdf->Cell(100, $hh, 'Pembeli', 0, 0, 'C');
$pdf->Cell(100, $hh, 'Hormat Kami, '.$r_office['office_name'], 0, 0, 'C');

$pdf->SetXY(10, $hh+90);
$pdf->Cell(100, $hh, $r_member['member_name'] ? $r_member['member_name'] : ".................", 0, 0, 'C');
$pdf->Cell(100, $hh, $user_name, 0, 0, 'C');

$pdf->Image("../img/white.png",50,$hh+120,100,0,"","home.php");

$pdf->Output();
 ?>
