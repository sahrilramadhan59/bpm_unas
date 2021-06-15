<?php
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
  header('location: ../login');
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
            <h1>Data Standart</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Data Standart</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data standart</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form action="index.php?halaman=hapus_standart" method="POST" enctype="multipart/form-data">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>No</th>
                      <th>Nama</th>
                      <th>UNIT</th>
                      <th>Tanggal</th>
                      <th>Data File</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Memanggil koneksi.php -->
                    <?php include "../koneksi/koneksi.php"; ?>
                    <?php include "enkripsi.php"; ?>
                    <?php
                    $id_user = $_SESSION['petugas']['id_user'];
                    $id_level = $_SESSION['petugas']['id_level'];

                    $ambil = $konek->query("SELECT * FROM tbl_standart 
                    INNER JOIN user ON tbl_standart.id_user=user.id_user 
                    INNER JOIN level_user ON tbl_standart.id_level=level_user.id_level
                    WHERE user.id_user='$id_user' AND user.id_level='$id_level'");
                    ?>
                    <?php $nomor = 1; ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                      <tr>
                        <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['id_standart']; ?>"></td>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama']; ?></td>
                        <td><?php echo $pecah['level']; ?></td>
                        <td><?php echo $pecah['tgl_upload']; ?></td>
                        <td>
                          <?php
                          $hapus_file_lama_saya = $pecah['upload_standart'];
                          if (!file_exists("../data_standart/$hapus_file_lama_saya")) { ?>
                            <p class="text-danger">Data File Tidak Di Temukan. Segera Perbarui.</p>
                          <?php } else { ?>
                            <a href="../data_standart/<?php echo $pecah['upload_standart']; ?>" target="_blank"><?php echo $pecah['upload_standart']; ?></a>
                          <?php } ?>
                        </td>
                        <td>
                          <center>
                            <a href="index?halaman=ubah_standart&id=<?php echo encrypt($pecah['id_standart']); ?>" class="btn btn-primary" title="Edit Data standart"><i class="fas fa-edit"> </i></a>
                          </center>
                        </td>
                        <td>
                          <center>
                            <a href="index?halaman=detail_standart&id=<?php echo encrypt($pecah['id_standart']); ?>" class="btn btn-warning" title="Detail Data standart"><i class="fas fa-search"> </i></a>
                          </center>
                        </td>
                      </tr>
                      <?php $nomor++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>
                        <center>
                          <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus Data Standart"><i class="fas fa-trash"></i></button>
                        </center>

                      </th>
                      <th>No</th>
                      <th>Nama</th>
                      <th>UNIT</th>
                      <th>Tanggal</th>
                      <th>Data File</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </form>
              <a href="cetak_standart" target=" _blank" data-toggle="modal" data-target="#cetakpdf" class="btn btn-primary"><i class="fas fa-print"></i> CETAK PDF</a>
              <?php include "modal_standart.php"; ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->