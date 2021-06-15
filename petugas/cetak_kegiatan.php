<?php
session_start();
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: ../login');
    exit();
}
// memanggil library FPDF
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
$pdf->Cell(290, 7, 'PERATURAN KEGIATAN UPM', 0, 1, 'C');
$pdf->Cell(50, 10, '', 0, 1);
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(50, 10, 'Data Di Ambil Dari ' . date('d F Y', strtotime($tgl_awal)) . ' sd ' . date('d F Y', strtotime($tgl_akhir)) . '.', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 6, 'No', 1, 0, 'C');
$pdf->Cell(70, 6, 'Nama', 1, 0, 'C');
$pdf->Cell(30, 6, 'UNIT', 1, 0, 'C');
$pdf->Cell(30, 6, 'Status', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
$pdf->Cell(60, 6, 'Kegiatan Harian', 1, 0, 'C');
$pdf->Cell(60, 6, 'Kegiatan Bulanan', 1, 1, 'C');
$nomor = 1;
$pdf->SetFont('Arial', '', 10);

include '../koneksi/koneksi.php';
$id_user = $_SESSION['petugas']['id_user'];
$data_standart = mysqli_query($konek, "SELECT * FROM tb_kegiatan 
INNER JOIN user ON tb_kegiatan.id_user=user.id_user
INNER JOIN level_user ON user.id_level=level_user.id_level
INNER JOIN status_user ON user.id_status=status_user.id_status
WHERE user.id_user='$id_user' AND tb_kegiatan.tgl_upload BETWEEN '$tgl_awal' AND '$tgl_akhir'");
while ($row = mysqli_fetch_array($data_standart)) {
    $pdf->Cell(5, 6, $nomor++, 1, 0, 'C');
    $pdf->Cell(70, 6, $row['nama'], 1, 0, 'C');
    $pdf->Cell(30, 6, $row['level'], 1, 0, 'C');
    $pdf->Cell(30, 6, $row['status_user'], 1, 0, 'C');
    $pdf->Cell(30, 6, date('d F Y', strtotime($row['tgl_upload'])), 1, 0, 'C');
    $pdf->Cell(60, 6, $row['kegiatan_harian'], 1, 0);
    $pdf->Cell(60, 6, $row['kegiatan_bulanan'], 1, 1);
}

$pdf->Output();
