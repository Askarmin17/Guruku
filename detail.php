<?php
require "koneksi.php";

// validasi id
if (!isset($_GET['id'])) {
    echo "Data tidak ditemukan";
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT * FROM pemesanan WHERE id = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pemesanan tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .card {
            background: #ffffff;
            width: 420px;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,.25);
            animation: fadeIn .6s ease;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #4b0082;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #ddd;
        }

        .item:last-child {
            border-bottom: none;
        }

        .label {
            color: #555;
            font-weight: 500;
        }

        .value {
            font-weight: 600;
            color: #333;
            text-align: right;
        }

        .btn {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: .3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0,0,0,.25);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Detail Jadwal Yang Telah Diambil</h2>

    <div class="item">
        <span class="label">Nama</span>
        <span class="value"><?= $data['nama']; ?></span>
    </div>

    <div class="item">
        <span class="label">No HP</span>
        <span class="value"><?= $data['no_hp']; ?></span>
    </div>

    <div class="item">
        <span class="label">Alamat</span>
        <span class="value"><?= $data['alamat']; ?></span>
    </div>

    <div class="item">
        <span class="label">Tanggal</span>
        <span class="value"><?= $data['tanggal']; ?></span>
    </div>

   <div class="item">
    <span class="label">Guru</span>
    <span class="value"><?= $data['nama_guru']; ?></span>
</div>

<div class="item">
    <span class="label">Tarif Per Jam</span>
    <span class="value">
        <?= "Rp " . number_format($data['tarif'], 0, ',', '.'); ?>
    </span>
</div>

<div class="item">
    <span class="label">Jadwal</span>
    <span class="value"><?= $data['jadwal']; ?></span>
</div>

    <a href="FormSewaGuru.php">
        <button class="btn">Kembali</button>
    </a>
</div>

</body>
</html>
