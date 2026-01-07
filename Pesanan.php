<?php
session_start();
require "koneksi.php";



// Mengambil nama dari session untuk filter data
$nama_login = $_SESSION['nama_user'];

// Query mengambil data dari tabel 'pemesanan' berdasarkan kolom 'nama'
$q = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE nama='$nama_login' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan Saya</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; padding: 30px; }
        .container { max-width: 1000px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { color: #764ba2; border-bottom: 2px solid #764ba2; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #764ba2; color: white; }
        tr:hover { background: #f1f1f1; }
        .btn-back { display: inline-block; text-decoration: none; background: #6c757d; color: white; padding: 8px 15px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <a href="FormSewaGuru.php" class="btn-back">← Kembali ke Form</a>
    <h2>Riwayat Pemesanan</h2>
    <p>Akun: <strong><?= htmlspecialchars($nama_login) ?></strong></p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tarif</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if(mysqli_num_rows($q) > 0) {
                while($row = mysqli_fetch_assoc($q)) { 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_guru']); ?></td>
                <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                <td><?= $row['jadwal']; ?></td>
                <td>Rp <?= number_format($row['tarif'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td>
    <a href="edit_pemesanan.php?id=<?= $row['id']; ?>" style="color: blue; text-decoration: none;">Edit</a> | 
    <a href="hapus_pemesanan.php?id=<?= $row['id']; ?>" 
       style="color: red; text-decoration: none;" 
       onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
</td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>Anda belum memiliki riwayat pemesanan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>