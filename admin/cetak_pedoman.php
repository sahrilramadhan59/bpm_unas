<?php
session_start();
// memanggil library FPDF
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
require('../fpdf18/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(290, 7, 'BPM UNIVERSITAS NASIONAL', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290, 7, 'PERATURAN PEDOMAN UPM', 0, 1, 'C');
$pdf->Cell(50, 10, '', 0, 1);
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$nomor = 1;
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(50, 10, 'Data Di Ambil Dari ' . date('d F Y', strtotime($tgl_awal)) . ' sd ' . date('d F Y', strtotime($tgl_akhir)) . '.', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 6, 'No', 1, 0, 'C');
$pdf->Cell(50, 6, 'Nama', 1, 0, 'C');
$pdf->Cell(50, 6, 'UNIT', 1, 0, 'C');
$pdf->Cell(30, 6, 'Status', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
$pdf->Cell(146, 6, 'Detail Peraturan Pedoman', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

include '../koneksi/koneksi.php';
$data_standart = mysqli_query($konek, "SELECT * FROM tbl_pedoman 
INNER JOIN user ON tbl_pedoman.id_user=user.id_user
INNER JOIN level_user ON user.id_level=level_user.id_level
INNER JOIN status_user ON user.id_status=status_user.id_status
WHERE tgl_upload BETWEEN '$tgl_awal' AND '$tgl_akhir'");
while ($row = mysqli_fetch_array($data_standart)) {
    $pdf->Cell(5, 6, $nomor++, 1, 0, 'C');
    $pdf->Cell(50, 6, $row['nama'], 1, 0, 'C');
    $pdf->Cell(50, 6, $row['level'], 1, 0, 'C');
    $pdf->Cell(30, 6, $row['status_user'], 1, 0, 'C');
    $pdf->Cell(30, 6, date('d F Y', strtotime($row['tgl_upload'])), 1, 0, 'C');
    $pdf->Cell(146, 6, $row['keterangan_pedoman'], 1, 1);
}

$pdf->Output();
