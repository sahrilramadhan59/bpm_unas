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
                        <h1>Data Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">Data Kegiatan</li>
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
                            <h3 class="card-title">Tabel Data Kegiatan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="index.php?halaman=hapus_kegiatan" method="POST" enctype="multipart/form-data">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>UNIT</th>
                                            <th>Tanggal</th>
                                            <th>DATA FILE HARIAN</th>
                                            <th>DATA FILE BULANAN</th>
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
                                        $ambil = $konek->query("SELECT * FROM tb_kegiatan 
                                        INNER JOIN user ON tb_kegiatan.id_user=user.id_user 
                                        INNER JOIN level_user ON tb_kegiatan.id_level=level_user.id_level
                                        WHERE user.id_user='$id_user' AND user.id_level='$id_level'");
                                        ?>
                                        <?php $nomor = 1; ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['id_kegiatan']; ?>"></td>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo strip_tags($pecah['nama']); ?></td>
                                                <td><?php echo strip_tags($pecah['level']); ?></td>
                                                <td><?php echo $pecah['tgl_upload']; ?>
                                                <td>
                                                    <?php
                                                    $cek_file_lama_saya = $pecah['upload_kegiatan_harian'];
                                                    if (!file_exists("../data_kegiatan_harian/$cek_file_lama_saya")) { ?>
                                                        <p class="text-danger">Data File Tidak Di Temukan. Segera Perbarui.</p>
                                                    <?php } else { ?>
                                                        <a href="../data_kegiatan_harian/<?php echo $pecah['upload_kegiatan_harian']; ?>" target="_blank"><?php echo $pecah['upload_kegiatan_harian']; ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $cek_file_lama_saya2 = $pecah['upload_kegiatan_bulanan'];
                                                    if (!file_exists("../data_kegiatan_bulanan/$cek_file_lama_saya2")) { ?>
                                                        <p class="text-danger">Data File Tidak Di Temukan. Segera Perbarui.</p>
                                                    <?php } else { ?>
                                                        <a href="../data_kegiatan_bulanan/<?php echo $pecah['upload_kegiatan_bulanan']; ?>" target="_blank"><?php echo $pecah['upload_kegiatan_bulanan']; ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="index?halaman=ubah_kegiatan&id=<?php echo encrypt($pecah['id_kegiatan']); ?>" class="btn btn-primary" title="Edit Data Kegiatan"><i class="fas fa-edit"> </i></a>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="index?halaman=detail_kegiatan&id=<?php echo encrypt($pecah['id_kegiatan']); ?>" class="btn btn-warning" title="Detail Data Kegiatan"><i class="fas fa-search"> </i></a>
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
                                                    <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus Data Kegiatan"><i class="fas fa-trash"></i></button>
                                                </center>
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>UNIT</th>
                                            <th>Tanggal</th>
                                            <th>DATA FILE HARIAN</th>
                                            <th>DATA FILE BULANAN</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                            <a href="cetak_kegiatan" target=" _blank" data-toggle="modal" data-target="#cetakpdf" class="btn btn-primary"><i class="fas fa-print"></i> CETAK PDF</a>
                            <?php include "modal_kegiatan.php"; ?>
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