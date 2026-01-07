<?php
session_start();


if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: Login.php"); 
    exit();
}

require "koneksi.php";

$idGuru = "";
$hargaGuru = "";


$nama    = $_SESSION['nama_user']; 
$no_hp   = isset($_POST['no_hp']) ? $_POST['no_hp'] : "";
$alamat  = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : "";

if (isset($_POST['pilih_guru']) && !empty($_POST['id_guru'])) {
    $idGuru = $_POST['id_guru'];
    $q = mysqli_query($koneksi, "SELECT harga_perjam FROM data_guru WHERE id_guru='$idGuru'");
    if ($data = mysqli_fetch_assoc($q)) {
        $hargaGuru = $data['harga_perjam'];
    }
}

$dataGuru = mysqli_query($koneksi, "SELECT * FROM data_guru");
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Les Privat</title>

<style>
/* RESET */
*{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

/* BODY */
body{
  font-family:'Poppins',sans-serif;
  background:#f3f4f6;
  display:flex;
  min-height:100vh;
}

/* ===== SIDEBAR (SAMA DENGAN YANG ATAS) ===== */
.sidebar{
  width:240px;
  background:linear-gradient(180deg,#667eea,#764ba2);
  color:#fff;
  padding:25px 20px;
}

.sidebar h2{
  text-align:center;
  margin-bottom:30px;
  font-size:24px;
  letter-spacing:1px;
}

.sidebar ul{
  list-style:none;
}

.sidebar ul li{
  margin:15px 0;
}

.sidebar ul li a{
  color:#fff;
  text-decoration:none;
  font-size:15px;
  font-weight:500;
  display:block;
  padding:8px 12px;
  border-radius:8px;
  transition:.3s;
}

.sidebar ul li a:hover{
  background:rgba(255,255,255,.2);
  padding-left:18px;
}

/* ===== CONTAINER ===== */
.container{
  flex:1;
  display:flex;
  justify-content:center;
  align-items:center;
  padding:30px;
}

/* FORM CARD */
form{
  background:#fff;
  width:420px;
  padding:30px;
  border-radius:18px;
  box-shadow:0 20px 40px rgba(0,0,0,.15);
  animation:fadeIn .5s ease;
}

form h2{
  text-align:center;
  margin-bottom:25px;
  color:#4b0082;
}

label{
  font-weight:500;
  color:#444;
}

input, textarea, select{
  width:100%;
  padding:12px;
  margin-top:6px;
  border-radius:10px;
  border:1px solid #ccc;
  outline:none;
  transition:.3s;
  font-size:14px;
}

input:focus, textarea:focus, select:focus{
  border-color:#764ba2;
  box-shadow:0 0 0 2px rgba(118,75,162,.2);
}

textarea{
  resize:none;
}

input[type="submit"]{
  margin-top:20px;
  background:linear-gradient(135deg,#667eea,#764ba2);
  color:#fff;
  border:none;
  font-size:15px;
  font-weight:600;
  cursor:pointer;
  transition:.3s;
}

input[type="submit"]:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 25px rgba(0,0,0,.2);
}

/* ANIMASI */
@keyframes fadeIn{
  from{
    opacity:0;
    transform:translateY(20px);
  }
  to{
    opacity:1;
    transform:translateY(0);
  }
}

/* RESPONSIVE */
@media(max-width:768px){
  .sidebar{
    display:none;
  }
  form{
    width:100%;
  }
}

.btn-cek,
.btn-kirim {
  width: 100%;
  padding: 12px;
  margin-top: 15px;
  border-radius: 10px;
  border: none;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: .3s;
}

.btn-cek {
  background: #e0e7ff;
  color: #4b0082;
}

.btn-cek:hover {
  background: #c7d2fe;
}

.btn-kirim {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
}

.btn-kirim:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0,0,0,.2);
}

.sidebar {
  min-height: 100vh;
  background: linear-gradient(180deg, #667eea, #764ba2);
}

form {
  border: 1px solid rgba(0,0,0,.05);
}

input[readonly] {
  background: #eef2ff;
  font-weight: 600;
  color: #333;
}

@media(max-width:768px){
  .container{
    padding:15px;
  }
}

</style>
</head>

<body>

<nav class="sidebar">
  <h2>GuruKu</h2>
  <ul>
    <li><a href="Guru.html">Beranda</a></li>
    <li><a href="Halaman2.html">Daftar Guru</a></li>
    <li><a href="Table.html">Informasi Jam Mengajar</a></li>
    <li><a href="FormSewaGuru.php">Daftar Les Privat</a></li>
    <li><a href="Pesanan.php">Lihat Pesanan</a></li>
    <li><a href="About Us.html">Tentang Kami</a></li>
    <li><a href="CS.html">Customer Service</a></li>
    <li><a href="Galeri.html">galeri</a></li>
    <li><a href="testimoni.html">testimoni</a></li>
    <li><a href="LoginGuru.php">Halaman Guru</a></li>
  </ul>
</nav>

<div class="container">
    <form method="POST">
        <h2>FORM PEMESANAN</h2>

        <label>Nama Pemesan:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" readonly style="background:#e9ecef; cursor:not-allowed;">

        <label>No HP:</label>
        <input type="tel" name="no_hp" value="<?= htmlspecialchars($no_hp) ?>" required placeholder="Contoh: 08123456789">

        <label>Alamat:</label>
        <textarea name="alamat" required placeholder="Alamat lengkap penjemputan/les"><?= htmlspecialchars($alamat) ?></textarea>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" value="<?= $tanggal ?>" required>

        <label>Pengajar:</label>
        <select name="id_guru" required>
            <option value="">-- Pilih Guru --</option>
            <?php 
            mysqli_data_seek($dataGuru, 0); 
            while ($g = mysqli_fetch_assoc($dataGuru)) { 
                $selected = ($g['id_guru'] == $idGuru) ? 'selected' : '';
                if ($selected) { $namaGuruTerpilih = $g['nama_guru']; }
            ?>
                <option value="<?= $g['id_guru']; ?>" <?= $selected ?>>
                    <?= $g['nama_guru']; ?>
                </option>
            <?php } ?>
        </select>

        <input type="hidden" name="nama_guru" value="<?= isset($namaGuruTerpilih) ? $namaGuruTerpilih : ''; ?>">

        <button type="submit" name="pilih_guru" class="btn-cek" formnovalidate>
            Klik untuk Cek Tarif
        </button>

        <label>Tarif Per Jam:</label>
        <input type="text" value="<?= ($hargaGuru != "") ? 'Rp '.number_format($hargaGuru,0,',','.') : ''; ?>" readonly style="background:#f9f9f9;">
        <input type="hidden" name="harga_perjam" value="<?= $hargaGuru ?>">

        <label>Jam Mulai:</label>
        <input type="time" name="jadwal" required>

        <button type="submit" name="kirim" class="btn-kirim" formaction="simpan.php">
            Kirim Pesanan Sekarang
        </button>
    </form>
</div>

</body>
</html>
