<?php
include "../koneksi/koneksi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
if (isset($_POST["hapus"])) {
    $kode_pedoman = $_POST["pilih"];

    for ($i = 0; $i < sizeof($kode_pedoman); $i++) {
        $ambil = $konek->query("SELECT * FROM tbl_pedoman 
        INNER JOIN user ON tbl_pedoman.id_user=user.id_user
        INNER JOIN level_user ON tbl_pedoman.id_level=level_user.id_level
        WHERE tbl_pedoman.id_pedoman='$kode_pedoman[$i]'"); //Ini untuk mengambil data 
        //yang disimpan didatabase

        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
        $file_saya = $pecah['upload_pedoman'];

        if (file_exists("../data_pedoman/$file_saya")) {
            unlink("../data_pedoman/$file_saya");
        }

        $Cek = $konek->query("DELETE FROM tbl_pedoman WHERE id_pedoman='$kode_pedoman[$i]'");
        //lalu hapus semua data beserta
    }
    if ($Cek > 0) {
        echo "<script>alert('Jumlah Data Yang Terhapus " . $i . ",Data Berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index.php?halaman=data_pedoman';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('Data tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
