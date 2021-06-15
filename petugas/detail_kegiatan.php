<?php
include('../koneksi/koneksi.php');
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: ../login');
    exit();
}
?>
<?php
include "enkripsi.php";
$id_kegiatan = decrypt(strip_tags($_GET["id"]));
$id_user = $_SESSION['petugas']['id_user'];
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
                    <div class="col-sm-12">
                        <h3 class="my-3 text-cyan">Data Kegiatan</h5>
                            <p class="text text-md">
                                <i class="fa fa-user"></i> Di Upload Oleh : <?php echo $pecah_kegiatan['nama']; ?>
                            </p>
                            <p class="text text-md">
                                <i class="fa fa-network-wired"></i> Unit : <?php echo $pecah_kegiatan['level']; ?>
                            </p>
                            <hr>
                            <p class="text text-md">
                                <i class="fa fa-file"></i> File Kegiatan Harian :
                                <a href="../data_kegiatan_harian/<?php echo $pecah_kegiatan['upload_kegiatan_harian']; ?>" target="_blank"><?php echo $pecah_kegiatan['upload_kegiatan_harian']; ?></a>
                            </p>
                            <p class="text text-md">
                                <i class="fa fa-file"></i> File Kegiatan Bulanan :
                                <a href="../data_kegiatan_bulanan/<?php echo $pecah_kegiatan['upload_kegiatan_bulanan']; ?>" target="_blank"><?php echo $pecah_kegiatan['upload_kegiatan_bulanan']; ?></a>
                            </p>
                            <p class="text text-md">
                                <i class="fa fa-calendar"></i> Di Upload : <b><?php echo $pecah_kegiatan['tgl_upload']; ?></b>
                            </p>
                            <br>

                            <p class="text text-md"><i class="fa fa-search"></i> Detail Kegiatan Harian : </p>
                            <textarea class="form-control" name="" id="" cols="30" rows="7" readonly><?php echo $pecah_kegiatan['kegiatan_harian']; ?></textarea>
                            <p class="text text-md"><i class="fa fa-search"></i> Detail Kegiatan Bulanan : </p>
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