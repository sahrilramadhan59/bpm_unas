<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
if (isset($_POST["hapus"])) {
    $kode_standart = $_POST["pilih"];

    for ($i = 0; $i < sizeof($kode_standart); $i++) {
        $ambil = $konek->query("SELECT * FROM user 
		INNER JOIN status_user ON user.id_status=status_user.id_status
		INNER JOIN level_user ON user.id_level=level_user.id_level 
		WHERE user.id_user='$kode_standart[$i]'"); //Ini untuk mengambil data 

        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.

        $Cek = $konek->query("DELETE FROM user WHERE id_user='$kode_standart[$i]'");
    }

    if ($Cek > 0) {
        echo "<script>alert('Jumlah Data Yang Terhapus " . $i . ",Data Berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index?halaman=data_upm';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('Data tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
