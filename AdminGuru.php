<?php
include "koneksi.php";

// ================== PROSES CRUD ==================

// tambah data
if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_guru'];
    $mapel  = $_POST['mata_pelajaran'];
    $harga  = $_POST['harga_perjam'];

    mysqli_query($koneksi, "INSERT INTO data_guru VALUES (NULL,'$nama','$mapel','$harga')");
    header("Location: AdminGuru.php");
}

// hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM data_guru WHERE id_guru='$id'");
    header("Location: AdminGuru.php");
}

// ambil data edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM data_guru WHERE id_guru='$id'"));
}

// update data
if (isset($_POST['update'])) {
    $id     = $_POST['id_guru'];
    $nama   = $_POST['nama_guru'];
    $mapel  = $_POST['mata_pelajaran'];
    $harga  = $_POST['harga_perjam'];

    mysqli_query($koneksi, "UPDATE data_guru SET 
        nama_guru='$nama',
        mata_pelajaran='$mapel',
        harga_perjam='$harga'
        WHERE id_guru='$id'");

    header("Location: AdminGuru.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Guru - Admin GuruKu</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
body{
    display:flex;
    min-height:100vh;
    background:#f4f6fb;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:250px;
    background:linear-gradient(180deg,#667eea,#764ba2);
    color:#fff;
    padding:30px 20px;
    position:fixed;
    height:100vh;
}
.sidebar h2{
    text-align:center;
    margin-bottom:40px;
}
.sidebar a{
    display:block;
    color:#fff;
    text-decoration:none;
    padding:14px 18px;
    border-radius:12px;
    margin-bottom:12px;
    transition:.3s;
    font-size:14px;
}
.sidebar a:hover,
.sidebar a.active{
    background:rgba(255,255,255,.25);
}

/* ===== CONTENT ===== */
.content{
    margin-left:250px;
    padding:30px;
    width:100%;
}

h1{
    color:#4b0082;
    margin-bottom:20px;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:18px;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    margin-bottom:30px;
}

h2{
    color:#4b0082;
    margin-bottom:15px;
}

/* ===== FORM ===== */
input,button{
    width:100%;
    padding:12px;
    border-radius:12px;
    border:1px solid #ddd;
    margin-bottom:12px;
    font-size:14px;
}
button{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:#fff;
    border:none;
    cursor:pointer;
}

/* ===== TABLE ===== */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}
th,td{
    padding:14px;
    font-size:14px;
}
th{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:#fff;
}
tr:nth-child(even){
    background:#f8f9ff;
}
tr:hover{
    background:#eef1ff;
}

.aksi a{
    margin-right:10px;
    text-decoration:none;
    font-weight:600;
    color:#5e35b1;
}
</style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <h2>GuruKu Admin</h2>
    <a href="Admin.php">🏠 Dashboard</a>
    <a href="AdminGuru.php" class="active">👩‍🏫 Data Guru</a>
    <a href="AdminUser.php">📋 Data Pesanan</a>
      <a href="Logout.php" onclick="return confirm('Yakin ingin logout?')">
        Logout
      </a>
</div>

<!-- ===== CONTENT ===== -->
<div class="content">

<h1>Data Guru</h1>

<!-- ===== TABEL DATA GURU ===== -->
<div class="card">
<table>
<tr>
    <th>Nama Guru</th>
    <th>Mata Pelajaran</th>
    <th>Harga / Jam</th>
    <th>Aksi</th>
</tr>

<?php
$guru = mysqli_query($koneksi, "SELECT * FROM data_guru ORDER BY nama_guru ASC");
while ($g = mysqli_fetch_assoc($guru)) {
?>
<tr>
    <td><?= $g['nama_guru']; ?></td>
    <td><?= $g['mata_pelajaran']; ?></td>
    <td>Rp <?= number_format($g['harga_perjam'],0,',','.'); ?></td>
    <td class="aksi">
        <a href="?edit=<?= $g['id_guru']; ?>">✏ Edit</a>
        <a href="?hapus=<?= $g['id_guru']; ?>" onclick="return confirm('Hapus data guru ini?')">🗑 Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</div>

<!-- ===== FORM TAMBAH / EDIT ===== -->
<div class="card">
<h2><?= $edit ? 'Edit Guru' : 'Tambah Guru'; ?></h2>

<form method="post">
    <input type="hidden" name="id_guru" value="<?= $edit['id_guru'] ?? '' ?>">
    <input type="text" name="nama_guru" placeholder="Nama Guru" required value="<?= $edit['nama_guru'] ?? '' ?>">
    <input type="text" name="mata_pelajaran" placeholder="Mata Pelajaran" required value="<?= $edit['mata_pelajaran'] ?? '' ?>">
    <input type="number" name="harga_perjam" placeholder="Harga Per Jam" required value="<?= $edit['harga_perjam'] ?? '' ?>">

    <button type="submit" name="<?= $edit ? 'update' : 'tambah'; ?>">
        <?= $edit ? 'Update Data Guru' : 'Tambah Data Guru'; ?>
    </button>
</form>
</div>

</div>
</body>
</html>