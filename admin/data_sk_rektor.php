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
                        <h1>Data Peraturan SK Rektor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                            <h3 class="card-title">Tabel Data Peraturan SK Rektor</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="index.php?halaman=hapus_sk_rektor" method="POST" enctype="multipart/form-data">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No SK</th>
                                            <th>Tahun</th>
                                            <th>Tanggal Upload</th>
                                            <th>DATA FILE</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Memanggil koneksi.php -->
                                        <?php include "../koneksi/koneksi.php"; ?>
                                        <?php include "enkripsi.php"; ?>
                                        <?php
                                        $id_admin = $_SESSION['admin']['id_admin'];
                                        $id_level = $_SESSION['admin']['id_level'];

                                        $ambil = $konek->query("SELECT * FROM tbl_sk_rektor 
                                        INNER JOIN admin ON tbl_sk_rektor.id_admin=admin.id_admin 
                                        INNER JOIN level_user ON tbl_sk_rektor.id_level=level_user.id_level
                                        WHERE admin.id_admin='$id_admin' AND admin.id_level='$id_level'");
                                        ?>
                                        <?php $nomor = 1; ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['id_sk_rektor']; ?>"></td>
                                                <td><?php echo strip_tags($pecah['no_sk']); ?></td>
                                                <td><?php echo strip_tags($pecah['tahun']); ?></td>
                                                <td><?php echo $pecah['tgl_upload']; ?></td>
                                                <td>
                                                    <?php
                                                    $hapus_file_lama_saya = $pecah['upload_sk_rektor'];
                                                    if (!file_exists("../data_sk_rektor/$hapus_file_lama_saya")) { ?>
                                                        <p class="text-danger">Data File Tidak Di Temukan. Segera Perbarui.</p>
                                                    <?php } else { ?>
                                                        <a href="../data_sk_rektor/<?php echo $pecah['upload_sk_rektor']; ?>" target="_blank"><?php echo $pecah['upload_sk_rektor']; ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="index?halaman=detail_sk_rektor&id=<?php echo encrypt($pecah['id_sk_rektor']); ?>&user=<?php echo encrypt($pecah['id_admin']); ?>" class="btn btn-warning" title="Detail Data SK Rektor"><i class="fas fa-eye"> </i></a>
                                                    <a href="index?halaman=ubah_sk_rektor&id=<?php echo encrypt($pecah['id_sk_rektor']); ?>&user=<?php echo encrypt($pecah['id_admin']); ?>" class="btn btn-primary" title="Edit Data SK Rektor"><i class="fas fa-edit"> </i></a>
                                                </td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <center> <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus Data Pedoman"><i class="fas fa-trash"></i></button></center>
                                            </th>
                                            <th>No SK</th>
                                            <th>Tahun</th>
                                            <th>Tanggal Upload</th>
                                            <th>DATA FILE</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                            <a href="cetak_sk_rektor" target=" _blank" data-toggle="modal" data-target="#cetakpdf" class="btn btn-primary"><i class="fas fa-print"></i> CETAK PDF</a>
                            <?php include "modal_sk_rektor.php"; ?>
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