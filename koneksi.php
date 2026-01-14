<?php
// Aktifkan laporan error
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "sql109.infinityfree.com"; // Host Server
$username   = "if0_40846486";            // User
$password   = "bSbceAaaXpGRn";           // Password
$database   = "if0_40846486_les_privat"; // Nama Database

// PERHATIKAN: Nama variabel harus $koneksi
$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>