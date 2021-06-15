<header id="header">

    <div class="container">

        <div class="logo float-left">
            <!-- Uncomment below if you prefer to use an image logo -->
            <h1 class="text-light"><a href="index?#hero" class="scrollto"> <span><img src="Template_Home/assets/img/bpm_unas.jpeg" class="img-circle img-fluid"> BPM UNAS</span></a></h1>
            <!-- <a href="#header" class="scrollto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
        </div>

        <nav class="main-nav float-right d-none d-lg-block">
            <ul>
                <!-- Jika sudah login(ada session pelanggan) -->
                <?php if (isset($_SESSION["anggota"])) : ?>
                    <li class="drop-down"><a href=""><?php echo $_SESSION["anggota"]["nama_anggota"] ?></a>
                        <ul>
                            <li><a href="riwayat">Riwayat Peminjaman</a></li>
                            <li><a href="profil">Profil</a></li>
                            <li><a href="logout">Keluar</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <div id="topbar">
                        <div class="container">
                            <div class="social-links">
                                <a href="https://bit.ly/2WJah79" class="twitter"><i class="fa fa-youtube"></i></a>
                                <a href="https://bit.ly/2yJTWXU" class="facebook"><i class="fa fa-instagram"></i></a>
                                <a href="https://bit.ly/2YSLY9w" class="instagram"><i class="fab fa-twitter"></i></a>
                                <a href="https://bit.ly/3dCEdsf" class="linkedin"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header>