<?php
include "../koneksi/koneksi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
	header('location: login');
	exit();
}
include "enkripsi.php";
if (isset($_POST["hapus"])) {
	$kode_standart = $_POST["pilih"];

	for ($i = 0; $i < sizeof($kode_standart); $i++) {
		$ambil = $konek->query("SELECT * FROM tbl_standart 
		INNER JOIN user ON tbl_standart.id_user=user.id_user
		INNER JOIN level_user ON tbl_standart.id_level=level_user.id_level 
		WHERE tbl_standart.id_standart='$kode_standart[$i]'"); //Ini untuk mengambil data 

		$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
		$file_saya = $pecah['upload_standart'];

		if (file_exists("../data_standart/$file_saya")) {
			unlink("../data_standart/$file_saya");
		}

		$Cek = $konek->query("DELETE FROM tbl_standart WHERE id_standart='$kode_standart[$i]'");
	}

	if ($Cek > 0) {
		echo "<script>alert('Jumlah Data Yang Terhapus " . $i . ",Data Berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
		//dengan menggunakan javascript.
		echo "<script>location='index?halaman=data_standart';</script>"; //lalu kembali ke halaman produk.
	} else {
		echo "<script>alert('Data tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
	}
}
