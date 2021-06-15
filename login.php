<?php
session_start();
require "koneksi/koneksi.php";
// Jika ada petugas yang login || jika petugas sudah login, 
if (!empty($_SESSION['petugas'])) {
    // maka jika petugas tersebut ingin keluar secara asal tanpa klik logout akan selalu di arah kan
    header("location: petugas/index.php");
    // atau di redirect ke dalam dashboar petugas.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BPM - Login</title>
    <!-- Favicons -->
    <link href="Template_Home/assets/img/bpm_unas.jpeg" rel="icon" type="img/png">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Template_Home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Template_Home/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="Template_Home/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="Template_Home/assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="Template_Home/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="Template_Home/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Template_Home/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include "menu.php"; ?>
    <!-- Navbar -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <header class="section-header">
                        <br><br><br>
                        <h3>LOGIN</h3>
                        <p>Silakan Masuk Dengan Hak Akses UPM Anda</p>
                    </header>

                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label><i class="fa fa-user"></i> Email</label>
                            <input type="email" name="email" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button class="btn btn-primary" name="login">LOGIN</button>
                    </form>
                    <?php
                    if (isset($_POST['login'])) //Jika ada yang login, maka. 
                    {
                        $username = mysqli_real_escape_string($konek, strip_tags($_POST["email"]));
                        $password = mysqli_real_escape_string($konek, strip_tags($_POST["password"]));
                        $ambil = $konek->query("SELECT * FROM user WHERE email= '$username' AND password= md5('$password')"); //akan melalukan pencarian siapa yang login.
                        $cocok = $ambil->num_rows; //Artinya memasukan $ambil yaitu(yang mempunyai isi 
                        //query select pada pencarian di tabel admin untuk melakukan hak akses siapa 
                        //yang masuk) lalu Variable $ambil di masukan kedalam Variable $cocok untuk 
                        //melakukan pencarian lagi berdasarkan nilainya(hak aksesnya), dan num_rows; adalah 
                        //melakukan pencarian berdasarkan baris kolom pada tabel admin kita.
                        if ($cocok == 1) { //jika data yang kita masukan cocok ambil nilainya 1, artinya jika data kita cocok sebagai admin maka kita akan di alihkan ke dashboard admin dan tidak bisa masuk ke dashboard yang lainnya. jadi hanya mempunyai 1 hak akses saja.
                            $_SESSION['petugas'] = $ambil->fetch_assoc();
                            $id_user = $_SESSION["petugas"]["id_user"];
                            $jam = date("H:i:s", time() + 60 * 60 * 7);
                            //Jika status petugas aktif, maka diperbolehkan untuk akses.
                            if ($_SESSION['petugas']['id_status'] == "1") {
                                // Membuat system dapat mengenali level dari user(unit dari unas) yang masuk.
                                $ambil_akses = $konek->query("SELECT level_user.level FROM user 
                                        INNER JOIN level_user ON user.id_level=level_user.id_level 
                                        WHERE user.id_user='$id_user'");
                                $pecah_akses = $ambil_akses->fetch_assoc();
                                $level = $pecah_akses['level'];
                                echo "<div class='alert alert-info'>Login Sukses</div>";
                                echo "<script>alert('Selamat Datang Anda Masuk Sebagai " . $level . "')</script>";
                                //Menampilkan notif sukses Login.
                                $konek->query("UPDATE user SET online='Sedang Aktif', jam='$jam' WHERE id_user='$id_user'");
                                echo "<meta http-equiv='refresh' content='1;url=petugas/index'>";
                                //Mengalihkan ke Dashboard Administrator(Halaman Admin).
                            } else {
                                //Selain itu, artinya status petugas tidak aktif, maka tidak diperbolehkan untuk akses.
                                //atau tidak memiliki hak akses manapun maka.
                                echo "<div class='alert alert-danger'>Maaf, Anda sudah tidak diperbolehkan lagi.</div>";
                                //Akan menampilkan notif Gagal Login.
                                echo "<meta http-equiv='refresh' content='1;url=login.php'>"; //Dan akan di 
                                //alihkan ke form login untuk memasukan data sesuai hak aksesnya.
                                session_destroy();
                            }
                        } else { //Selain itu, artinya selain data yang kita masukan bukan sebagai admin, 
                            //atau tidak memiliki hak akses manapun maka.
                            echo "<div class='alert alert-danger'>Login Gagal</div>";
                            //Akan menampilkan notif Gagal Login.
                            echo "<meta http-equiv='refresh' content='1;url=login.php'>"; //Dan akan di 
                            //alihkan ke form login untuk memasukan data sesuai hak aksesnya.
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section><!-- End F.A.Q Section -->

    <!-- Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="Template_Home/assets/vendor/jquery/jquery.min.js"></script>
    <script src="Template_Home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Template_Home/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="Template_Home/assets/vendor/php-email-form/validate.js"></script>
    <script src="Template_Home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="Template_Home/assets/vendor/counterup/counterup.min.js"></script>
    <script src="Template_Home/assets/vendor/venobox/venobox.min.js"></script>
    <script src="Template_Home/assets/vendor/mobile-nav/mobile-nav.js"></script>
    <script src="Template_Home/assets/vendor/wow/wow.min.js"></script>
    <script src="Template_Home/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="Template_Home/assets/vendor/waypoints/jquery.waypoints.min.js"></script>

    <!-- Template Main JS File -->
    <script src="Template_Home/assets/js/main.js"></script>

</body>

</html>