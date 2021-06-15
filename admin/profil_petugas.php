<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
?>
<?php
$id_user = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM user 
INNER JOIN status_user ON user.id_status=status_user.id_status
INNER JOIN level_user ON user.id_level=level_user.id_level
WHERE user.id_user='$id_user'");
$pecah = $ambil->fetch_assoc();
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
                        <h1>Detail Profil Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Detail Profil Petugas</li>
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
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3"><?php echo $pecah['nama']; ?></h3>
                        <hr>
                        <h4><i class="fa fa-1x fa-envelope"></i> Email</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['email']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3"><i class="fa fa-1x fa-user"></i> Username</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['username']; ?></p>
                        </div>
                        <hr>
                        <h4 class="mt-3"><i class="fa fa-1x fa-users"></i> UNIT</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['level']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3"><i class="fa fa-1x fa-eye"></i> Terakhir Login</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md text-primary"><?php echo $pecah['last_online']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3"><i class="fa fa-1x fa-eye"></i> Terakhir Dilihat</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md text-primary"><?php echo $pecah['jam']; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <br><br>
                        <hr>
                        <h4 class="mt-3"><i class="fa fa-1x fa-calendar"></i> Tanggal Daftar</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md text-primary"><?php echo $pecah['tgl_daftar']; ?></p>
                        </div>
                        <hr>
                        <h4 class="mt-3">Status</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <!-- Membuat Relasi Petugas Untuk Mengetahui Status Petugas -->
                            <?php
                            //Buat Query nya.
                            $ambil_status = $konek->query("SELECT status_user.status_user FROM user INNER JOIN status_user ON 
                            user.id_status=status_user.id_status 
                            WHERE user.id_user = '$id_user'");
                            $pecah_status = $ambil_status->fetch_assoc();
                            //Artinya ambil data dari tabel status petugas hanya nama statusnya saja dari tabel status_petugas join ke petugas.
                            //Lalu pecahkan menjadi array.

                            // Jika status petugas aktif maka kaasih tau dan berikan warna biru untuk menandakan dia aktif.
                            if ($pecah_status['status_user'] == "Aktif") { ?>
                                <p class="text text-md text-info"><?php echo $pecah_status['status_user']; ?></p>

                                <!-- Selain itu(artinya dia tidak aktif, maka tampilkan dengan warna merah) yang menandakan dia sudah tidak aktif -->
                            <?php } else { ?>
                                <p class="text text-md text-danger"><?php echo $pecah_status['status_user']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.row -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->