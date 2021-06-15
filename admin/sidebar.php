<?php
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    echo "<script>alert('Anda Harus Login !!!')</script>";
    echo "<script>location='login'</script>"; //mengalihkan secara paksa ke dalam form login untuk memastikan apakah yang login admin atau bukan. jika admin maka akan dialihkan ke dashboard administrator. dan jika bukan maka akan di alihkan ke form login untuk login kembali.
    exit();
}
?>
<?php
include('../koneksi/koneksi.php');
$id_admin = $_SESSION['admin']['id_admin'];
$ambil_akses_user = $konek->query("SELECT level_user.level FROM admin 
INNER JOIN level_user ON admin.id_level=level_user.id_level
WHERE admin.id_admin='$id_admin'");
$pecah_akses = $ambil_akses_user->fetch_assoc();
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="index" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    HOME
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Tambah Data
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index?halaman=tambah_sk_rektor" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah SK Rektor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=tambah_upm" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah UPM</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Data
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index?halaman=data_standart" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Standart</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=data_pedoman" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pedoman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=data_kegiatan" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Kegiatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=data_upm" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data UPM</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=data_sk_rektor" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data SK Rektor</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">Data Diri</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Data Pribadi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?halaman=data_pribadi" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index?halaman=kontak" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=ubah_password" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ubah Password</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>