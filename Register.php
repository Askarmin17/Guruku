<?php
require "koneksi.php";

$pesan = "";

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 
    
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    
    if (mysqli_num_rows($cek_user) > 0) {
        $pesan = "Username sudah digunakan, cari yang lain!";
    } else {
        
        $input = mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, username, password) VALUES ('$nama', '$username', '$password')");
        
        if ($input) {
            echo "<script>
                    alert('Registrasi Berhasil! Silakan Login.');
                    window.location='login.php';
                  </script>";
        } else {
            $pesan = "Gagal mendaftar, coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - GuruKu</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .register-card { background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; }
        h2 { text-align: center; color: #4b0082; margin-bottom: 20px; }
        label { font-size: 14px; color: #555; }
        input { width: 100%; padding: 12px; margin: 8px 0 15px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #764ba2; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        button:hover { background: #667eea; }
        .error { color: red; font-size: 13px; text-align: center; margin-bottom: 10px; }
        .footer { text-align: center; margin-top: 15px; font-size: 13px; }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Daftar Akun</h2>
    
    <?php if($pesan): ?>
        <p class="error"><?= $pesan ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" placeholder="Masukkan nama asli" required 
               autocomplete="off" value="">
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Buat username" required 
               autocomplete="off" value="">
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Buat password" required 
               autocomplete="new-password" value="">
        
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>

    <div class="footer">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

</body>
</html>