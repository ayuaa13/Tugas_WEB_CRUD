<?php
session_start();

// Jika sudah login, arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

// Cek login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '123') {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php?login=success");
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Kalori Seimbang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
  <div class="login-container card">
    <h2>Login Akun</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="note">Gunakan username: <b>admin</b>, password: <b>123</b></p>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </div>
</body>
</html>
