<?php include('../koneksi/koneksi.php'); ?>
<?php
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
$id_sk_rektor = decrypt(strip_tags($_GET["id"]));
$id_admin = decrypt(strip_tags($_GET["user"]));

$ambil_sk_rektor = $konek->query("SELECT * FROM tbl_sk_rektor 
INNER JOIN admin ON tbl_sk_rektor.id_admin=admin.id_admin
INNER JOIN level_user ON tbl_sk_rektor.id_level=level_user.id_level
INNER JOIN status_user ON admin.id_status=status_user.id_status 
WHERE tbl_sk_rektor.id_admin = '$id_admin' AND tbl_sk_rektor.id_sk_rektor='$id_sk_rektor'");
$pecah_sk_rektor = $ambil_sk_rektor->fetch_assoc();
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
                    <div class="col-sm-6">
                        <h3 class="my-3 text-cyan" align="center">DATA SK REKTOR</h5>
                            <hr>
                            <p class="text text-md">NO SK REKTOR : <?php echo $pecah_sk_rektor['no_sk']; ?></p>
                            <p class="text text-md">TAHUN : <?php echo $pecah_sk_rektor['tahun']; ?></p>
                            <p class="text text-md">Upload : <?php echo $pecah_sk_rektor['tgl_upload']; ?></p>
                            <p class="text text-md">TENTANG : <?php echo $pecah_sk_rektor['tentang']; ?></p>
                            <p class="text text-md">DATA FILE :
                                <a href="../data_sk_rektor/<?php echo $pecah_sk_rektor['upload_sk_rektor']; ?>" target="_blank"><?php echo $pecah_sk_rektor['upload_sk_rektor']; ?></a>
                            </p>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="my-3 text-cyan" align="center">Data BPM</h5>
                            <hr>
                            <p class="text text-md">Nama : <?php echo $pecah_sk_rektor['nama_admin']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah_sk_rektor['email']; ?></p>
                            <p class="text text-md">UNIT : <?php echo $pecah_sk_rektor['level']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- ./wrapper -->