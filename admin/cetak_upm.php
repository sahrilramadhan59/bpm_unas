<?php
session_start();
// memanggil library FPDF
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
require('../fpdf18/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(290, 7, 'BPM UNIVERSITAS NASIONAL', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 7, 'DATA UPM', 0, 1, 'C');
$pdf->Cell(50, 10, '', 0, 1);
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(50, 10, 'Data Di Ambil Dari ' . date('d F Y', strtotime($tgl_awal)) . ' sd ' . date('d F Y', strtotime($tgl_akhir)) . '.', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, 'Nama', 1, 0, 'C');
$pdf->Cell(60, 6, 'Email', 1, 0, 'C');
$pdf->Cell(60, 6, 'Username', 1, 0, 'C');
$pdf->Cell(30, 6, 'UNIT', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Daftar', 1, 0, 'C');
$pdf->Cell(50, 6, 'Status', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

include '../koneksi/koneksi.php';
$data_standart = mysqli_query($konek, "SELECT user.username, user.nama, user.email, user.tgl_daftar, 
level_user.level, status_user.status_user FROM user 
INNER JOIN level_user ON user.id_level=level_user.id_level
INNER JOIN status_user ON user.id_status=status_user.id_status
WHERE tgl_daftar BETWEEN '$tgl_awal' AND '$tgl_akhir'");
while ($row = mysqli_fetch_array($data_standart)) {
    $pdf->Cell(50, 6, $row['nama'], 1, 0, 'C');
    $pdf->Cell(60, 6, $row['email'], 1, 0, 'C');
    $pdf->Cell(60, 6, $row['username'], 1, 0, 'C');
    $pdf->Cell(30, 6, $row['level'], 1, 0, 'C');
    $pdf->Cell(30, 6, date('d F Y', strtotime($row['tgl_daftar'])), 1, 0, 'C');
    $pdf->Cell(50, 6, $row['status_user'], 1, 1, 'C');
}

$pdf->Output();
