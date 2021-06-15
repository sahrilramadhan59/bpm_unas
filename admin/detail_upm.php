<?php include('../koneksi/koneksi.php'); ?>
<?php
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
$id_user = decrypt(strip_tags($_GET["id"]));

$ambil_data = $konek->query("SELECT * FROM user 
INNER JOIN level_user ON user.id_level=level_user.id_level
INNER JOIN status_user ON user.id_status=status_user.id_status 
WHERE user.id_user = '$id_user'");
$pecah = $ambil_data->fetch_assoc();
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
                        <h1>Detail Data UPM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Detail Data UPM</li>
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
                        <h3 class="my-3 text-cyan">DATA UPM</h3>
                        <hr>
                        <p class="text text-md">Nama : <?php echo $pecah['nama']; ?></p>
                        <p class="text text-md">Email : <?php echo $pecah['email']; ?></p>
                        <p class="text text-md">Username : <?php echo $pecah['username']; ?></p>
                        <p class="text text-md">Mendaftar Pada Tanggal : <?php echo $pecah['tgl_daftar']; ?></p>
                    </div>
                    <div class="col-sm-6"><br><br>
                        <hr>
                        <?php
                        if ($pecah['status_user'] == "Aktif") { ?>
                            <p class="text text-md text-primary">Status : <?php echo $pecah['status_user']; ?></p>
                        <?php } else { ?>
                            <p class="text text-md text-danger">Status : <?php echo $pecah['status_user']; ?></p>
                        <?php } ?>

                        <p class="text text-md">Unit : <?php echo $pecah['level']; ?></p>
                        <p class="text text-md">Nomor : <?php echo $pecah['no_hp']; ?></p>
                        <p class="text text-md">Terakhir Dilihat : <?php echo $pecah['last_online']; ?> : <?php echo $pecah['jam']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- ./wrapper -->