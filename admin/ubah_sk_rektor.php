<?php include('../koneksi/koneksi.php');
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
}
?>
<?php
include "enkripsi.php";
$id_sk_rektor = decrypt(strip_tags($_GET["id"]));
$id_admin = decrypt(strip_tags($_GET["user"]));

$ambil_standart = $konek->query("SELECT * FROM tbl_sk_rektor 
                                            INNER JOIN admin ON tbl_sk_rektor.id_admin=admin.id_admin
		                                    INNER JOIN level_user ON tbl_sk_rektor.id_level=level_user.id_level
                                            INNER JOIN status_user ON admin.id_status=status_user.id_status 
                                            WHERE tbl_sk_rektor.id_admin = '$id_admin' AND tbl_sk_rektor.id_sk_rektor='$id_sk_rektor'");
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
                        <h1>Ubah Data Peraturan SK Rektor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Ubah Data Peraturan SK Rektor</li>
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
                                <h3 class="card-title">Ubah Data Peraturan SK Rektor</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <?php $data_file = $pecah_standart['upload_sk_rektor']; ?>
                                    <?php if (!file_exists("../data_sk_rektor/$data_file")) { ?>
                                        <p class="text-danger">Data File Tidak Di Temukan. Segera Perbarui.</p>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload File *</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="upload_lagi" required>
                                                    <label class="custom-file-label" for="exampleInputFile">Maksimal File 2 MB dan File Harus Berformat (.pdf / .docx / xlsx / .doc)</label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <label>NO SK</label>
                                            <input type="text" name="no_sk" readonly class="form-control" value="<?php echo $pecah_standart['no_sk']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun *</label>
                                            <input type="text" name="tahun" class="form-control" value="<?php echo $pecah_standart['tahun']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tentang *</label>
                                            <textarea name="tentang" id="" cols="30" rows="10" class="form-control"><?php echo $pecah_standart['tentang'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload File *</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="data_saya">
                                                    <label class="custom-file-label" for="exampleInputFile">Maksimal File 2 MB dan File Harus Berformat (.pdf / .docx / xlsx / .doc)</label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            //Jika ada tombol simpan(tombol simpan di tekan)
                            if (isset($_POST["ubah"])) {
                                // Jika Nama File Yang Cocok Dalam Database Kehilangan File || FIle Hilang Dalam Folder 
                                // data_standart Dengan Nama Yang Cocok Dalam Database
                                if (!file_exists("../data_sk_rektor/$data_file")) {
                                    $nama_file2  = $_FILES["upload_lagi"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder2     = "../data_sk_rektor/";
                                    $tipe_vidio2 = $_FILES["upload_lagi"]["type"];
                                    $size2       = $_FILES["upload_lagi"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid2      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.
                                    $nama_file_hilang = $pecah_standart['upload_sk_rektor'];
                                    if (!empty($nama_file2 == $nama_file_hilang)) {
                                        if (strlen($nama_file2)) {
                                            //Perintah untuk mengecek format file.
                                            list($txt, $ext) = explode(".", $nama_file2);
                                            if (in_array($ext, $valid2)) {
                                                if ($size2 < (1024 * 1024 * 2)) {
                                                    $lokasi2  = $_FILES["upload_lagi"]["tmp_name"]; //Mengambil foto.
                                                    if (move_uploaded_file($lokasi2, $folder2 . $nama_file2)) {
                                                        echo "<script>alert('SUKSES : Data File Berhasil Di Perbarui');</script>";
                                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_sk_rektor'>";
                                                    } else {
                                                        echo "<script>alert('ERROR : Data Tidak Tersimpan');</script>";
                                                        echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                                    }
                                                } else {
                                                    echo "<script>alert('ERROR : File Maksimal 2MB');</script>";
                                                    echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                                }
                                            } else {
                                                echo "<script>alert('ERROR : Format File Tidak Valid, Format Harus(.pdf, .docx, .xlsx, .doc)');</script>";
                                                echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                            }
                                        }
                                    } else if (!empty($nama_file2 != $nama_file_hilang)) {
                                        echo "<script>alert('Warning : Data File Harus Sama Dengan Yang Dulu. Ini Nama File Kamu Yang Dulu (" . $nama_file_hilang . ")');</script>";
                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_sk_rektor'>";
                                    }
                                    exit(); // Mengentikan Script Sampai Disini.
                                } else {
                                    //Membuat Untuk Menyimpan file(Upload file).
                                    $nama_file  = $_FILES["data_saya"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder     = "../data_sk_rektor/";
                                    $tipe_vidio = $_FILES["data_saya"]["type"];
                                    $size       = $_FILES["data_saya"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.

                                    $no_sk = strip_tags($_POST["no_sk"]);
                                    $tahun = strip_tags($_POST["tahun"]);
                                    $tentang = strip_tags($_POST["tentang"]);

                                    $id_user = $_SESSION['admin']['id_admin'];
                                    $id_level = $_SESSION['admin']['id_level'];
                                    $hapus_file_lama_saya = $pecah_standart['upload_sk_rektor'];

                                    if (!empty($nama_file)) {
                                        if (strlen($nama_file)) {
                                            //Perintah untuk mengecek format file.
                                            list($txt, $ext) = explode(".", $nama_file);
                                            if (in_array($ext, $valid)) {
                                                if ($size < (1024 * 1024 * 2)) {
                                                    $lokasi  = $_FILES["data_saya"]["tmp_name"]; //Mengambil foto.
                                                    if (move_uploaded_file($lokasi, $folder . $nama_file)) {
                                                        if (file_exists("../data_sk_rektor/$hapus_file_lama_saya")) {
                                                            unlink("../data_sk_rektor/$hapus_file_lama_saya");
                                                        }

                                                        $konek->query("UPDATE tbl_sk_rektor SET no_sk='$no_sk', tahun='$tahun', tentang='$tentang',
                                                        upload_sk_rektor='$nama_file' WHERE id_sk_rektor='$id_sk_rektor' AND id_admin='$id_admin'");

                                                        echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_sk_rektor'>";
                                                    } else {
                                                        echo "<script>alert('ERROR : Data Tidak Tersimpan');</script>";
                                                        echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                                    }
                                                } else {
                                                    echo "<script>alert('ERROR : File Maksimal 2MB');</script>";
                                                    echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                                }
                                            } else {
                                                echo "<script>alert('ERROR : Format File Tidak Valid, Format Harus(.pdf, .docx, .xlsx, .doc)');</script>";
                                                echo "<script>location='index'</script>"; //Redirect(Melakukan) Kembali ke Halaman tambah_data
                                            }
                                        }
                                    } else {
                                        $konek->query("UPDATE tbl_sk_rektor SET no_sk='$no_sk', tahun='$tahun', tentang='$tentang'
                                        WHERE id_sk_rektor='$id_sk_rektor' AND id_admin='$id_admin'");

                                        echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_sk_rektor'>";
                                    }
                                }
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