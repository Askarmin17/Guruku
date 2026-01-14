<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: LoginGuru.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Halaman Guru</title>

<style>
* {
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  margin: 0;
  background: #f4f6fb;
  display: flex;
}

/* ===== SIDEBAR ===== */
.sidebar {
  width: 240px;
  background: linear-gradient(180deg, #667eea, #764ba2);
  min-height: 100vh;
  padding: 25px 20px;
  color: #fff;
}

.sidebar h2 {
  text-align: center;
  margin-bottom: 30px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li {
  margin-bottom: 15px;
}

.sidebar ul li a {
  display: block;
  padding: 12px 15px;
  border-radius: 12px;
  color: #fff;
  text-decoration: none;
  transition: .3s;
}

.sidebar ul li a:hover {
  background: rgba(255,255,255,.2);
  transform: translateX(5px);
}

/* ===== CONTENT ===== */
.container {
  flex: 1;
  margin: 30px;
  background: #fff;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 15px 35px rgba(0,0,0,.1);
}

.container h2 {
  color: #4b0082;
  margin-top: 0;
}

.container p {
  color: #555;
}

/* ===== CARD ===== */
.card-wrapper {
  margin-top: 25px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 20px;
}

.card {
  background: #fff;
  border-radius: 18px;
  padding: 22px;
  box-shadow: 0 12px 25px rgba(0,0,0,.1);
  transition: .3s;
  position: relative;
}

.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

.card h3 {
  margin: 0 0 10px;
  color: #4b0082;
  font-size: 18px;
}

.card p {
  margin: 6px 0;
  font-size: 14px;
  color: #444;
}

.card span {
  font-weight: 600;
  color: #667eea;
}

.badge {
  position: absolute;
  top: 15px;
  right: 15px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  padding: 5px 12px;
  border-radius: 12px;
  font-size: 12px;
}
</style>
</head>

<body>

<nav class="sidebar">
  <h2>GuruKu</h2>
  <ul>
    <li><a href="HalamanGuru.php">Jadwal Les</a></li>
     <li><a href="Profilguru.php">Profil</a></li>
    <li>
      <a href="Logout.php" onclick="return confirm('Yakin ingin logout?')">
        Logout
      </a>
    </li>
  </ul>
</nav>

<div class="container">
  <h2>Selamat Datang, <?php echo $_SESSION['nama_guru']; ?></h2>
  <p>Daftar siswa yang telah mendaftar les:</p>

  <div class="card-wrapper">
    <?php
    $nama_guru = $_SESSION['nama_guru'];

    $query = "SELECT * FROM pemesanan 
              WHERE nama_guru='$nama_guru'
              ORDER BY tanggal, jadwal";

    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='card'>
              <div class='badge'>Jadwal</div>
              <h3>{$row['nama']}</h3>
              <p><span>No HP:</span> {$row['no_hp']}</p>
              <p><span>Alamat:</span> {$row['alamat']}</p>
              <p><span>Jam Les:</span> {$row['jadwal']}</p>
            </div>
            ";
        }
    } else {
        echo "<p>Belum ada pesanan untuk Anda.</p>";
    }
    ?>
  </div>
</div>

</body>
</html>
