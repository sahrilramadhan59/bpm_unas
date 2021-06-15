<?php
if (!empty($_SESSION['petugas'])) {
    // maka jika petugas tersebut ingin keluar secara asal tanpa klik logout akan selalu di arah kan
    header("location: petugas/index");
    // atau di redirect ke dalam dashboar petugas.
} else {
    // maka jika petugas tersebut ingin keluar secara asal tanpa klik logout akan selalu di arah kan
    header("location: ../login");
    // atau di redirect ke dalam dashboar petugas.
}
