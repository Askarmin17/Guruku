<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Home Admin - GuruKu</title>

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

.header {
    margin-bottom: 30px;
}

.header h1 {
    color: #4b0082;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.card h3 {
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}

.card p {
    font-size: 32px;
    font-weight: 700;
    color: #5e35b1;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>GuruKu Admin</h2>
 <a href="Admin.php">🏠 Dashboard</a>
    <a href="AdminGuru.php" class="active">👩‍🏫 Data Guru</a>
    <a href="AdminUser.php">📋 Data Pesanan</a>
      <a href="Logout.php" onclick="return confirm('Yakin ingin logout?')">
        Logout
      </a>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="header">
        <h1>Dashboard Admin</h1>
        <p>Ringkasan data GuruKu</p>
    </div>

    <div class="cards">
        <?php
        $guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM data_guru"));
        $pesanan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan"));
        ?>
        <div class="card">
            <h3>Total Guru</h3>
            <p><?= $guru; ?></p>
        </div>

        <div class="card">
            <h3>Total Pesanan</h3>
            <p><?= $pesanan; ?></p>
        </div>
    </div>
</div>

</body>
</html>