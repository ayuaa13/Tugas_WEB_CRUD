<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Kalori Seimbang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header class="header-home">
    <div class="nav-container">
      <div class="logo">
        <img src="kemenkes.png" alt="Logo Kemenkes" width="80">
        <h1>Kalori Seimbang</h1>
      </div>
      <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
          <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
          <a href="crud/read.php" class="btn btn-secondary">Data Kalori</a>
          <a href="logout.php" class="btn btn-secondary">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container">
    <section class="card">
      <h2>Selamat Datang di <span style="color:#1976d2;">Kalori Seimbang</span></h2>
      <p>
        Website ini membantu Anda menghitung kebutuhan kalori harian berdasarkan 
        <b>usia, berat badan, tinggi badan, dan tingkat aktivitas</b>.
      </p>
      <p>
        Setelah login, Anda bisa mengakses <b>Dashboard</b> untuk menghitung kalori harian 
        dan melihat riwayat data Anda di menu <b>Data Kalori</b>.
      </p>
      <br>
      <?php if (!isset($_SESSION['username'])): ?>
        <a href="login.php" class="btn btn-primary">Mulai Sekarang</a>
      <?php else: ?>
        <a href="dashboard.php" class="btn btn-primary">Pergi ke Dashboard</a>
      <?php endif; ?>
    </section>

    <section class="card" id="tips">
      <h2>Tips Pola Makan Sehat</h2>
      <ul style="margin-left:20px; line-height:1.8;">
        <li>Konsumsi makanan bergizi seimbang dan tinggi serat.</li>
        <li>Batasi makanan tinggi gula, garam, dan lemak.</li>
        <li>Perbanyak minum air putih minimal 8 gelas per hari.</li>
        <li>Lakukan aktivitas fisik minimal 30 menit setiap hari.</li>
        <li>Jaga pola tidur yang cukup (6–8 jam per malam).</li>
      </ul>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p><b>Ayu Azzhahra Alwi - 2409106022</b> | Praktikum PemWeb A1'24</p>
    <p>
      Sumber: <a href="https://hellosehat.com/health-tools/kebutuhan-kalori/" target="_blank">
      © KaloriSehat.com</a>
    </p>
  </footer>
</body>
</html>
