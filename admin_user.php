<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pesanan - Admin GuruKu</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    min-height: 100vh;
    background: #f4f6fb;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 250px;
    background: linear-gradient(180deg, #667eea, #764ba2);
    color: #fff;
    padding: 30px 20px;
    position: fixed;
    height: 100vh;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 22px;
    font-weight: 700;
}

.sidebar a {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 14px 18px;
    margin-bottom: 12px;
    border-radius: 12px;
    transition: 0.3s;
    font-size: 14px;
}

.sidebar a:hover,
.sidebar a.active {
    background: rgba(255,255,255,0.25);
}

/* ===== CONTENT ===== */
.content {
    margin-left: 250px;
    padding: 30px;
    width: 100%;
}

.header h1 {
    color: #4b0082;
    margin-bottom: 6px;
}

.header p {
    color: #666;
    margin-bottom: 25px;
}

/* ===== CARD & TABLE ===== */
.card {
    background: #ffffff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    border-radius: 14px;
    overflow: hidden;
}

table th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    padding: 14px;
    font-size: 14px;
}

table td {
    padding: 14px;
    font-size: 14px;
    color: #333;
}

table tr:nth-child(even) {
    background: #f8f9ff;
}

table tr:hover {
    background: #eef1ff;
}

.badge {
    padding: 6px 14px;
    border-radius: 20px;
    background: #ede7ff;
    color: #5e35b1;
    font-size: 12px;
    font-weight: 600;
}

.tarif {
    font-weight: 700;
    color: #5e35b1;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>GuruKu Admin</h2>
 <a href="admin.php">🏠 Dashboard</a>
    <a href="admin_guru.php" class="active">👩‍🏫 Data Guru</a>
    <a href="admin_user.php">📋 Data Pesanan</a>
      <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">
        Logout
      </a>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="header">
        <h1>Data Pesanan Bimbingan</h1>
        <p>Daftar pesanan bimbingan yang masuk</p>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Nama</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Pengajar</th>
                <th>Tarif</th>
                <th>Jadwal</th>
            </tr>

            <?php
            $pesanan = mysqli_query($koneksi, "
                SELECT nama, no_hp, alamat, tanggal, jadwal, nama_guru, tarif
                FROM pemesanan
                ORDER BY tanggal DESC
            ");

            while ($p = mysqli_fetch_assoc($pesanan)) {
            ?>
            <tr>
                <td><?= $p['nama']; ?></td>
                <td><?= $p['no_hp']; ?></td>
                <td><?= $p['alamat']; ?></td>
                <td><?= $p['tanggal']; ?></td>
                <td><span class="badge"><?= $p['nama_guru']; ?></span></td>
                <td class="tarif">Rp <?= number_format($p['tarif'],0,',','.'); ?></td>
                <td><?= $p['jadwal']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
