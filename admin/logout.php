<?php
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
// echo "<pre>";
// print_r($_SESSION["admin"]);
// echo "</pre>";
$id_admin = $_SESSION["admin"]["id_admin"];
$jam = date("H:i:s", time() + 60 * 60 * 7);
$last_online = date("Y-m-d", strtotime('+1 days'));

$konek->query("UPDATE admin SET online='Tidak Aktif', jam='$jam', last_online='$last_online' WHERE id_admin='$id_admin'"); //Setelah itu, Update datanya untuk login terakhirnya kapan
session_destroy();

echo "<script>alert('Anda Telah Logout');</script>";
echo "<script>location = 'login';</script>";
