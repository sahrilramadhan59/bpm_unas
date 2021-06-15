<?php include('../koneksi/koneksi.php'); ?>
<?php
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
$id_standart = decrypt(strip_tags($_GET["id"]));
$id_user = decrypt(strip_tags($_GET["user"]));

$ambil_standart = $konek->query("SELECT * FROM tbl_standart 
                                            INNER JOIN user ON tbl_standart.id_user=user.id_user
		                                    INNER JOIN level_user ON tbl_standart.id_level=level_user.id_level
                                            INNER JOIN status_user ON user.id_status=status_user.id_status 
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
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                    <div class="col-sm-4">
                        <h3 class="my-3 text-cyan">Data UPM</h5>
                            <hr>
                            <p class="text text-md">Nama : <?php echo $pecah_standart['nama']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah_standart['email']; ?></p>
                            <p class="text text-md">UNIT : <?php echo $pecah_standart['level']; ?></p>
                            <?php if ($pecah_standart['status_user'] == "Tidak Aktif") { ?>
                                <p class="text text-md text-danger">Status : <?php echo $pecah_standart['status_user']; ?></p>
                            <?php } else { ?>
                                <p class="text text-md text-primary">Status : <?php echo $pecah_standart['status_user']; ?></p>
                            <?php } ?>
                            <p class="text text-md">Terakhir Login : <?php echo $pecah_standart['last_online']; ?></p>
                            <p class="text text-md">Terakhir Dilihat : <?php echo $pecah_standart['jam']; ?></p>
                            <p class="text text-md">Status Online : <?php echo $pecah_standart['online']; ?></p>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="my-3 text-cyan">Data Standart</h5>
                            <hr>
                            <p class="text text-md">Data File :
                                <a href="../data_standart/<?php echo $pecah_standart['upload_standart']; ?>" target="_blank"><?php echo $pecah_standart['upload_standart']; ?></a>
                            </p>
                            <p class="text text-md">Tgl Upload : <?php echo $pecah_standart['tgl_upload']; ?></p>
                            <p class="text text-md">Detail : </p>
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