<?php
session_start();
require '../config/config.php';

// Ambil semua data dari tabel kalkulator
$stmt = $pdo->query("SELECT * FROM kalkulator ORDER BY id DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kalori</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header class="header-home">
    <div class="nav-container">
      <div class="logo">
        <img src="../kemenkes.png" width="70">
        <h1>Data Kalori Harian</h1>
      </div>
      <div class="nav-right">
        <a href="../dashboard.php" class="btn btn-secondary">Dashboard</a>
        <a href="create.php" class="btn btn-primary">Tambah Manual</a>
        <a href="../logout.php" class="btn btn-secondary">Logout</a>
      </div>
    </div>
  </header>

  <main class="container">
    <section class="card">
      <h2 align="center">Daftar Data Kalori</h2>

      <?php if (isset($_GET['status']) && $_GET['status'] === 'saved'): ?>
        <p align="center" style="color:green;"><b>✅ Data baru berhasil disimpan!</b></p>
      <?php endif; ?>

      <table border="1" cellpadding="5" cellspacing="0" align="center">
        <thead>
          <tr>
            <th>No</th>
            <th>Gender</th>
            <th>Umur</th>
            <th>Tinggi (cm)</th>
            <th>Berat (kg)</th>
            <th>Aktivitas</th>
            <th>BMR</th>
            <th>Kalori Harian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($data as $row): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['gender']); ?></td>
            <td><?= $row['age']; ?></td>
            <td><?= $row['height']; ?></td>
            <td><?= $row['weight']; ?></td>
            <td><?= htmlspecialchars($row['activity']); ?></td>
            <td><?= $row['bmr']; ?></td>
            <td><?= $row['daily_calories']; ?></td>
            <td>
              <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
              <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-secondary" onclick="return confirm('Hapus data ini?');">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>

  <footer>
    <p><b>Ayu Azzhahra Alwi - 2409106022</b> | Praktikum PemWeb A1'24</p>
  </footer>
</body>
</html>
