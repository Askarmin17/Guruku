<?php
require "koneksi.php";

if (isset($_POST['kirim'])) {


    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp        = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat       = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $tanggal      = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $nama_guru    = mysqli_real_escape_string($koneksi, $_POST['nama_guru']); 
    $jadwal       = mysqli_real_escape_string($koneksi, $_POST['jadwal']);
    $harga_perjam = mysqli_real_escape_string($koneksi, $_POST['harga_perjam']); 

    
    $query = "INSERT INTO pemesanan 
              (nama, no_hp, alamat, tanggal, nama_guru, jadwal, tarif) 
              VALUES
              ('$nama', '$no_hp', '$alamat', '$tanggal', '$nama_guru', '$jadwal', '$harga_perjam')";

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        $id = mysqli_insert_id($koneksi);
        header("Location: detail.php?id=$id");
        exit;
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>