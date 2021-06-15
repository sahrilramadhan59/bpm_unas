<?php
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
                        <h1>Data UPM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data UPM</li>
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
                            <h3 class="card-title">Tabel Data UPM</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="index.php?halaman=hapus_upm" method="POST" enctype="multipart/form-data">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>UNIT</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Memanggil koneksi.php -->
                                        <?php include "../koneksi/koneksi.php"; ?>
                                        <?php include "enkripsi.php"; ?>
                                        <?php
                                        $ambil_data_user = $konek->query("SELECT user.id_user, user.nama, user.email, 
                                        user.username, level_user.level, user.tgl_daftar, status_user.status_user FROM user 
                                        INNER JOIN status_user ON user.id_status=status_user.id_status 
                                        INNER JOIN level_user ON user.id_level=level_user.id_level");
                                        ?>
                                        <?php $nomor = 1; ?>
                                        <?php while ($pecah_data = $ambil_data_user->fetch_assoc()) { ?>
                                            <?php if ($pecah_data['level'] == "admin") {
                                            } else { ?>
                                                <tr>
                                                    <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah_data['id_user']; ?>"></td>
                                                    <td><?php echo $nomor; ?></td>
                                                    <td><?php echo strip_tags($pecah_data['nama']); ?></td>
                                                    <td><?php echo strip_tags($pecah_data['level']); ?></td>
                                                    <td><?php echo $pecah_data['tgl_daftar']; ?></td>
                                                    <td>
                                                        <?php if ($pecah_data['status_user'] == "Tidak Aktif") { ?>
                                                            <p class="text-danger"><?php echo strip_tags($pecah_data['status_user']); ?></p>
                                                        <?php } else { ?>
                                                            <p class="text-primary"><?php echo strip_tags($pecah_data['status_user']); ?></p>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="index?halaman=ubah_upm&id=<?php echo encrypt($pecah_data['id_user']); ?>" class="btn btn-primary" title="Edit Data UPM"><i class="fas fa-edit"> </i></a>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="index?halaman=detail_upm&id=<?php echo encrypt($pecah_data['id_user']); ?>" class="btn btn-warning" title="Edit Data UPM"><i class="fas fa-eye"> </i></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php $nomor++; ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <center>
                                                    <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus Data UPM"><i class="fas fa-trash"></i></button>
                                                </center>
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>UNIT</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                            <a href="cetak_upm" target=" _blank" data-toggle="modal" data-target="#cetakpdf" class="btn btn-primary"><i class="fas fa-print"></i> CETAK PDF</a>
                            <?php include "modal_upm.php"; ?>
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