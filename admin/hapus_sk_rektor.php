<?php
include "../koneksi/koneksi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
if (isset($_POST["hapus"])) {
    $kode_sk_rektor = $_POST["pilih"];
    $id_admin = $_SESSION['admin']['id_admin'];

    for ($i = 0; $i < sizeof($kode_sk_rektor); $i++) {
        $ambil = $konek->query("SELECT * FROM tbl_sk_rektor 
        INNER JOIN admin ON tbl_sk_rektor.id_admin=admin.id_admin
        INNER JOIN level_user ON tbl_sk_rektor.id_level=level_user.id_level
        WHERE tbl_sk_rektor.id_sk_rektor='$kode_sk_rektor[$i]' AND tbl_sk_rektor.id_admin='$id_admin'"); //Ini untuk mengambil data 
        //yang disimpan didatabase

        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
        $file_saya = $pecah['upload_sk_rektor'];

        if (file_exists("../data_sk_rektor/$file_saya")) {
            unlink("../data_sk_rektor/$file_saya");
        }

        $Cek = $konek->query("DELETE FROM tbl_sk_rektor WHERE id_sk_rektor='$kode_sk_rektor[$i]' AND id_admin='$id_admin'");
        //lalu hapus semua data beserta
    }
    if ($Cek > 0) {
        echo "<script>alert('Jumlah Data Yang Terhapus " . $i . ",Data Berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index?halaman=data_sk_rektor';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('Data tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
