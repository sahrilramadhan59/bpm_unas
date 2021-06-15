<?php
include "../koneksi/koneksi.php";
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
  header('location: ../login');
  exit();
}
include "enkripsi.php";
?>
<?php
$id_user = strip_tags($_SESSION["petugas"]["id_user"]);
$id_level = strip_tags($_SESSION["petugas"]["id_level"]);
$ambil = $konek->query("SELECT user.id_user, user.nama, user.email, user.no_hp, status_user.status_user, level_user.level FROM user 
INNER JOIN status_user ON status_user.id_status=user.id_status 
INNER JOIN level_user ON level_user.id_level=user.id_level 
WHERE user.id_user='$id_user' AND user.id_level='$id_level'");
$pecah = $ambil->fetch_assoc();
?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Data Diri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profil Saya</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body box-profile">

                <h3 class="profile-username text-center"><?php echo $pecah['nama']; ?></h3>
                <p class="text-muted text-center">UPM UNIVERSITAS NASIONAL</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b class="text-primary"><i class="fas fa-check-circle"></i> Status</b> <a class="float-right"><?php echo $pecah['status_user']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b class="text-primary"><i class="fas fa-network-wired"></i> UNIT</b> <a class="float-right"><?php echo $pecah['level']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b class="text-primary"><i class="fas fa-mail-bulk"></i> Email</b> <a class="float-right"><?php echo $pecah['email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b class="text-primary"><i class="fas fa-phone-square-alt"></i> Nomor</b> <a class="float-right"><?php echo $pecah['no_hp']; ?></a>
                  </li>
                  <a href="index?halaman=edit_data_pribadi&id=<?php echo encrypt($pecah['id_user']); ?>" class="btn btn-success"><i class="fas fa-edit"> </i> Ubah Data</a>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->