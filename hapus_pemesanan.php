<?php
session_start();
require "koneksi.php";

if (isset($_GET['id']) && isset($_SESSION['nama_user'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $nama_login = $_SESSION['nama_user'];
 
    $query = "DELETE FROM pemesanan WHERE id='$id' AND nama='$nama_login'";
    
    if (mysqli_query($koneksi, $query)) {
       
        header("Location: pesanan.php?pesan=hapus_berhasil");
        exit();
    } else {
       
        header("Location: pesanan.php?pesan=gagal_hapus");
        exit();
    }
} else {
    
    header("Location: pesanan.php");
    exit();
}
?>