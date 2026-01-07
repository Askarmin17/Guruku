<?php
session_start();
require "koneksi.php";

$id = $_GET['id'];
$nama_login = $_SESSION['nama_user'];


$result = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id='$id' AND nama='$nama_login'");
$data = mysqli_fetch_assoc($result);

if (!$data) { header("Location: pesanan_saya.php"); exit; }


if (isset($_POST['update'])) {
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $jadwal = $_POST['jadwal'];

    $sql = "UPDATE pemesanan SET alamat='$alamat', tanggal='$tanggal', jadwal='$jadwal' WHERE id='$id'";
   if (mysqli_query($koneksi, $sql)) {
        
        header("Location: pesanan.php?status=update_berhasil");
        exit(); 
    } else {
       
        header("Location: edit_pemesanan.php?id=$id&status=gagal");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pemesanan</title>
    <style>
        body { font-family: sans-serif; background: #f8f9fa; padding: 50px; }
        .form-card { background: white; padding: 20px; max-width: 400px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #764ba2; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-card">
        <h2>Edit Pesanan</h2>
        <form method="POST">
            <label>Alamat:</label>
            <textarea name="alamat" required><?= $data['alamat'] ?></textarea>
            
            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required>
            
            <label>Jam:</label>
            <input type="time" name="jadwal" value="<?= $data['jadwal'] ?>" required>
            
            <button type="submit" name="update">Simpan Perubahan</button>
            <a href="pesanan.php" style="display:block; text-align:center; margin-top:10px; color:#666;">Batal</a>
        </form>
    </div>
</body>
</html>