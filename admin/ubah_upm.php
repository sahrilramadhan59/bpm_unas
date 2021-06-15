<?php include('../koneksi/koneksi.php');
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
?>
<?php
include "enkripsi.php";
$id_user = decrypt(strip_tags($_GET["id"]));
$ambil_data = $konek->query("SELECT user.id_user, user.nama, user.id_status, status_user.status_user FROM user 
INNER JOIN status_user ON user.id_status=status_user.id_status WHERE user.id_user='$id_user'");
$pecah_user = $ambil_data->fetch_assoc();
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
                        <h1>Ubah Data UPM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Ubah Data UPM</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Data UPM</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Nama *</label>
                                        <input type="text" name="nama" value="<?php echo $pecah_user['nama']; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Status UPM *</label>
                                        <select name="status" class="form-control">
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM status_user");
                                            while ($pecah_status =  $ambil->fetch_assoc()) {
                                                if ($pecah_user['id_status'] == $pecah_status['id_status']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_status['id_status'] . "'>" . $pecah_status['status_user'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                $nama = strip_tags($_POST["nama"]);
                                $status = strip_tags($_POST["status"]);
                                $konek->query("UPDATE user SET id_status='$status', nama='$nama' WHERE id_user='$id_user'");

                                echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                                echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_upm'>";
                            }
                            ?>
                        </div>
                        <!-- /.card -->
                        <!-- Horizontal Form -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->