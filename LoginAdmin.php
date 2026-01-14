<?php
session_start();
require "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM admin 
        WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['login_admin'] = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];

        header("Location:Admin.php");
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
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e293b;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 30px;
            background: #4facfe;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #00f2fe;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <?php if ($error != "") : ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

<form method="POST" autocomplete="off">
    <input type="text" name="username" placeholder="Username"
           autocomplete="off" required>

    <input type="password" name="password" placeholder="Password"
           autocomplete="new-password" required>

    <button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>
