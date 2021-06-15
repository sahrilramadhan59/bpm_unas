<?php
session_start(); //menyimpan data ke dalam session.
include '../koneksi/koneksi.php'; //memanggil koneksi.php.
?>
<?php
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    echo "<script>alert('Anda Harus Login !!!')</script>";
    echo "<script>location='login'</script>"; //mengalihkan secara paksa ke dalam form login untuk memastikan apakah yang login admin atau bukan. jika admin maka akan dialihkan ke dashboard administrator. dan jika bukan maka akan di alihkan ke form login untuk login kembali.
    exit();
}
// echo "<pre>";
// print_r($_SESSION['petugas']);
// echo "</pre>";
?>
<?php
$id_admin = $_SESSION["admin"]["id_admin"];
$detail_user = $konek->query("SELECT online, nama_admin FROM admin WHERE id_admin='$id_admin'");
$pecah = $detail_user->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>BPM UNAS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- FITUR CHATTING E-PERPUSTAKAAN -->
    <link href="../assets/dist/img/bpm_unas.jpeg" rel="icon" type="image/png">
    <!-- Summernote -->
    <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.css">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index?halaman=kontak" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php if ($pecah['online'] == "Sedang Aktif") { ?>
                    <p class=" text-info text-right"><?php echo $pecah["online"]; ?> &nbsp;&nbsp;&nbsp;</p>
                <?php } ?>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust btn-sm">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../assets/dist/img/bpm_unas.jpeg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">BPM UNAS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a class="d-block">UNIT <?php echo $pecah['nama_admin']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php include('sidebar.php'); ?>
                <!-- Sidebar Menu -->

                <?php
                if (isset($_GET['halaman'])) { //Jika mendapatkan nilai 'halaman.' proses. 
                    if ($_GET['halaman'] == "data_standart") { //jika mendapatkan dengan nilai 'halaman' sama dengan produk,
                        //pindahkan halaman ke pada halaman produk.
                        //memindahkan halaman ke halaman produk dari halaman index.
                        include 'data_standar.php';
                    } elseif ($_GET['halaman'] == 'detail_standart') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_standart.php';
                    } elseif ($_GET['halaman'] == 'hapus_standart') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_standart.php';
                    } elseif ($_GET['halaman'] == 'data_pedoman') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'data_pedoman.php';
                    } elseif ($_GET['halaman'] == 'detail_pedoman') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_pedoman.php';
                    } elseif ($_GET['halaman'] == 'hapus_pedoman') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_pedoman.php';
                    } elseif ($_GET['halaman'] == 'data_kegiatan') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'data_kegiatan.php';
                    } elseif ($_GET['halaman'] == 'detail_kegiatan') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_kegiatan.php';
                    } elseif ($_GET['halaman'] == 'hapus_kegiatan') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_kegiatan.php';
                    } elseif ($_GET['halaman'] == 'data_upm') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'data_upm.php';
                    } elseif ($_GET['halaman'] == 'tambah_upm') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'tambah_upm.php';
                    } elseif ($_GET['halaman'] == 'ubah_upm') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'ubah_upm.php';
                    } elseif ($_GET['halaman'] == 'hapus_upm') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_upm.php';
                    } elseif ($_GET['halaman'] == 'detail_upm') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_upm.php';
                    } elseif ($_GET['halaman'] == 'data_sk_rektor') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'data_sk_rektor.php';
                    } elseif ($_GET['halaman'] == 'tambah_sk_rektor') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'tambah_sk_rektor.php';
                    } elseif ($_GET['halaman'] == 'ubah_sk_rektor') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'ubah_sk_rektor.php';
                    } elseif ($_GET['halaman'] == 'hapus_sk_rektor') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_sk_rektor.php';
                    } elseif ($_GET['halaman'] == 'detail_sk_rektor') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_sk_rektor.php';
                    } elseif ($_GET['halaman'] == 'kontak') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'kontak.php';
                    } elseif ($_GET['halaman'] == 'profil_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'profil_petugas.php';
                    } elseif ($_GET['halaman'] == 'ubah_password') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_password.php';
                    } elseif ($_GET['halaman'] == 'chat') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'chat.php';
                    } elseif ($_GET['halaman'] == 'chart') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'chart.php';
                    } elseif ($_GET['halaman'] == 'pesan') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'pesan.php';
                    } elseif ($_GET['halaman'] == 'kotak_masuk') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'kotak_masuk.php';
                    } elseif ($_GET['halaman'] == 'hapus_chat') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_chat.php';
                    } elseif ($_GET['halaman'] == 'detail_pesan') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'detail_pesan.php';
                    } elseif ($_GET['halaman'] == 'data_pribadi') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'data_pribadi.php';
                    } elseif ($_GET['halaman'] == 'edit_data_pribadi') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'edit_data_pribadi.php';
                    } elseif ($_GET['halaman'] == 'logout') { //jika mendapatkan dengan nilai 'halaman' samadengan logout,
                        //pindahkan halaman ke pada halaman logout.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'logout.php';
                    }
                } else { //jika mendapatkan dengan nilai selain dari 'halaman',
                    //maka pindahkan ke pada halaman home.
                    //memindahkan halaman ke halaman ubah dari halaman index.
                    include 'home2.php';
                }
                ?>
                <!-- Isi Dashboard -->
                <?php include('footer.php'); ?>
                <!-- Isi Dashboard -->
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            <!-- jQuery -->
            <script src="../assets/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- DataTables -->
            <script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
            <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
            <!-- AdminLTE App -->
            <script src="../assets/dist/js/adminlte.min.js"></script>
            <!-- OPTIONAL SCRIPTS -->
            <script src="../assets/plugins/chart.js/Chart.min.js"></script>
            <!-- AREA DASHBOARD GRAFIK -->
            <script>
                $(function() {
                    'use strict'

                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }

                    var mode = 'index'
                    var intersect = true

                    var $salesChart = $('#sales-chart')
                    var salesChart = new Chart($salesChart, {
                        type: 'bar',
                        data: {
                            labels: [
                                'Komputer',
                                'Teknologi',
                                'Bahasa Dan Sastra',
                                'Pertanian',
                                'Kesehatan'
                            ],
                            datasets: [{
                                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef',
                                    '#3c8dbc', '#d2d6de'
                                ],
                                borderColor: '#007bff',
                                data: [<?php
                                        $Jumlah_Komputer = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Komputer'");
                                        echo mysqli_num_rows($Jumlah_Komputer); ?>,
                                    <?php
                                    $Jumlah_Teknologi = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Teknologi'");
                                    echo mysqli_num_rows($Jumlah_Teknologi); ?>,
                                    <?php
                                    $Jumlah_Bahasa = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Bahasa Dan Sastra'");
                                    echo mysqli_num_rows($Jumlah_Bahasa); ?>,
                                    <?php
                                    $Jumlah_Pertanian = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Pertanian'");
                                    echo mysqli_num_rows($Jumlah_Pertanian); ?>,
                                    <?php
                                    $Jumlah_Kesehatan = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Kesehatan'");
                                    echo mysqli_num_rows($Jumlah_Kesehatan); ?>
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,

                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            if (value >= 1000) {
                                                value /= 1000
                                                value += 'k'
                                            }
                                            return '' + value
                                        }
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })
                })
            </script>
            <!-- ChartJS -->
            <script src="../assets/chart.js/Chart.min.js"></script>
            <!-- page script -->
            <script>
                $(function() {
                    $("#example1").DataTable();
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                    });
                });
            </script>
            <!-- AREA GRAFIK DATA -->
            <script>
                $(function() {
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                    var donutData = {
                        labels: [
                            'Komputer',
                            'Teknologi',
                            'Bahasa Dan Sastra',
                            'Pertanian',
                            'Kesehatan'
                        ],
                        datasets: [{
                            data: [<?php
                                    $Jumlah_Komputer = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Komputer'");
                                    echo mysqli_num_rows($Jumlah_Komputer); ?>,
                                <?php
                                $Jumlah_Teknologi = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Teknologi'");
                                echo mysqli_num_rows($Jumlah_Teknologi); ?>,
                                <?php
                                $Jumlah_Bahasa = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Bahasa Dan Sastra'");
                                echo mysqli_num_rows($Jumlah_Bahasa); ?>,
                                <?php
                                $Jumlah_Pertanian = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Pertanian'");
                                echo mysqli_num_rows($Jumlah_Pertanian); ?>,
                                <?php
                                $Jumlah_Kesehatan = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Kesehatan'");
                                echo mysqli_num_rows($Jumlah_Kesehatan); ?>
                            ],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
                                '#d2d6de'
                            ],
                        }]
                    }
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var donutChart = new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    })
                })
            </script>
            <!-- ChartJS -->
            <!-- Summernote -->
            <script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
            <!-- Page Script -->
            <script>
                $(function() {
                    //Add text editor
                    $('#compose-textarea').summernote()
                })
            </script>
</body>

</html>