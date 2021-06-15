<?php
include "../koneksi/koneksi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
if (isset($_POST["hapus"])) {
    $kode_kegiatan = $_POST["pilih"];

    for ($i = 0; $i < sizeof($kode_kegiatan); $i++) {
        $ambil = $konek->query("SELECT * FROM tb_kegiatan 
        INNER JOIN user ON tb_kegiatan.id_user=user.id_user
        INNER JOIN level_user ON tb_kegiatan.id_level=level_user.id_level
        WHERE tb_kegiatan.id_kegiatan='$kode_kegiatan[$i]'"); //Ini untuk mengambil data 
        //yang disimpan didatabase

        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
        $file_saya = $pecah['upload_kegiatan_harian'];
        $file_saya2 = $pecah['upload_kegiatan_bulanan'];

        if (file_exists("../data_kegiatan_harian/$file_saya") && file_exists("../data_kegiatan_bulanan/$file_saya2")) {
            unlink("../data_kegiatan_harian/$file_saya");
            unlink("../data_kegiatan_bulanan/$file_saya2");
        } elseif (file_exists("../data_kegiatan_harian/$file_saya") && !file_exists("../data_kegiatan_bulanan/$file_saya2")) {
            unlink("../data_kegiatan_harian/$file_saya");
        } elseif (!file_exists("../data_kegiatan_harian/$file_saya") && file_exists("../data_kegiatan_bulanan/$file_saya2")) {
            unlink("../data_kegiatan_bulanan/$file_saya2");
        }

        $Cek = $konek->query("DELETE FROM tb_kegiatan WHERE id_kegiatan='$kode_kegiatan[$i]'");
        //lalu hapus semua data beserta
    }
    if ($Cek > 0) {
        echo "<script>alert('Jumlah Data Yang Terhapus " . $i . ",Data Berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index.php?halaman=data_kegiatan';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('Data tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
