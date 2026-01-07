<?php
session_start();
require "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM guru 
              WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        $_SESSION['login'] = true;
        $_SESSION['nama_guru'] = $data['nama_guru'];

        header("Location: HalamanGuru.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Guru</title>
  <link rel="stylesheet" href="StyleGuru.css">
<style>
* {
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

/* paksa center, abaikan StyleGuru.css */
body {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  background: linear-gradient(135deg, #667eea, #764ba2) !important;
}

/* override container dari file lain */
.container {
  margin: 0 !important;
  width: 380px;
  background: #ffffff;
  padding: 35px 30px;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(0,0,0,.3);
}

/* ===== FORM ===== */

.container h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #4b0082;
}

label {
  font-size: 14px;
  font-weight: 500;
  color: #555;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 12px 14px;
  border-radius: 10px;
  border: 1px solid #ccc;
  outline: none;
  transition: 0.3s;
}

input:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 2px rgba(102,126,234,.2);
}

/* ===== TOMBOL ===== */

input[type="submit"],
button {
  width: 100%;
  padding: 12px;
  border-radius: 12px;
  border: none;
  cursor: pointer;
  transition: 
    transform 0.15s ease,
    box-shadow 0.15s ease,
    background 0.15s ease;
}

/* tombol login */
input[type="submit"] {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  font-weight: 600;
}

input[type="submit"]:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 25px rgba(0,0,0,.3);
}

/* tombol kembali */
button {
  margin-top: 10px;
  background: #f3f4f6;
  color: #444;
  font-weight: 500;
}

button:hover {
  background: #e5e7eb;
}

/* ===== EFEK KLIK (GERAK) ===== */
input[type="submit"]:active,
button:active {
  transform: scale(0.96) translateY(2px);
  box-shadow: 0 5px 12px rgba(0,0,0,.2);
}

/* tombol kembali → merah saat diklik */
button:active {
  background: #dc2626;
  color: #ffffff;
}
</style>



</head>
<body>

<div class="container">
  <h2>Login Guru</h2>

  <?php if (isset($error)) { ?>
    <p style="color:red;"><?php echo $error; ?></p>
  <?php } ?>

 <form method="POST" autocomplete="off">
  <label>Username</label><br>
  <input
    type="text"
    name="username"
    autocomplete="off"
    required
  ><br><br>

  <label>Password</label><br>
  <input
    type="password"
    name="password"
    autocomplete="new-password"
    required
  ><br><br>

  <input type="submit" name="login" value="Login">
  <button type="button" onclick="history.back()">← Kembali</button>
</form>

</div>

</body>
</html>
