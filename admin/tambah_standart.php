  <?php include('koneksi.php');
  if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: login');
    exit();
  }
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
              <h1>Tambah Standart</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Form Tambah Standart</li>
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
                  <h3 class="card-title">Form Tambah standart</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data">
                  <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                  <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                  <div class="card-body">
                    <div class="form-group">
                      <label>Keterangan Standart *</label>
                      <textarea name="keterangan" class="form-control" cols="30" rows="10"></textarea>
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
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-primary" name="simpan"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                  </div>
                </form>
                <?php
                //Jika ada tombol simpan(tombol simpan di tekan)
                if (isset($_POST["simpan"])) {
                  //Membuat Untuk Menyimpan file(Upload file).
                  $nama_file  = $_FILES["data_saya"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                  $folder     = "../data_standart/";
                  $tipe_vidio = $_FILES["data_saya"]["type"];
                  $size       = $_FILES["data_saya"]["size"]; //Membuat Size(Ukuran Maksimal).
                  $valid      = array('pdf', 'docx', 'doc', 'xlsx'); //Format FIle Yang Di Izinkan.

                  $keterangan = strip_tags($_POST["keterangan"]);
                  $tgl_upload = date("Y-m-d");
                  $id_user = $_SESSION['petugas']['id_user'];
                  $id_level = $_SESSION['petugas']['id_level'];

                  if (!empty($nama_file)) {
                    if (strlen($nama_file)) {
                      //Perintah untuk mengecek format file.
                      list($txt, $ext) = explode(".", $nama_file);
                      if (in_array($ext, $valid)) {
                        if ($size < (1024 * 1024 * 2)) {
                          $lokasi  = $_FILES["data_saya"]["tmp_name"]; //Mengambil foto.
                          if (move_uploaded_file($lokasi, $folder . $nama_file)) {
                            $konek->query("INSERT INTO tbl_standart(id_user, id_level, keterangan_standart, upload_standart, tgl_upload)
                            VALUES('$id_user','$id_level','$keterangan','$nama_file', '$tgl_upload')");

                            echo "<script>alert('SUKSES : Data Tersimpan');</script>";
                            echo "<meta http-equiv='refresh' content='1;url=index?halaman=data_standart'>";
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