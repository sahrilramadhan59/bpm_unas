<?php include('../koneksi/koneksi.php');
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
                        <h1>Tambah UPM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Tambah UPM</li>
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
                                <h3 class="card-title">Form Tambah UPM</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-group" role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama *</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username *</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-inline">
                                        <label>Nomor: &nbsp;</label>
                                        <input type="text" name="nomor" class="form-control col-sm-1" readonly value="62">
                                        <input type="text" name="no_hp" class="form-control">
                                    </div><br>
                                    <div class="form-group">
                                        <label>Akses UNIT *</label>
                                        <select name="akses" class="form-control" required>
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM level_user");
                                            while ($pecah_level =  $ambil->fetch_assoc()) {
                                                if ($pecah_level['level'] == "BPM") {
                                                } else {
                                                    echo "<option value='" . $pecah_level['id_level'] . "'>" . $pecah_level['level'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
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

                                $nama = strip_tags($_POST["nama"]);
                                $username = strip_tags($_POST["username"]);
                                $email = strip_tags($_POST["email"]);
                                $pass = strip_tags($_POST["password"]);
                                $akses = strip_tags($_POST["akses"]);
                                $nomor = strip_tags($_POST["nomor"]);
                                $no_hp = strip_tags($_POST["no_hp"]);
                                $nomor_hp = $nomor . $no_hp; //Menggabungkan 2 String.

                                $jam = date("H:i:s", time() + 60 * 60 * 7);
                                $tgl_daftar = date("Y-m-d", strtotime('+1 days'));
                                $last_online = date("Y-m-d", strtotime('+1 days'));

                                //Mulai Melakukan Validasi Email.
                                $ambil_data_email = $konek->query("SELECT email FROM user WHERE email = '$email'");
                                $email_yang_cocok = $ambil_data_email->num_rows;

                                //Jika email yang Masukan sudah ada
                                if ($email_yang_cocok == 1) {
                                    echo "<script>alert('Email Yang Anda Masukan Sudah Terdaftar');</script>";
                                    echo "<script>location='index?halaman=tambah_upm';</script>";
                                }
                                //Selain Itu.
                                else {
                                    //Jika email belum ada yang terdaftar, maka kita lakukan query simpan.
                                    $konek->query("INSERT INTO user(nama, email, username, password,  id_status, id_level, tgl_daftar, last_online, jam, online, no_hp)
                                            VALUES('$nama', '$email', '$username', md5('$pass'),  '1', '$akses', '$tgl_daftar', '$last_online', '$jam', 'Tidak Aktif', '$nomor_hp')");

                                    echo "<div class='alert alert-info'>Data Tersimpan</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=data_upm'>";
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