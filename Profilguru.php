<?php
session_start();
require "koneksi.php";


if (!isset($_SESSION['login'])) {
    header("Location: LoginGuru.php");
    exit;
}


$idGuru = $_SESSION['id_guru'] ?? $_SESSION['nama_guru']; 

if (isset($_POST['simpan'])) {
    $mapel       = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);
    $harga       = $_POST['harga_perjam'];
    $pengalaman  = $_POST['pengalaman'];
    $tempat      = mysqli_real_escape_string($koneksi, $_POST['tempat']);
    $keterangan  = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    mysqli_query($koneksi,
        "UPDATE data_guru SET
            mata_pelajaran='$mapel',
            harga_perjam='$harga',
            pengalaman='$pengalaman',
            tempat='$tempat',
            keterangan='$keterangan'
         WHERE id_guru='$idGuru' OR nama_guru='$idGuru'" 
    );

    header("Location: ProfilGuru.php");
    exit;
}


$q = mysqli_query($koneksi, "SELECT * FROM data_guru WHERE id_guru='$idGuru' OR nama_guru='$idGuru'");
$guru = mysqli_fetch_assoc($q);


if (!$guru) {
    $guru = [
        'nama_guru' => 'Data Tidak Ditemukan',
        'mata_pelajaran' => '-',
        'harga_perjam' => 0,
        'pengalaman' => 0,
        'tempat' => '-',
        'keterangan' => '-'
    ];
}

$edit = isset($_GET['edit']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - GuruKu</title>
    <style>
      
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f4f6fb;
            color: #333;
        }

       
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #667eea, #764ba2);
            color: #fff;
            padding: 30px 20px;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 12px;
        }

        .sidebar ul li a {
            display: block;
            padding: 14px 18px;
            border-radius: 12px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: translateX(8px);
        }

        .sidebar ul li a.active {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

       
        .container {
            margin-left: 260px; 
            padding: 40px;
            width: 100%;
        }

        .container h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #4b0082;
        }

        
        .profile-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,.08);
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td:first-child {
            width: 200px;
            font-weight: 600;
            color: #555;
            vertical-align: top;
            padding: 15px 0;
        }

        table td {
            padding: 15px 10px;
            font-size: 16px;
        }

       
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input:focus, textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,.1);
        }

       
        .btn-group {
            margin-top: 25px;
        }

        button, .btn-link {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
            font-size: 15px;
        }

        button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(118, 75, 162, 0.3);
        }

        .btn-link {
            background: #f1f1f1;
            color: #444;
            margin-left: 10px;
        }

        .btn-link:hover {
            background: #e2e2e2;
        }

       
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { position: relative; width: 100%; height: auto; border-radius: 0 0 20px 20px; padding: 20px; }
            .container { margin-left: 0; padding: 20px; }
            table tr td:first-child { width: 130px; font-size: 14px; }
            table td { font-size: 14px; }
        }
    </style>
</head>
<body>

<nav class="sidebar">
    <h2>GuruKu</h2>
    <ul>
        <li>
            <a href="HalamanGuru.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'HalamanGuru.php') ? 'active' : ''; ?>">
                Jadwal Les
            </a>
        </li>
        <li>
            <a href="ProfilGuru.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'ProfilGuru.php') ? 'active' : ''; ?>">
                Profil
            </a>
        </li>
        <li>
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">
                Logout
            </a>
        </li>
    </ul>
</nav>

<div class="container">
    <h2>Profil Guru</h2>

    <div class="profile-card">
        <form method="POST">
            <table>
                <tr>
                    <td>Nama Guru</td>
                    <td>: <strong><?= $guru['nama_guru']; ?></strong></td>
                </tr>

                <tr>
                    <td>Mata Pelajaran</td>
                    <td>:
                        <?php if ($edit): ?>
                            <input type="text" name="mata_pelajaran" value="<?= $guru['mata_pelajaran']; ?>" required>
                        <?php else: ?>
                            <?= $guru['mata_pelajaran']; ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Tarif Per Jam</td>
                    <td>:
                        <?php if ($edit): ?>
                            <input type="number" name="harga_perjam" value="<?= $guru['harga_perjam']; ?>" required>
                        <?php else: ?>
                            Rp <?= number_format($guru['harga_perjam'], 0, ',', '.'); ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Pengalaman</td>
                    <td>:
                        <?php if ($edit): ?>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <input type="number" name="pengalaman" value="<?= $guru['pengalaman']; ?>" required style="width:100px;"> tahun
                            </div>
                        <?php else: ?>
                            <?= $guru['pengalaman']; ?> tahun
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Tempat Mengajar</td>
                    <td>:
                        <?php if ($edit): ?>
                            <input type="text" name="tempat" value="<?= $guru['tempat']; ?>" required>
                        <?php else: ?>
                            <?= $guru['tempat']; ?>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td>Keterangan</td>
                    <td>:
                        <?php if ($edit): ?>
                            <textarea name="keterangan" required><?= $guru['keterangan']; ?></textarea>
                        <?php else: ?>
                            <?= $guru['keterangan']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <div class="btn-group">
                <?php if ($edit): ?>
                    <button type="submit" name="simpan">💾 Simpan Perubahan</button>
                    <a href="ProfilGuru.php" class="btn-link">Batal</a>
                <?php else: ?>
                    <a href="ProfilGuru.php?edit=1" class="btn-link" style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff;">✏️ Edit Profil</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

</body>
</html>