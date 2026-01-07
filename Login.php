<?php
session_start();
require "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) === 1) {
        $data = mysqli_fetch_assoc($query);
        
      
        $_SESSION['status'] = "login";
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_user'] = $data['nama_lengkap']; 
        
        header("location: FormSewaGuru.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - GuruKu</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; }
        h2 { text-align: center; color: #4b0082; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: linear-gradient(135deg,#667eea,#764ba2); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .error { color: red; font-size: 13px; text-align: center; margin-bottom: 10px; }
        .footer { text-align: center; margin-top: 15px; font-size: 13px; }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login GuruKu</h2>
    
    <?php if($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required 
               autocomplete="off" value="">
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required 
               autocomplete="new-password" value="">
        
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>

    <div class="footer">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
</div>

</body>
</html>