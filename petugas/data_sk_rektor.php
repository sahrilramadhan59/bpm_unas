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
                        <h1>Data Peraturan SK Rektor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Data Peraturan SK Rektor</li>
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
                            <h3 class="card-title">Data SK Rektor</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tampil_sk_rektor">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No SK</th>
                                        <th>Nama</th>
                                        <th>UNIT</th>
                                        <th>Tahun</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Memanggil koneksi.php -->
                                    <?php include "../koneksi/koneksi.php"; ?>
                                    <?php include "enkripsi.php"; ?>
                                    <?php
                                    $ambil = $konek->query("SELECT * FROM tbl_sk_rektor 
                                        INNER JOIN admin ON tbl_sk_rektor.id_admin=admin.id_admin 
                                        INNER JOIN level_user ON tbl_sk_rektor.id_level=level_user.id_level");
                                    ?>
                                    <?php $nomor = 1; ?>
                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo strip_tags($pecah['no_sk']); ?></td>
                                            <td><?php echo strip_tags($pecah['nama_admin']); ?></td>
                                            <td><?php echo strip_tags($pecah['level']); ?></td>
                                            <td><?php echo $pecah['tahun']; ?></td>
                                            <td>
                                                <center>
                                                    <a href="index?halaman=detail_sk_rektor&id=<?php echo encrypt($pecah['id_sk_rektor']); ?>&user=<?php echo encrypt($pecah['id_admin']); ?>" class="btn btn-warning" title="Detail Data Peraturan SK Rektor"><i class="fas fa-eye"> </i></a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>UNIT</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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