<?php
session_start();
include '../koneksi/koneksi.php'; //memanggil koneksi.php.

if (isset($_SESSION['admin'])) { //Artinya ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    header("location: home2.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BPM | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../Template_Home/assets/img/bpm_unas.jpeg" rel="icon" type="img/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="admin/login.php"><b>LOGIN</b></a>
        </div>
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Selamat Datang Admin BPM</p>

                    <form action="" method="post" role="form">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="user" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="pass">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <?php
                        if (isset($_POST['login'])) //Jika ada yang login, maka. 
                        {
                            $username = mysqli_real_escape_string($konek, strip_tags($_POST["user"]));
                            $password = strip_tags($_POST["pass"]);

                            $ambil = $konek->query("SELECT * FROM admin WHERE email= '$username' AND password= md5('$password')"); //akan melalukan pencarian siapa yang login.
                            $cocok = $ambil->num_rows; //Artinya memasukan $ambil yaitu(yang mempunyai isi 
                            //query select pada pencarian di tabel admin untuk melakukan hak akses siapa 
                            //yang masuk) lalu Variable $ambil di masukan kedalam Variable $cocok untuk 
                            //melakukan pencarian lagi berdasarkan nilainya(hak aksesnya), dan num_rows; adalah 
                            //melakukan pencarian berdasarkan baris kolom pada tabel admin kita.
                            if ($cocok == 1) { //jika data yang kita masukan cocok ambil nilainya 1, artinya jika data kita cocok sebagai admin maka kita akan di alihkan ke dashboard admin dan tidak bisa masuk ke dashboard yang lainnya. jadi hanya mempunyai 1 hak akses saja.
                                $_SESSION['admin'] = $ambil->fetch_assoc();
                                $id_admin = $_SESSION["admin"]["id_admin"];
                                $jam = date("H:i:s", time() + 60 * 60 * 7);
                                //Jika status petugas aktif, maka diperbolehkan untuk akses.
                                if ($_SESSION['admin']['id_status'] == "1") {
                                    // Membuat system dapat mengenali level dari user(unit dari unas) yang masuk.
                                    $ambil_akses = $konek->query("SELECT level_user.level FROM admin 
                                    INNER JOIN level_user ON admin.id_level=level_user.id_level 
                                    WHERE admin.id_admin='$id_admin'");
                                    $pecah_akses = $ambil_akses->fetch_assoc();
                                    $level = $pecah_akses['level'];
                                    echo "<div class='alert alert-info'>Login Sukses</div>";
                                    echo "<script>alert('Selamat Datang Anda Masuk Sebagai " . $level . "')</script>";
                                    //Menampilkan notif sukses Login.
                                    $konek->query("UPDATE admin SET online='Sedang Aktif', jam='$jam' WHERE id_admin='$id_admin'");
                                    echo "<meta http-equiv='refresh' content='1;url=index'>";
                                    //Mengalihkan ke Dashboard Administrator(Halaman Admin).
                                } else {
                                    //Selain itu, artinya status petugas tidak aktif, maka tidak diperbolehkan untuk akses.
                                    //atau tidak memiliki hak akses manapun maka.
                                    echo "<div class='alert alert-danger'>Maaf, Anda sudah tidak diperbolehkan lagi.</div>";
                                    //Akan menampilkan notif Gagal Login.
                                    echo "<meta http-equiv='refresh' content='1;url=login'>"; //Dan akan di 
                                    //alihkan ke form login untuk memasukan data sesuai hak aksesnya.
                                    session_destroy();
                                }
                            } else { //Selain itu, artinya selain data yang kita masukan bukan sebagai admin, 
                                //atau tidak memiliki hak akses manapun maka.
                                echo "<div class='alert alert-danger'>Login Gagal</div>";
                                //Akan menampilkan notif Gagal Login.
                                echo "<meta http-equiv='refresh' content='1;url=login'>"; //Dan akan di 
                                //alihkan ke form login untuk memasukan data sesuai hak aksesnya.
                            }
                        }
                        ?>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/adminlte.min.js"></script>

</body>

</html>