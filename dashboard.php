<?php
session_start();

// Jika belum login, kembalikan ke login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php?msg=not_logged_in");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Kebutuhan Kalori</title>
  <link rel="stylesheet" href="style.css">
  <script defer src="script.js"></script>
</head>
<body>
  <!-- Header -->
  <header class="header-home">
    <div class="nav-container">
      <div class="logo">
        <img src="kemenkes.png" alt="Logo Kemenkes" width="80">
        <h1>Kebutuhan Kalori Harian</h1>
      </div>
      <div class="nav-right">
        <a href="crud/read.php" class="btn btn-secondary">Data Kalori</a>
        <a href="crud/create.php" class="btn btn-primary">Tambah Data</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
      </div>
    </div>
  </header>

  <!-- Konten utama -->
  <main class="container">
    <!-- Salam & Info User -->
    <section class="card">
      <h2 align="center">Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b>!</h2>
      <p align="center">Gunakan kalkulator di bawah untuk menghitung kebutuhan kalori harian Anda berdasarkan usia, berat badan, tinggi badan, dan aktivitas.</p>
      <p align="center">Hasil perhitungan dapat disimpan di menu <b>Data Kalori</b> untuk dikelola leb
