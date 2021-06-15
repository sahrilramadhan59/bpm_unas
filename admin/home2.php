<?php
include '../koneksi/koneksi.php'; //memanggil koneksi.php.
?>
<?php
$id_admin = $_SESSION["admin"]["id_admin"];
$detail_petugas = $konek->query("SELECT online, nama_admin FROM admin WHERE id_admin='$id_admin'");
$pecah = $detail_petugas->fetch_assoc();
?>
<div class="wrapper">
  <!-- Isi Dashboard -->
  <?php include('isi_dashboard.php'); ?>
  <!-- Isi Dashboard -->
</div>