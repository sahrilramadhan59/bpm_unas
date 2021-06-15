<?php
include '../koneksi/koneksi.php'; //memanggil koneksi.php.
?>
<?php
$id_user = $_SESSION["petugas"]["id_user"];
$detail_petugas = $konek->query("SELECT online, nama FROM user WHERE id_user='$id_user'");
$pecah = $detail_petugas->fetch_assoc();
?>
<div class="wrapper">
  <!-- Isi Dashboard -->
  <?php include('isi_dashboard.php'); ?>
  <!-- Isi Dashboard -->
</div>