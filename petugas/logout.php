<?php
// echo "<pre>";
// print_r($_SESSION["admin"]);
// echo "</pre>";
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    echo "<script>alert('Anda Harus Login !!!')</script>";
    echo "<script>location='../login'</script>"; //mengalihkan secara paksa ke dalam form login untuk memastikan apakah yang login admin atau bukan. jika admin maka akan dialihkan ke dashboard administrator. dan jika bukan maka akan di alihkan ke form login untuk login kembali.
    exit();
}
$id_user = $_SESSION["petugas"]["id_user"];
$jam = date("H:i:s", time() + 60 * 60 * 7);
$last_online = date("Y-m-d");

$konek->query("UPDATE user SET online='Tidak Aktif', jam='$jam', last_online='$last_online' WHERE id_user='$id_user'"); //Setelah itu, Update datanya untuk login terakhirnya kapan
session_destroy();

echo "<script>alert('Anda Telah Logout');</script>";
echo "<script>location = '../login';</script>";
