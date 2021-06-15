<?php
include('../koneksi/koneksi.php');
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: ../login');
    exit();
}
?>
<?php
include "enkripsi.php";
$id_standart = decrypt(strip_tags($_GET["id"]));
$id_user = $_SESSION['petugas']['id_user'];
$ambil_standart = $konek->query("SELECT * FROM tbl_standart 
INNER JOIN user ON tbl_standart.id_user=user.id_user
INNER JOIN level_user ON tbl_standart.id_level=level_user.id_level 
WHERE tbl_standart.id_user = '$id_user' AND tbl_standart.id_standart='$id_standart'");
$pecah_standart = $ambil_standart->fetch_assoc();
?>
<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Data Standart</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Detail Data Standart</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="my-3 text-cyan">Data Standart</h5>
                            <p class="text text-md">
                                <i class="fa fa-user"></i> Di Upload Oleh : <?php echo $pecah_standart['nama']; ?>
                            </p>
                            <p class="text text-md">
                                <i class="fa fa-network-wired"></i> Unit : <?php echo $pecah_standart['level']; ?>
                            </p>
                            <hr>
                            <p class="text text-md">
                                <i class="fa fa-file"></i> File Kegiatan Harian :
                                <a href="../data_standart/<?php echo $pecah_standart['upload_standart']; ?>" target="_blank"><?php echo $pecah_standart['upload_standart']; ?></a>
                            </p>
                            <p class="text text-md">
                                <i class="fa fa-calendar"></i> Di Upload : <b><?php echo $pecah_standart['tgl_upload']; ?></b>
                            </p>
                            <p class="text text-md"><i class="fa fa-search"></i> Detail Peraturan Standart : </p>
                            <textarea class="form-control" name="" id="" cols="30" rows="7" readonly><?php echo $pecah_standart['keterangan_standart']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- ./wrapper -->