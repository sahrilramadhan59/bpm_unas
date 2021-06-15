<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
?>
<?php
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
$id_admin = decrypt(strip_tags($_GET["id"]));
$id_level = $_SESSION['admin']['id_level'];
$ambil = $konek->query("SELECT admin.id_admin, admin.nama_admin, admin.email FROM admin  
WHERE admin.id_admin='$id_admin' AND admin.id_level='$id_level'");
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
                        <h1>Edit Data Pribadi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Edit Data Pribadi</li>
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
                                <h3 class="card-title">Form Edit Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_admin']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $pecah['email']; ?>">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan Perubahan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                $nama_lengkap = strip_tags($_POST["nama"]);
                                $email = strip_tags($_POST["email"]);
                                $konek->query("UPDATE admin SET nama_admin='$nama_lengkap', email='$email' WHERE id_admin='$id_admin'");
                                echo "<script>alert('Terima Kasih, Data Profile Berhasil Di Perbarui.')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                // session_start(); //menyimpan data ke dalam session.
                                //Artinya : Saat query dijalankan dan kita sudah siap untuk melakukan ubah data, maka kita buka sessionnya untuk menyimpan pembaruan data kita, lalu saat
                                //itu juga kita ubah bersama session baru yang barusan disimpan(diperbarui datanya).
                                echo "<script>location='index?halaman=data_pribadi'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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