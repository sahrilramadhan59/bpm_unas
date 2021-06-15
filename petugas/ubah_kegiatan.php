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
$ambil_kegiatan = $konek->query("SELECT * FROM tb_kegiatan INNER JOIN user ON tb_kegiatan.id_user=user.id_user
		                                    INNER JOIN level_user ON tb_kegiatan.id_level=level_user.id_level 
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
                        <h1>Ubah Data Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Ubah Data Kegiatan</li>
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
                                <h3 class="card-title">Ubah Data Kegiatan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <?php $data_file = $pecah_kegiatan['upload_kegiatan_harian']; ?>
                                    <?php $data_file2 = $pecah_kegiatan['upload_kegiatan_bulanan']; ?>
                                    <?php if (!file_exists("../data_kegiatan_harian/$data_file")) { ?>
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
                                    <?php } else if (!file_exists("../data_kegiatan_bulanan/$data_file2")) { ?>
                                        <p class="text-danger">Data File 2 Tidak Di Temukan. Segera Perbarui.</p>
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
                                            <label>Keterangan Kegiatan Harian *</label>
                                            <textarea name="keterangan" id="" cols="30" rows="10" class="form-control" required><?php echo $pecah_kegiatan['kegiatan_harian'] ?></textarea>
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
                                        <div class="form-group">
                                            <label>Keterangan Kegiatan Bulanan *</label>
                                            <textarea name="keterangan2" id="" cols="30" rows="10" class="form-control" required><?php echo $pecah_kegiatan['kegiatan_bulanan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload File *</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="data_saya2">
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
                            if (isset($_POST["ubah"])) {
                                // Jika Nama File Yang Cocok Dalam Database Kehilangan File || FIle Hilang Dalam Folder 
                                // data_pedoman Dengan Nama Yang Cocok Dalam Database
                                if (!file_exists("../data_kegiatan_harian/$data_file")) {
                                    $nama_file2  = $_FILES["upload_lagi"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder2     = "../data_kegiatan_harian/";
                                    $tipe_vidio2 = $_FILES["upload_lagi"]["type"];
                                    $size2       = $_FILES["upload_lagi"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid2      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.
                                    $nama_file_hilang = $pecah_kegiatan['upload_kegiatan_harian'];

                                    if (!empty($nama_file2 == $nama_file_hilang)) {
                                        if (strlen($nama_file2)) {
                                            //Perintah untuk mengecek format file.
                                            list($txt, $ext) = explode(".", $nama_file2);
                                            if (in_array($ext, $valid2)) {
                                                if ($size2 < (1024 * 1024 * 2)) {
                                                    $lokasi2  = $_FILES["upload_lagi"]["tmp_name"]; //Mengambil foto.
                                                    if (move_uploaded_file($lokasi2, $folder2 . $nama_file2)) {
                                                        echo "<script>alert('SUKSES : Data File Berhasil Di Perbarui');</script>";
                                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
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
                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
                                    }
                                    exit(); // Mengentikan Script Sampai Disini.
                                } elseif (!file_exists("../data_kegiatan_bulanan/$data_file2")) {
                                    $nama_file2  = $_FILES["upload_lagi"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder2     = "../data_kegiatan_bulanan/";
                                    $tipe_vidio2 = $_FILES["upload_lagi"]["type"];
                                    $size2       = $_FILES["upload_lagi"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid2      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.
                                    $nama_file_hilang = $pecah_kegiatan['upload_kegiatan_bulanan'];

                                    if (!empty($nama_file2 == $nama_file_hilang)) {
                                        if (strlen($nama_file2)) {
                                            //Perintah untuk mengecek format file.
                                            list($txt, $ext) = explode(".", $nama_file2);
                                            if (in_array($ext, $valid2)) {
                                                if ($size2 < (1024 * 1024 * 2)) {
                                                    $lokasi2  = $_FILES["upload_lagi"]["tmp_name"]; //Mengambil foto.
                                                    if (move_uploaded_file($lokasi2, $folder2 . $nama_file2)) {
                                                        echo "<script>alert('SUKSES : Data File Berhasil Di Perbarui');</script>";
                                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
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
                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
                                    }
                                    exit(); // Mengentikan Script Sampai Disini.
                                } else {
                                    //Membuat Untuk Menyimpan file(Upload file).
                                    $nama_file  = $_FILES["data_saya"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder     = "../data_kegiatan_harian/";
                                    $tipe_vidio = $_FILES["data_saya"]["type"];
                                    $size       = $_FILES["data_saya"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.

                                    //Membuat Untuk Menyimpan file(Upload file).
                                    $nama_file22  = $_FILES["data_saya2"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                    $folder22     = "../data_kegiatan_bulanan/";
                                    $tipe_vidio22 = $_FILES["data_saya2"]["type"];
                                    $size22       = $_FILES["data_saya2"]["size"]; //Membuat Size(Ukuran Maksimal).
                                    $valid22      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.

                                    $keterangan = strip_tags($_POST["keterangan"]);
                                    $keterangan22 = strip_tags($_POST["keterangan2"]);

                                    $id_user = $_SESSION['petugas']['id_user'];
                                    $id_level = $_SESSION['petugas']['id_level'];
                                    $hapus_file_lama_saya = $pecah_kegiatan['upload_kegiatan_harian'];
                                    $hapus_file_lama_saya2 = $pecah_kegiatan['upload_kegiatan_bulanan'];

                                    if (!empty($nama_file) && !empty($nama_file22)) {
                                        if (strlen($nama_file && $nama_file22)) {
                                            //Perintah untuk mengecek format file.
                                            list($txt, $ext) = explode(".", $nama_file);
                                            list($txt, $ext) = explode(".", $nama_file22);
                                            if (in_array($ext, $valid) && in_array($ext, $valid22)) {
                                                if ($size && $size22 < (1024 * 1024 * 2)) {
                                                    $lokasi  = $_FILES["data_saya"]["tmp_name"]; //Mengambil foto.
                                                    $lokasi22  = $_FILES["data_saya2"]["tmp_name"]; //Mengambil foto.
                                                    if (move_uploaded_file($lokasi, $folder . $nama_file) && move_uploaded_file($lokasi22, $folder22 . $nama_file22)) {
                                                        if (file_exists("../data_kegiatan_harian/$hapus_file_lama_saya") && file_exists("../data_kegiatan_bulanan/$hapus_file_lama_saya2")) {
                                                            unlink("../data_kegiatan_harian/$hapus_file_lama_saya");
                                                            unlink("../data_kegiatan_bulanan/$hapus_file_lama_saya2");
                                                        }

                                                        $konek->query("UPDATE tb_kegiatan SET kegiatan_harian='$keterangan', kegiatan_bulanan='$keterangan22', upload_kegiatan_harian='$nama_file', upload_kegiatan_bulanan='$nama_file22' 
                                                        WHERE id_kegiatan='$id_kegiatan' AND id_user='$id_user'");

                                                        echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
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
                                        $konek->query("UPDATE tb_kegiatan SET kegiatan_harian='$keterangan', kegiatan_bulanan='$keterangan22' WHERE id_kegiatan='$id_kegiatan' AND id_user='$id_user'");

                                        echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                                        echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_kegiatan'>";
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