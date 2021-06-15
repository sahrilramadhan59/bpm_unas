<!-- Content Wrapper. Contains page content -->
<?php
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header('location: ../login');
    exit();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 col-sm-6 col-md-6 col-xs-2 col-lg-6">
                    <h1>Kontak Profil Petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active">Kontak Profil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    <?php
                    include('../koneksi/koneksi.php');
                    include('enkripsi.php');
                    $id_petugas_saya = $_SESSION["petugas"]["id_user"];
                    $ambil = $konek->query("SELECT * FROM user 
                    INNER JOIN level_user ON user.id_level=level_user.id_level
                    INNER JOIN status_user ON user.id_status=status_user.id_status");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                        <?php if ($pecah["id_user"] != $id_petugas_saya) {  ?>
                            <div class="col-12 col-sm-6 col-md-6 col-xs-6 col-lg-3">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        UPM UNAS
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                                                <h2 class="lead"><b><?php echo $pecah['nama']; ?></b></h2>
                                                <p class="text-muted text-sm"><b>Unit: </b>
                                                    <?php echo $pecah['level']; ?> </p>
                                                <p class="text-muted text-sm"><b>Status: </b>
                                                    <?php echo $pecah['status_user']; ?> </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone :
                                                        <?php echo $pecah['no_hp']; ?></li>
                                                    <?php if ($pecah['online'] == "Sedang Aktif") { ?>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-eye"></i></span>
                                                            <p class="text-info"><?php echo $pecah['online']; ?></p>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-eye"></i></span> Terakhir Dilihat : <br>
                                                            <p class=" text-danger"> <?php echo $pecah['jam']; ?></p>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <?php
                                            if ($pecah['id_status'] == "1") { ?>
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo $pecah['no_hp']; ?> &text=Hai%20<?php echo $pecah['nama']; ?>">Hubungi
                                                    Saya <i class="fab fa-whatsapp"></i></a>
                                            <?php } else { ?>
                                                <!-- <p class="text-danger"><i class="fas fa-user"></i> UPM Tidak Aktif</p> -->
                                                <a class="text-danger"><i class="fas fa-user"></i> UPM Tidak Aktif</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer"> -->

                    <!-- /.card-footer -->
                    <!-- </div> -->
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->