-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 Jun 2021 pada 07.26
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpm_unas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_status` int(10) NOT NULL,
  `id_level` int(50) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `last_online` date NOT NULL,
  `jam` time NOT NULL,
  `online` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `username`, `password`, `id_status`, `id_level`, `tgl_daftar`, `last_online`, `jam`, `online`) VALUES
(1, 'BADAN PENJAMINAN MUTU', 'bpm@gmail.com', 'admin', 'ab325e01dd894ea456db028c4d31450a', 1, 1, '2020-04-09', '2020-06-26', '10:35:25', 'Sedang Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_user`
--

CREATE TABLE `level_user` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level_user`
--

INSERT INTO `level_user` (`id_level`, `level`) VALUES
(1, 'BPM'),
(2, 'BAA'),
(3, 'BPSI'),
(4, 'SDM'),
(5, 'MHS'),
(6, 'BKIB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_user`
--

CREATE TABLE `status_user` (
  `id_status` int(20) NOT NULL,
  `status_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_user`
--

INSERT INTO `status_user` (`id_status`, `status_user`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pedoman`
--

CREATE TABLE `tbl_pedoman` (
  `id_pedoman` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_level` int(100) NOT NULL,
  `keterangan_pedoman` text NOT NULL,
  `upload_pedoman` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pedoman`
--

INSERT INTO `tbl_pedoman` (`id_pedoman`, `id_user`, `id_level`, `keterangan_pedoman`, `upload_pedoman`, `tgl_upload`) VALUES
(1, 2, 2, 'TEST PEDOMAN UNIT BAA', '2020-FTKI-SI-163112700650002-Syahril_Ramadhan_Sertifikat_3.pdf', '2020-05-13'),
(8, 2, 2, 'Pedoman BAA', 'Jurnal_dan_Ringkasan_Faqih.pdf', '2020-05-13'),
(9, 2, 2, 'Pedoman BAA', '94293-ID-none.pdf', '2020-05-13'),
(10, 2, 2, 'Pedoman BAA', '317-834-1-PB.pdf', '2020-05-13'),
(11, 2, 2, 'Pedoman BAA', '5302411196.pdf', '2020-05-13'),
(14, 2, 2, 'Pedoman BAA', 'sntsi.pdf', '2020-05-13'),
(16, 2, 2, 'Pedoman BAA', 'Endah_Ratnawati.doc', '2020-05-15'),
(17, 2, 2, 'Pedoman BAA', '173905-ID-pembuatan-sistem-informasi-penjualan-ber.pdf', '2020-05-15'),
(18, 2, 2, 'Pedoman BAA', 'Lina_Herlina.doc', '2020-05-15'),
(20, 2, 2, 'Pedoman BAA', 'Pedoman-Tugas-Akhir-FTKI.pdf', '2020-05-15'),
(24, 2, 2, 'Pedoman BAA', 'avi.pdf', '2020-05-15'),
(26, 5, 5, 'Pedoman Mahasiswa', '095328(1)(1)(1).pdf', '2020-05-15'),
(27, 5, 5, 'Pedoman Mahasiswa', '2518826(1)(1)(1).pdf', '2020-05-15'),
(28, 5, 5, 'Pedoman Mahasiswa', '7736619_SF(1)(1)(1).pdf', '2020-05-15'),
(29, 5, 5, 'Pedoman Mahasiswa', '79183710-KL(1)(1)(1).pdf', '2020-05-15'),
(30, 5, 5, 'Pedoman Mahasiswa', 'Document(1)(1)(1)(1).pdf', '2020-05-15'),
(31, 5, 5, 'Pedoman Mahasiswa', 'filee(1)(1)(1).pdf', '2020-05-20'),
(32, 5, 5, 'Pedoman Mahasiswa', 'mmm(1)(1)(1).pdf', '2020-05-20'),
(33, 5, 5, 'Pedoman Mahasiswa', 'test2(1)(1)(1)(1).docx', '2020-05-20'),
(34, 5, 5, 'Pedoman Mahasiswa', 'uub234(1)(1)(1).pdf', '2020-05-20'),
(35, 5, 5, 'Pedoman Mahasiswa', 'wps738(1)(1)(1).pdf', '2020-05-20'),
(36, 5, 5, 'Pedoman Mahasiswa', '095328(1)(1).pdf', '2020-05-20'),
(37, 5, 5, 'Pedoman Mahasiswa', '2518826(1)(1).pdf', '2020-05-20'),
(38, 5, 5, 'Pedoman Mahasiswa', 'Document.pdf', '2020-05-20'),
(39, 5, 5, 'Pedoman Mahasiswa', 'test2(2)(2).docx', '2020-05-20'),
(40, 5, 5, 'Pedoman Mahasiswa', 'test2(2)(3).docx', '2020-05-20'),
(42, 5, 5, 'Pedoman Mahasiswa', 'test2(2)(1)(2).docx', '2020-05-20'),
(43, 5, 5, 'Pedoman Mahasiswa', '79183710-KL(2).pdf', '2020-05-20'),
(44, 5, 5, 'Pedoman Mahasiswa', '9190-25560-1-SM.pdf', '2020-05-20'),
(45, 5, 5, 'Pedoman Mahasiswa', '105-206-1-SM.pdf', '2020-05-20'),
(46, 4, 6, 'Pedoman BKIB', 'no.docx', '2020-05-20'),
(47, 4, 6, 'Pedoman BKIB', 'ops.docx', '2020-05-20'),
(48, 4, 6, 'Pedoman BKIB', 'pqrs.docx', '2020-05-20'),
(49, 4, 6, 'Pedoman BKIB', 'kilss.docx', '2020-05-20'),
(50, 4, 6, 'Pedoman BKIB', 'KM67189.docx', '2020-05-20'),
(51, 4, 6, 'Pedoman BKIB', 'dummy.docx', '2020-05-21'),
(52, 4, 6, 'Pedoman BKIB', 'uub234(1)(1)(1).pdf', '2020-05-21'),
(53, 4, 6, 'Pedoman BKIB', '0188179-HN.docx', '2020-05-21'),
(54, 4, 6, 'Pedoman BKIB', '028819-NR.docx', '2020-05-21'),
(55, 4, 6, 'Pedoman BKIB', '036619-OP.docx', '2020-05-21'),
(56, 4, 6, 'Pedoman BKIB', '0718826-RT.docx', '2020-05-25'),
(57, 4, 6, 'Pedoman BKIB', '095328(1)(1)(1).pdf', '2020-05-25'),
(58, 4, 6, 'Pedoman BKIB', '2518826(1)(2).pdf', '2020-05-25'),
(60, 4, 6, 'Pedoman BKIB', '161-262-1-PB.doc', '2020-05-25'),
(61, 4, 6, 'Pedoman BKIB', '0188199-WE.docx', '2020-05-25'),
(62, 4, 6, 'Pedoman BKIB', 'test2(4)(1).docx', '2020-05-25'),
(63, 4, 6, 'Pedoman BKIB', '028819-NR.docx', '2020-05-25'),
(64, 4, 6, 'Pedoman BKIB', '0188179-HN.docx', '2020-05-25'),
(65, 4, 6, 'Pedoman BKIB', '036619-OP.docx', '2020-05-25'),
(66, 4, 6, 'Pedoman BKIB', '1605-4467-1-PB.pdf', '2020-05-13'),
(67, 3, 4, 'Pedoman SDM', 'KALENDAR-AKADEMIK-TA-20192020-1 (1).pdf', '2020-05-13'),
(68, 3, 4, 'Pedoman SDM', 'modul 3,4 dan 5 (1).pdf', '2020-05-13'),
(69, 3, 4, 'Pedoman SDM', 'pert1-Life-cycle.pdf', '2020-05-13'),
(70, 3, 4, 'Pedoman SDM', 'TUGAS 3 KB.docx', '2020-05-13'),
(71, 3, 4, 'Pedoman SDM', 'DEMO.pdf', '2020-05-13'),
(72, 3, 4, 'Pedoman SDM', 'cover demo.docx', '2020-05-13'),
(73, 3, 4, 'Pedoman SDM', 'COVER PROPOSAL.docx', '2020-05-13'),
(74, 3, 4, 'Pedoman SDM', 'Proposal.doc', '2020-05-13'),
(75, 3, 4, 'Pedoman SDM', 'Proposal.pdf', '2020-05-13'),
(76, 3, 4, 'Pedoman SDM', 'implementasi.doc', '2020-05-13'),
(77, 3, 4, 'Pedoman SDM', 'implementasi.pdf', '2020-05-13'),
(78, 3, 4, 'Pedoman SDM', 'implemnetasi cob=verr.docx', '2020-05-13'),
(79, 3, 4, 'Pedoman SDM', 'DAFTAR ISI & DATAR GAMBAR.docx', '2020-05-13'),
(80, 3, 4, 'Pedoman SDM', 'JUDUL.docx', '2020-05-13'),
(81, 3, 4, 'Pedoman SDM', 'KP.docx', '2020-05-13'),
(82, 3, 4, 'Pedoman SDM', 'PEMBAHASAN.docx', '2020-05-13'),
(83, 3, 4, 'Pedoman SDM', 'blueprint.docx', '2020-05-13'),
(84, 3, 4, 'Pedoman SDM', 'isi.docx', '2020-05-13'),
(85, 3, 4, 'Pedoman SDM', 'DAFTAR ISI & DATAR GAMBAR.docx', '2020-05-13'),
(86, 3, 4, 'Pedoman SDM', 'JUDUL.docx', '2020-05-13'),
(87, 2, 2, 'Data Peraturan Pedoman', 'MODUL 1 - Pendahuluan - Perancangan Web.pdf', '2020-06-05'),
(88, 2, 2, 'Data Pedoman', 'MULTIMEDIA.docx', '2020-06-06'),
(89, 2, 2, 'Data Pedoman', 'kisi kisi uas.docx', '2020-06-06'),
(90, 2, 2, 'Data Pedoman', 'Book1.xlsx', '2020-06-06'),
(91, 2, 2, 'Data Pedoman', 'kisi kisi uas.docx', '2020-06-06'),
(92, 2, 2, 'Data Pedoman', 'Data_pedoman.docx', '2020-06-06'),
(93, 2, 2, 'Data Pedoman', 'Data_pedoman.docx', '2020-06-06'),
(94, 2, 2, 'Data Pedoman', 'Data_pedoman.docx', '2020-06-06'),
(95, 2, 2, 'Data Pedoman', 'Data_pedoman.docx', '2020-06-06'),
(96, 4, 6, 'Data', 'Bimbingan Jurnal 1.doc', '2020-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sk_rektor`
--

CREATE TABLE `tbl_sk_rektor` (
  `id_sk_rektor` int(50) NOT NULL,
  `id_admin` int(50) NOT NULL,
  `id_level` int(10) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tentang` text NOT NULL,
  `upload_sk_rektor` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sk_rektor`
--

INSERT INTO `tbl_sk_rektor` (`id_sk_rektor`, `id_admin`, `id_level`, `no_sk`, `tahun`, `tentang`, `upload_sk_rektor`, `tgl_upload`) VALUES
(17, 1, 1, '438/H6/1/KEP/HK/2009', 2017, 'Integrasi Pengelolaan Pendidikan Pascasarjana dari Program Pascasarjana ke Fakultas di Lingkungan UNAS', 'BADAN PENJAMINAN MUTU UNIVERSITAS NASIONAL (5).pdf', '2020-05-26'),
(19, 1, 1, '438/H6/1/KEP/HQ/2010', 2010, 'Integrasi Pengelolaan Program Pascasarjana di Fakultas Lingkungan UNAS', 'data_sk_rektor.docx', '2020-06-07'),
(20, 1, 1, '438/H6/1/KEP/HK/2011', 2011, 'Integrasi Pengelolaan Pendidikan Pascasarjana di UNAS', 'data_sk_rektor.docx', '2020-06-07'),
(21, 1, 1, '323/SK/I1.A/KP/2013', 2013, 'Pemberhentian dan Pengangkatan para Ketua Program Studi UNAS', 'MODUL 1 - Pendahuluan - Perancangan Web.pdf', '2020-06-07'),
(22, 1, 1, '921/SK/I1.B03/KP/SK/2013', 2013, 'Tim Persiapan Pengisian Data  Dosen UNAS pada Sistem Informasi Pengembangan Karie Dosen (SIPKD) ', 'MODUL 2 - List atau daftar HTML - Perancangan Web.pdf', '2020-06-07'),
(23, 1, 1, '303/SK/I1.A/KP/2013', 2013, 'Pengangkatan Anggota Senat SAPPK UNAS Periode 2013-2018 (13-12-2013)', 'MODUL 3 - Images - Perancangan Web.pdf', '2020-06-07'),
(24, 1, 1, '269/SK/I1.A/KP/2013', 2013, 'Pengangkatan Ketua Kelompok Keahlian/Keilmuan (KK) SAPPK UNASPeriode 2013-2018 (29-11-2013)', 'MODUL 4 - Hyperlink - Perancangan Web.pdf', '2020-06-07'),
(25, 1, 1, '262/SK/I1.A/KP/2013', 2013, 'Susunan dan Jumlah Angota Senat Akademik dan Tatacara Pemilihan Anggota Senat Akademik untuk pertama kalinya (14-11-2013)', 'MODUL 5 - Table - Perancangan Web.pdf', '2020-06-07'),
(26, 1, 1, ' 438/H6/1/KEP/HK/2014', 2014, 'SK Dekan tentang Satuan Tugas Lomba Foto Karya Dosen Arsitektur SAPPK UNAS', 'MODUL 6 - Frame Atau Iframe - Perancangan Web.pdf', '2020-06-07'),
(27, 1, 1, '450/H6/1/KEP/HK/2008', 2008, 'SK Dekan tentang Tim Penilai Angka Kredit Dan Kinerja Sappk Tahun 2008 (Juli – Desember 2008)', 'Modul 8 - CSS - Perancangan Web.pdf', '2020-06-07'),
(28, 1, 1, '001A/SK/I1.B02/KP/2013', 2013, 'Tim Teknis Pemantau Pembangunan Fisik Kampus UNAS(2-1-2013)', 'MODUL 7 - Form - Perancangan Web.pdf', '2020-06-07'),
(29, 1, 1, '005/SK/I1.A/KP/2013', 2013, 'Tim Penilai Angka Kredit Jabatan/Pangkat Dosen UNASTahun 2013 (3-1-2013)', 'modul C#.pdf', '2020-06-07'),
(30, 1, 1, '006A/SK/I1.A/KP/2013', 2013, 'Tim Penilai Angka Kredit Jabatan/Pangkat Dosen UNAS Tahun 2013 (3-1-2013)', '005-SK-Rektor-tentang-Tim-Penilai-Angka-Kredit-Jabatan-Pangkat-Dosen-UNAS-2013-3-1-2013.pdf', '2020-06-07'),
(31, 1, 1, '02a/SK/I1.SA/OT/2013', 2013, 'Moratorium Pembukaan Program Studi Baru di ITB (25-1-2013)', '02a-SK-Senat-Akademik-tentang-Moratorium-Pembukaan-Program-Studi-Baru-di-ITB-25-1-2013.pdf', '2020-06-07'),
(32, 1, 1, '042/SK/I1.B05/KP/2013', 2013, 'Pembentukan Panitia Seminar dan Working Group Kajian Jembatan Selat Sunda ITB-UI-UGM-ITS-UNILA-UNTIRTA Banten (18-2-2013)', '042-SK-Rektor-tentang-Pembentukan-Panitia-Seminar-dan-Working-Group-Kajian-Jembatan-Selat-Sunda-ITB-UI-UGM-ITS-UNILA-UNTIRTA-Banten.pdf', '2020-06-07'),
(33, 1, 1, '485/I1.B03/KP/SK/2013', 2013, 'Kewenangan Menandatangani Surat Tugas di Lingkungan ITB (14-3-2013)', '485-SK-Rektor-tentang-Kewenangan-Menandatangani-Surat-Tugas-di-Lingkungan-ITB.pdf', '2020-06-07'),
(35, 1, 1, '168/H6/1/KEP/HK/ 2013', 2013, 'KEPUTUSAN REKTOR UNIVERSITAS NASIONAL', 'SOP-KONVERSI-MAHASIWA-PINDAHAN_compressed.pdf', '2020-06-07'),
(36, 1, 1, '208/H6/1/KEP/HK/2018', 2018, 'KEPUTUSAN REKOR UNIVERSITAS NASIONAL', 'KEPUTUSAN-DO-MAHASISWA-UNAS.pdf', '2020-06-07'),
(37, 1, 1, '17/H6/1/KEP/HK/2017', 2017, 'PERATURAN REKTOR UNIVERSITAS NASIONAL', 'SK-REKTOR-PERATURAN-AKADEMIK-UNIVERSITAS-NASIONAL.pdf', '2020-06-07'),
(38, 1, 1, '17/H6/1/KEP/HK/2017', 2017, 'PENYELENGGARAAN PERKULIAHAN SEMESTER ANTARA DI UNIVERSITAS NASIONAL', 'SK-SEMESTER-ANTARA-2-1.pdf', '2020-06-07'),
(39, 1, 1, '17/I17/KP/HK/2017', 2017, 'PERATURAN AKADEMIK DI LINGKUNGAN UNIVERSITAS DAN AKADEMI-AKADEMI NASIONAL', 'SK-REKTOR-PERATURAN-AKADEMIK-UNIVERSITAS-NASIONAL.pdf', '2020-06-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_standart`
--

CREATE TABLE `tbl_standart` (
  `id_standart` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_level` int(100) NOT NULL,
  `keterangan_standart` text NOT NULL,
  `upload_standart` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_standart`
--

INSERT INTO `tbl_standart` (`id_standart`, `id_user`, `id_level`, `keterangan_standart`, `upload_standart`, `tgl_upload`) VALUES
(10, 2, 2, 'Standart BAA', 'Panduan-SPMPPT-edisi-2011.pdf', '2020-05-05'),
(11, 2, 2, 'Standart BAA', 'pert1-Life-cycle.pdf', '2020-05-06'),
(14, 2, 2, 'Standart BAA', 'CetakKrsKpuResult.pdf', '2020-05-06'),
(15, 2, 2, 'Standart BAA', '08_Danny_Meirawan.pdf', '2020-05-06'),
(16, 2, 2, 'Standart BAA', 'Panduan-SPMPPT-edisi-2011.pdf', '2020-05-06'),
(17, 2, 2, 'Standart BAA', 'Penjaminan-Mutu-Penelitian-Pengabdian-dan-Tata-Kelola-Jurnal-Undip.pdf', '2020-05-06'),
(18, 2, 2, 'Standart BAA', '161-262-1-PB.doc', '2020-05-06'),
(19, 2, 2, 'Standart BAA', 'Endah_Ratnawati.doc', '2020-05-06'),
(20, 2, 2, 'Standart BAA', '9723-20827-1-SM.pdf', '2020-05-15'),
(21, 2, 2, 'Standart BAA', '237613-perancangan-sistem-informasi-badan-penja-4045c954.pdf', '2020-05-15'),
(23, 2, 2, 'Standart BAA', '329-1-1642-2-10-20181030.pdf', '2020-05-15'),
(24, 2, 2, 'Standart BAA', '161-262-1-PB.doc', '2020-05-15'),
(25, 2, 2, 'Standart BAA', '161-262-1-PB.pdf', '2020-05-15'),
(28, 2, 2, 'Standart BAA', '930-2090-1-PB.pdf', '2020-05-16'),
(31, 5, 5, 'Standart Mahasiswa', 'PEMBAHASAN.docx', '2020-05-16'),
(35, 5, 5, 'Standart Mahasiswa', 'tools.docx', '2020-05-16'),
(36, 5, 5, 'Standart Mahasiswa', 'tools.pdf', '2020-05-17'),
(39, 5, 5, 'Standart Mahasiswa', 'jurnal_13092.pdf', '2020-05-17'),
(42, 5, 5, 'Standart Mahasiswa', '161-262-1-PB.pdf', '2020-05-17'),
(43, 5, 5, 'Standart Mahasiswa', 'test2.docx', '2020-05-17'),
(45, 5, 5, 'Standart Mahasiswa', 'Naskah_Publikasi_Ilmiah.pdf', '2020-05-17'),
(48, 5, 5, 'Standart Mahasiswa', '8-Ghullam_Hamdu1.pdf', '2020-05-17'),
(49, 5, 5, 'Standart Mahasiswa', '3068-6628-1-SM.pdf', '2020-05-17'),
(50, 5, 5, 'Standart Mahasiswa', '249244-none-837c3dfb.pdf', '2020-05-17'),
(54, 4, 6, 'Standart BKIB', 'mmm(3).pdf', '2020-05-17'),
(56, 4, 6, 'Standart BKIB', 'test2(1)(1)(1)(1).docx', '2020-05-17'),
(57, 4, 6, 'Standart BKIB', 'test2(5).docx', '2020-05-17'),
(58, 4, 6, 'Standart BKIB', 'Lina_Herlina.doc', '2020-05-17'),
(59, 4, 6, 'Standart BKIB', 'RPL.docx', '2020-05-17'),
(60, 4, 6, 'Standart BKIB', '0188179-HN.docx', '2020-05-17'),
(61, 4, 6, 'Standart BKIB', '028819-NR.docx', '2020-05-20'),
(62, 4, 6, 'Standart BKIB', '036619-OP.docx', '2020-05-20'),
(63, 4, 6, 'Standart BKIB', '0718826-RT.docx', '2020-05-20'),
(64, 4, 6, 'Standart BKIB', '1783901-HJ.docx', '2020-05-20'),
(65, 4, 6, 'Standart BKIB', '188399-UI.docx', '2020-05-20'),
(66, 4, 6, 'Standart BKIB', 'Ass.docx', '2020-05-20'),
(67, 4, 6, 'Standart BKIB', 'Bm6281.docx', '2020-05-20'),
(68, 4, 6, 'Standart BKIB', 'folder.docx', '2020-05-20'),
(69, 4, 6, 'Standart BKIB', 'Hajjl.docx', '2020-05-20'),
(70, 4, 6, 'Standart BKIB', 'tugas.docx', '2020-05-20'),
(72, 2, 2, 'TEST SAYA SEBAGAI BAA', '2020-FTKI-SI-163112700650002-Syahril_Ramadhan_Krs.pdf', '2020-05-13'),
(73, 3, 4, 'Standart SDM', 'Certiport_Testing_Center_Registration _First_Steps_Tips.pdf', '2020-05-13'),
(74, 3, 4, 'Standart SDM', 'Pedoman-Tugas-Akhir-FTKI.pdf', '2020-05-13'),
(75, 3, 4, 'Standart SDM', 'KALENDAR-AKADEMIK-TA-20192020-1 (2).pdf', '2020-05-13'),
(76, 3, 4, 'Standart SDM', 'UAS-MPTI- GANJIL 2019-2020.doc', '2020-05-13'),
(77, 3, 4, 'Standart SDM', 'UAS-KB-GANJIL 2019-2020.doc', '2020-05-13'),
(78, 3, 4, 'Standart SDM', 'avi.pdf', '2020-05-13'),
(79, 3, 4, 'Standart SDM', 'JURNAL ANALISIS KEBUTUHAN SISTEM INFORMASI.pdf', '2020-05-13'),
(80, 3, 4, 'Standart SDM', 'SRS Dikti - Syahril_Ramadhan.doc', '2020-05-13'),
(81, 3, 4, 'Standart SDM', 'SPESIFIKASI_KEBUTUHAN_PERANGKAT-Aldo Rio.pdf', '2020-05-13'),
(82, 3, 4, 'Standart SDM', 'Spesifikasi_Kebutuhan_Perangkat_Lunak.pdf', '2020-05-13'),
(83, 3, 4, 'Standart SDM', 'materi minggu 11 (1).docx', '2020-05-13'),
(84, 3, 4, 'Standart SDM', 'SRS Dikti.doc', '2020-05-13'),
(85, 3, 4, 'Standart SDM', 'Template_SKPL.pdf', '2020-05-13'),
(86, 3, 4, 'Standart SDM', 'Modul Rekayasa Perangkat Lunak 3.pdf', '2020-05-13'),
(87, 3, 4, 'Standart SDM', 'Modul Rekayasa Perangkat Lunak 1.pdf', '2020-05-13'),
(88, 3, 4, 'Standart SDM', 'UTS_RPL_R03.doc', '2020-05-13'),
(89, 3, 4, 'Standart SDM', 'Contoh_TOR_Buat_SBK.pdf', '2020-05-13'),
(90, 3, 4, 'Standart SDM', '---profiskand-6312-1-kbsesi1.pdf', '2020-05-13'),
(91, 3, 4, 'Standart SDM', 'compvisi.pdf', '2020-05-13'),
(92, 3, 4, 'Standart SDM', 'compvisi.pdf', '2020-05-13'),
(93, 4, 6, 'Standart BKIB', 'yudi_eprints.pdf', '2020-05-14'),
(94, 2, 2, 'Data Standart SI', 'Data_standart.docx', '2020-06-05'),
(95, 2, 2, 'Data Standart SI', 'Data_standart.docx', '2020-06-05'),
(96, 2, 2, 'Data Standart Sastra', 'Data_standart.docx', '2020-06-05'),
(97, 2, 2, 'Data Standart Sastra', 'Data_standart.docx', '2020-06-05'),
(98, 2, 2, 'Data Standart Pertanian', 'Data_standart.docx', '2020-06-05'),
(99, 2, 2, 'Data Peraturan Standart', 'kisi kisi uas.docx', '2020-06-05'),
(100, 2, 2, 'Data Peraturan Standart', 'kisi kisi uas praktikum.docx', '2020-06-05'),
(101, 2, 2, 'Data Peraturan Standart', 'MATERI DASAR - DASAR PEMROGRAMAN I.pdf', '2020-06-05'),
(102, 2, 2, 'Data Peraturan Standart', 'Soal UTS AMP.pdf', '2020-06-05'),
(103, 2, 2, 'Data Peraturan Standart', 'Latihan Excel.docx', '2020-06-05'),
(104, 2, 2, 'Data Peraturan Standart', 'MULTIMEDIA.docx', '2020-06-05'),
(105, 2, 2, 'Data Peraturan Standart', 'Data_standart.docx', '2020-06-05'),
(106, 2, 2, 'Data Peraturan Standart', 'modul C#.pdf', '2020-06-05'),
(107, 2, 2, 'Data Peraturan Standart', 'MODUL 1 - Pendahuluan - Perancangan Web.pdf', '2020-06-05'),
(109, 2, 2, 'Data Standart Unit Baa Universitas Nasional', 'Data-Peraturan-Standar-Universitas-Nasional.pdf', '2020-06-07'),
(110, 4, 6, 'Data Standart', 'UTS_Sistem_Pendukung_Cerdas.docx', '2020-06-08'),
(111, 4, 6, 'data standart', 'UTS_Sistem_Pendukung_Cerdas.pdf', '2020-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_level` int(100) NOT NULL,
  `kegiatan_harian` text NOT NULL,
  `upload_kegiatan_harian` varchar(255) NOT NULL,
  `kegiatan_bulanan` text NOT NULL,
  `upload_kegiatan_bulanan` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `id_user`, `id_level`, `kegiatan_harian`, `upload_kegiatan_harian`, `kegiatan_bulanan`, `upload_kegiatan_bulanan`, `tgl_upload`) VALUES
(7, 2, 2, 'Kegiatan Harian', 'SRS Dikti - Syahril_Ramadhan.doc', 'Kegiatan Bulanan', 'SPESIFIKASI_KEBUTUHAN_PERANGKAT-Aldo Rio.pdf', '2020-05-26'),
(8, 2, 2, 'Kegiatan Harian', 'Spesifikasi_Kebutuhan_Perangkat_Lunak.pdf', 'Kegiatan Bulanan', 'materi minggu 11 (1).docx', '2020-05-26'),
(9, 2, 2, 'Kegiatan Harian', 'UTS-MPTI-INFORMATIKA-R.01.doc', 'Kegiatan Bulanan', 'SRS Dikti.doc', '2020-05-26'),
(10, 2, 2, 'Kegiatan Harian', 'Template_SKPL.pdf', 'Kegiatan Bulanan', 'Modul Rekayasa Perangkat Lunak 3.pdf', '2020-05-26'),
(11, 2, 2, 'Kegiatan Harian', 'UTS_RPL_R03.doc', 'Kegiatan Bulanan', 'Contoh_TOR_Buat_SBK.pdf', '2020-05-26'),
(12, 2, 2, 'Kegiatan Harian', 'Modul Rekayasa Perangkat Lunak 1.pdf', 'Kegiatan Bulanan', '---profiskand-6312-1-kbsesi1.pdf', '2020-05-26'),
(13, 2, 2, 'Kegiatan Harian', 'UTS-KB-SISTEM INFORMASI-R.02.doc', 'Kegiatan Bulanan', 'compvisi (1).pdf', '2020-05-26'),
(14, 2, 2, 'Kegiatan Harian', 'compvisi.pdf', 'Kegiatan Bulanan', 'KALENDAR-AKADEMIK-TA-20192020-1 (1).pdf', '2020-05-26'),
(15, 2, 2, 'Kegiatan Harian', 'NILAI-NILAI_RELIGIUS_DALAM_SYAIR_SHALAWAT_BURDAH.pdf', 'Kegiatan Bulanan', 'RPL.docx', '2020-05-26'),
(16, 2, 2, 'Kegiatan Harian', 'BAB_1_PENGANTAR PENGOLAHAN CITRA.pdf', 'Kegiatan Bulanan', 'Online 10.docx', '2020-05-26'),
(17, 2, 2, 'Kegiatan Harian', 'jurnal_13092.pdf', 'Kegiatan Bulanan', 'LINK KECERDASAN BUATAN.docx', '2020-05-26'),
(18, 2, 2, 'Kegiatan Harian', 'TUGAS 1 TOEFL.docx', 'Kegiatan Bulanan', 'DEMO.pdf', '2020-05-26'),
(19, 2, 2, 'Kegiatan Harian', 'cover demo.docx', 'Kegiatan Bulanan', 'COVER PROPOSAL.docx', '2020-05-26'),
(20, 2, 2, 'Kegiatan Harian', 'Proposal.doc', 'Kegiatan Bulanan', 'Proposal.pdf', '2020-05-26'),
(21, 2, 2, 'Kegiatan Harian', 'implementasi.doc', 'Kegiatan Bulanan', 'implementasi.pdf', '2020-05-26'),
(22, 2, 2, 'Kegiatan Harian', 'implemnetasi cob=verr.docx', 'Kegiatan Bulanan', 'blueprint.docx', '2020-05-26'),
(23, 2, 2, 'Kegiatan Bulanan', 'isi.docx', 'Kegiatan Bulanan', 'DAFTAR ISI & DATAR GAMBAR.docx', '2020-05-26'),
(24, 2, 2, 'Kegiatan Harian', 'JUDUL.docx', 'Kegiatan Bulanan', 'KP.docx', '2020-05-26'),
(25, 2, 2, 'Kegiatan Harian', 'PEMBAHASAN.docx', 'Kegiatan Bulanan', 'DAFTAR ISI & DATAR GAMBAR.docx', '2020-05-26'),
(26, 2, 2, 'Kegiatan Harian', 'JUDUL.docx', 'Kegiatan Bulanan', 'KP.docx', '2020-05-26'),
(27, 5, 5, 'Kegiatan Harian', 'Document(2)(3).pdf', 'Kegiatan Bulanan', '7736619_SF(1)(1).pdf', '2020-05-26'),
(28, 5, 5, 'Kegiatan Harian', '1605-4467-1-PB.pdf', 'Kegiatan Bulanan', 'BAB 3.pdf', '2020-05-26'),
(29, 5, 5, 'Kegiatan Harian', '704-1741-1-PB.pdf', 'Kegiatan Bulanan', '8654-Article Text-24873-1-10-20141224.pdf', '2020-05-26'),
(30, 5, 5, 'Kegiatan Harian', '9190-25560-1-SM.pdf', 'Kegiatan Bulanan', '105-206-1-SM.pdf', '2020-05-26'),
(31, 5, 5, 'Kegiatan Harian', '1605-3173-1-SM.pdf', 'Kegiatan Bulanan', 'Naskah_Publikasi_Ilmiah.pdf', '2020-05-26'),
(32, 5, 5, 'Kegiatan Harian', 'Jurnal Penelitian_07501241006.pdf', 'Kegiatan Bulanan', 'JURNAL PENELITIAN.pdf', '2020-05-31'),
(33, 5, 5, 'Kegiatan Harian', '8-Ghullam_Hamdu1.pdf', 'Kegiatan Bulanan', '3068-6628-1-SM.pdf', '2020-05-31'),
(34, 5, 5, 'Kegiatan Harian', '249244-none-837c3dfb.pdf', 'Kegiatan Bulanan', 'test.pdf', '2020-05-31'),
(35, 5, 5, 'Kegiatan Harian', '12855-39161-1-PB.pdf', 'Kegiatan Bulanan', 'sampul_VOL_4_NO1_2020.pdf', '2020-05-31'),
(36, 5, 5, 'Kegiatan Harian', 'CetakKrsKpuResult.pdf', 'Kegiatan Bulanan', '08_Danny_Meirawan.pdf', '2020-05-31'),
(37, 5, 5, 'Kegiatan Harian', 'Panduan-SPMPPT-edisi-2011.pdf', 'Kegiatan Bulanan', 'Penjaminan-Mutu-Penelitian-Pengabdian-dan-Tata-Kelola-Jurnal-Undip.pdf', '2020-05-31'),
(38, 5, 5, 'Kegiatan Harian', '329-1-1642-2-10-20181030.pdf', 'Kegiatan Bulanan', 'T1_672013129_Full text.pdf', '2020-05-31'),
(39, 5, 5, 'Kegiatan Harian', '237613-perancangan-sistem-informasi-badan-penja-4045c954.pdf', 'Kegiatan Bulanan', '9723-20827-1-SM.pdf', '2020-05-31'),
(40, 5, 5, 'Kegiatan Harian', 'Jurnal_dan_Ringkasan_Faqih.pdf', 'Kegiatan Bulanan', '161-262-1-PB.doc', '2020-05-31'),
(41, 5, 5, 'Kegiatan Harian', '161-262-1-PB.pdf', 'Kegiatan Bulanan', 'TUGAS PERTEMUAN 2.pdf', '2020-05-31'),
(42, 5, 5, 'Kegiatan Harian', 'RENCANA PEMBELAJARAN toefl lintas prodi.doc', 'Kegiatan Bulanan', '930-2090-1-PB.pdf', '2020-05-31'),
(43, 5, 5, 'Kegiatan Harian', 'COVER LA (1).pdf', 'Kegiatan Bulanan', '94293-ID-none.pdf', '2020-05-31'),
(44, 5, 5, 'Kegiatan Harian', 'filee.pdf', 'Kegiatan Bulanan', 'test2(5).docx', '2020-05-31'),
(45, 5, 5, 'Kegiatan Harian', '2518826(2)(1).pdf', 'Kegiatan Bulanan', 'Document(5).pdf', '2020-05-31'),
(46, 5, 5, 'Kegiatan Harian', 'test2(2)(1)(1)(1).docx', 'Kegiatan Bulanan', 'test2(5).docx', '2020-05-31'),
(47, 4, 6, 'Kegiatan Harian', 'BAB 3.pdf', 'Kegiatam Bulanan', '704-1741-1-PB.pdf', '2020-05-13'),
(48, 4, 6, 'Kegiatan Harian', '704-1741-1-PB.pdf', 'Kegiatan Bulanan', '105-206-1-SM.pdf', '2020-05-13'),
(49, 4, 6, 'Kegiatan Harian', 'Naskah_Publikasi_Ilmiah.pdf', 'Kegiatan Bulanan', 'Jurnal Penelitian_07501241006.pdf', '2020-05-13'),
(50, 4, 6, 'Kegiatan Harian', '8654-Article Text-24873-1-10-20141224.pdf', 'Kegiatan Bulanan', '9190-25560-1-SM.pdf', '2020-05-13'),
(51, 4, 6, 'Kegiatan Harian', '1605-3173-1-SM.pdf', 'Kegiatan Bulanan', '8-Ghullam_Hamdu1.pdf', '2020-05-13'),
(52, 4, 6, 'Kegiatan Harian', '3068-6628-1-SM.pdf', 'Kegiatan Bulanan', '249244-none-837c3dfb.pdf', '2020-05-13'),
(53, 4, 6, 'Kegiatan Harian', 'test.pdf', 'Kegiatan Bulanan', '12855-39161-1-PB.pdf', '2020-05-13'),
(54, 4, 6, 'Kegiatan Harian', 'sampul_VOL_4_NO1_2020.pdf', 'Kegiatan Bulanan', 'CetakKrsKpuResult.pdf', '2020-05-13'),
(55, 4, 6, 'Kegiatan Harian', '08_Danny_Meirawan.pdf', 'Kegiatan Bulanan', 'Panduan-SPMPPT-edisi-2011.pdf', '2020-05-13'),
(56, 4, 6, 'Kegiatan Harian', '329-1-1642-2-10-20181030.pdf', 'Kegiatan Bulanan', '237613-perancangan-sistem-informasi-badan-penja-4045c954.pdf', '2020-05-13'),
(57, 4, 6, 'Kegiatan Harian', '9723-20827-1-SM.pdf', 'Kegiatan Bulanan', 'Jurnal_dan_Ringkasan_Faqih.pdf', '2020-05-13'),
(58, 4, 6, 'Kegiatan Harian', '161-262-1-PB.doc', 'Kegiatan Bulanan', '161-262-1-PB.pdf', '2020-05-13'),
(59, 4, 6, 'Kegiatan Harian', 'TUGAS PERTEMUAN 2.pdf', 'Kegiatan Bulanan', 'RENCANA PEMBELAJARAN toefl lintas prodi.doc', '2020-05-13'),
(60, 4, 6, 'Kegiatan Harian', '930-2090-1-PB.pdf', 'Kegiatan Bulanan', 'COVER LA (1).pdf', '2020-05-13'),
(61, 4, 6, 'Kegiatan Harian', 'COVER LA.pdf', 'Kegiatan Bulanan', '94293-ID-none.pdf', '2020-05-13'),
(62, 4, 6, 'Kegiatan Harian', '317-834-1-PB.pdf', 'Kegiatan Bulanan', '5302411196.pdf', '2020-05-13'),
(63, 4, 6, 'Kegiatan Harian', 'bab 2.pdf', 'Kegiatan Bulanan', 'SKRIPSI WINA.pdf', '2020-05-13'),
(64, 4, 6, 'Kegiatan Harian', 'sntsi.pdf', 'Kegiatan Bulanan', 'Modul Web Programming II SI.pdf', '2020-05-13'),
(65, 4, 6, 'Kegiatan Harian', 'Endah_Ratnawati.doc', 'Kegiatan Bulanan', '173905-ID-pembuatan-sistem-informasi-penjualan-ber (1).pdf', '2020-05-13'),
(66, 4, 6, 'Kegiatan Harian', '173905-ID-pembuatan-sistem-informasi-penjualan-ber.pdf', 'Kegiatan Bulanan', 'Lina_Herlina.doc', '2020-05-13'),
(67, 3, 4, 'Kegiatan Harian', 'KP.docx', 'Kegiatan Bulanan', 'PEMBAHASAN.docx', '2020-05-13'),
(68, 3, 4, 'Kegiatan Harian', 'STUDY LITERARUR fix banget.pdf', 'Kegiatan Bulanan', 'cover study.docx', '2020-05-13'),
(69, 3, 4, 'Kegiatan Harian', 'cover tools.docx', 'Kegiatan Bulanan', 'tools.docx', '2020-05-13'),
(70, 3, 4, 'Kegiatan Harian', 'tools.pdf', 'Kegiatan Bulanan', 'TUGAS 3 KB.docx', '2020-05-13'),
(71, 3, 4, 'Kegiatan Harian', '0188179-HN.docx', 'Kegiatan Bulanan', '028819-NR.docx', '2020-05-13'),
(72, 3, 4, 'Kegiatan Harian', '036619-OP.docx', 'Kegiatan Bulanan', '0718826-RT.docx', '2020-05-13'),
(73, 3, 4, 'Kegiatan Harian', '095328(1)(1)(1).pdf', 'Kegiatan Bulanan', '095328(1)(2).pdf', '2020-05-13'),
(74, 3, 4, 'Kegiatan Harian', '095328(1)(2).pdf', 'Kegiatan Bulanan', '095328(3).pdf', '2020-05-13'),
(75, 3, 4, 'Kegiatan Harian', '1783901-HJ.docx', 'Kegiatan Bulanan', '188399-UI.docx', '2020-05-13'),
(76, 3, 4, 'Kegiatan Harian', '2518826(1)(1)(1).pdf', 'Kegiatan Bulanan', '2518826(1)(2).pdf', '2020-05-13'),
(77, 3, 4, 'Kegiatan Harian', '2518826(2)(1).pdf', 'Kegiatan Bulanan', '2518826(3).pdf', '2020-05-13'),
(78, 3, 4, 'Kegiatan Harian', '7736619_SF(1)(1)(1).pdf', 'Kegiatan Bulanan', '7736619_SF(1)(2).pdf', '2020-05-13'),
(79, 3, 4, 'Kegiatan Harian', '2518826(2)(1).pdf', 'Kegiatan Bulanan', '2518826(3).pdf', '2020-05-13'),
(80, 3, 4, 'Kegiatan Harian', '7736619_SF(1)(1)(1).pdf', 'Kegiatan Bulanan', '7736619_SF(1)(2).pdf', '2020-05-13'),
(81, 3, 4, 'Kegiatan Harian', '7736619_SF(2)(1).pdf', 'Kegiatan Harian', '7736619_SF(3).pdf', '2020-05-13'),
(82, 3, 4, 'Kegiatan Harian', '79183710-KL(1)(1)(1).pdf', 'Kegiatan Bulanan', 'Ass.docx', '2020-05-13'),
(83, 3, 4, 'Kegiatan Harian', 'Bm6281.docx', 'Kegiatan Bulanan', 'Document(1)(1)(1)(1).pdf', '2020-05-13'),
(84, 3, 4, 'Kegiatan Harian', 'filee(1)(1)(1).pdf', 'Kegiatan Bulanan', 'folder.docx', '2020-05-13'),
(85, 3, 4, 'Kegiatan Harian', 'Hajjl.docx', 'Kegiatan Bulanan', 'mmm(1)(1)(1).pdf', '2020-05-13'),
(86, 3, 4, 'Kegiatan Harian', '018819-IP.docx', 'Kegiatan Bulanan', '0188199-WE.docx', '2020-05-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_status` int(10) NOT NULL,
  `id_level` int(11) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `last_online` date NOT NULL,
  `jam` time NOT NULL,
  `online` varchar(20) NOT NULL,
  `no_hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `id_status`, `id_level`, `tgl_daftar`, `last_online`, `jam`, `online`, `no_hp`) VALUES
(2, 'BAA', 'baa@gmail.com', 'baa', '8cdcda79a8dc66aa6c711c9a000b0ac0', 1, 2, '2020-04-09', '2021-06-14', '22:09:03', 'Tidak Aktif', '6281310802774'),
(3, 'SDM', 'sdm@gmail.com', 'sdmunas', '3c197e18974f655184cde224c285b8aa', 1, 4, '2020-04-09', '2020-06-07', '21:35:10', 'Tidak Aktif', '6289660965892'),
(4, 'BKIB 1', 'bkib@gmail.com', 'BKIB', '990f124cb68e52edcb54797e89b2289a', 1, 6, '2020-04-09', '2020-06-08', '14:03:38', 'Tidak Aktif', '6289660965892'),
(5, 'MHS', 'mhs@gmail.com', 'MHS', '39f55dd65ead9c938fa93a765983bff0', 1, 5, '2020-04-09', '2020-06-05', '17:06:40', 'Tidak Aktif', '6289660965892');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_pedoman`
--
ALTER TABLE `tbl_pedoman`
  ADD PRIMARY KEY (`id_pedoman`);

--
-- Indexes for table `tbl_sk_rektor`
--
ALTER TABLE `tbl_sk_rektor`
  ADD PRIMARY KEY (`id_sk_rektor`);

--
-- Indexes for table `tbl_standart`
--
ALTER TABLE `tbl_standart`
  ADD PRIMARY KEY (`id_standart`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id_status` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_pedoman`
--
ALTER TABLE `tbl_pedoman`
  MODIFY `id_pedoman` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `tbl_sk_rektor`
--
ALTER TABLE `tbl_sk_rektor`
  MODIFY `id_sk_rektor` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tbl_standart`
--
ALTER TABLE `tbl_standart`
  MODIFY `id_standart` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
