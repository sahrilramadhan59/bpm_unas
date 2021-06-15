<?php include('../koneksi/koneksi.php'); ?>
<?php
include "enkripsi.php";
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
$id_kegiatan = decrypt(strip_tags($_GET["id"]));
$id_user = decrypt(strip_tags($_GET["user"]));
$ambil_kegiatan = $konek->query("SELECT * FROM tb_kegiatan 
INNER JOIN user ON tb_kegiatan.id_user=user.id_user
INNER JOIN level_user ON tb_kegiatan.id_level=level_user.id_level 
INNER JOIN status_user ON user.id_status=status_user.id_status 
WHERE tb_kegiatan.id_user = '$id_user' AND tb_kegiatan.id_kegiatan='$id_kegiatan'");
$pecah_kegiatan = $ambil_kegiatan->fetch_assoc();
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
                        <h1>Detail Data Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Detail Data Kegiatan</li>
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
                            <p class="text text-md">Nama : <?php echo $pecah_kegiatan['nama']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah_kegiatan['email']; ?></p>
                            <p class="text text-md">UNIT : <?php echo $pecah_kegiatan['level']; ?></p>
                            <?php if ($pecah_kegiatan['status_user'] == "Tidak Aktif") { ?>
                                <p class="text text-md text-danger">Status : <?php echo $pecah_kegiatan['status_user']; ?></p>
                            <?php } else { ?>
                                <p class="text text-md text-primary">Status : <?php echo $pecah_kegiatan['status_user']; ?></p>
                            <?php } ?>
                            <p class="text text-md">Terakhir Login : <?php echo $pecah_kegiatan['last_online']; ?></p>
                            <p class="text text-md">Terakhir Dilihat : <?php echo $pecah_kegiatan['jam']; ?></p>
                            <p class="text text-md">Status Online : <?php echo $pecah_kegiatan['online']; ?></p>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="my-3 text-cyan">Data Kegiatan</h5>
                            <hr>
                            <p class="text text-md">Data File Kegiatan Harian :
                                <a href="../data_kegiatan_harian/<?php echo $pecah_kegiatan['upload_kegiatan_harian']; ?>" target="_blank"><?php echo $pecah_kegiatan['upload_kegiatan_harian']; ?></a>
                            </p>
                            <p class="text text-md">Data File Kegiatan Bulanan :
                                <a href="../data_kegiatan_bulanan/<?php echo $pecah_kegiatan['upload_kegiatan_bulanan']; ?>" target="_blank"><?php echo $pecah_kegiatan['upload_kegiatan_bulanan']; ?></a>
                            </p>
                            <p class="text text-md">Tgl Upload : <?php echo $pecah_kegiatan['tgl_upload']; ?></p><br>
                            <p class="text text-md">Detail Kegiatan Harian : </p>
                            <textarea class="form-control" name="" id="" cols="30" rows="7" readonly><?php echo $pecah_kegiatan['kegiatan_harian']; ?></textarea>
                            <p class="text text-md">Detail Kegiatan Bulanan : </p>
                            <textarea class="form-control" name="" id="" cols="30" rows="7" readonly><?php echo $pecah_kegiatan['kegiatan_bulanan']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- ./wrapper -->