<?php
session_start();

// Cek login
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
    <!-- Salam dan info user -->
    <section class="card">
      <h2 align="center">Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b>!</h2>
      <p align="center">
        Gunakan kalkulator di bawah ini untuk menghitung kebutuhan kalori harian Anda.
        Hasilnya bisa langsung disimpan ke database dan dilihat di menu <b>Data Kalori</b>.
      </p>
    </section>

    <!-- Kalkulator BMR -->
    <section id="hitungBMR" class="card">
      <h2 align="center">Kalkulator Kebutuhan Kalori</h2>
      <table align="center" cellpadding="5" cellspacing="0">
        <thead>
          <tr>
            <th>Data</th>
            <th>Input</th>
            <th>Satuan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Jenis Kelamin</td>
            <td>
              <select id="gender">
                <option>Pilih</option>
                <option>Pria</option>
                <option>Wanita</option>
              </select>
            </td>
            <td>-</td>
            <td>Pilih salah satu</td>
          </tr>
          <tr>
            <td>Umur</td>
            <td><input type="number" id="age" placeholder="Umur"></td>
            <td>Tahun</td>
            <td>Isi umur Anda</td>
          </tr>
          <tr>
            <td>Tinggi Badan</td>
            <td><input type="number" id="height" placeholder="Tinggi"></td>
            <td>cm</td>
            <td>Isi tinggi badan Anda</td>
          </tr>
          <tr>
            <td>Berat Badan</td>
            <td><input type="number" id="weight" placeholder="Berat"></td>
            <td>kg</td>
            <td>Isi berat badan Anda</td>
          </tr>
          <tr>
            <td>Aktivitas</td>
            <td>
              <select id="activity">
                <option>Pilih</option>
                <option>Sedentary</option>
                <option>Lightly Active</option>
                <option>Moderately Active</option>
                <option>Very Active</option>
                <option>Extra Active</option>
              </select>
            </td>
            <td>-</td>
            <td>Tingkat aktivitas harian Anda</td>
          </tr>
        </tbody>
      </table>

      <p align="center">
        <button type="button" id="calcBtn" class="btn btn-primary">Hitung Kalori</button>
      </p>

      <section align="center">
        <h3 id="resultBMR">BMR (Basal Metabolic Rate): --- kcal</h3>
        <h3 id="resultCalories">Kebutuhan Kalori Harian: --- kcal</h3>
      </section>

      <!-- Form tersembunyi untuk kirim data -->
      <form id="saveForm" method="POST" action="crud/save_from_dashboard.php" style="display:none;">
        <input type="hidden" name="gender" id="formGender">
        <input type="hidden" name="age" id="formAge">
        <input type="hidden" name="height" id="formHeight">
        <input type="hidden" name="weight" id="formWeight">
        <input type="hidden" name="activity" id="formActivity">
        <input type="hidden" name="bmr" id="formBMR">
        <input type="hidden" name="daily_calories" id="formCalories">
      </form>
    </section>

    <!-- Tabel Makanan -->
    <section id="jenismakanan" class="card">
      <h2 align="center">Tabel Jenis Makanan dan Kandungan Kalori</h2>
      <table>
        <thead>
          <tr>
            <th>Jenis Makanan</th>
            <th>Contoh</th>
            <th>Kalori (per 100g)</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Karbohidrat</td><td>Nasi, roti, pasta, kentang</td><td>130–200</td></tr>
          <tr><td>Protein</td><td>Daging tanpa lemak, ikan, telur</td><td>100–250</td></tr>
          <tr><td>Lemak Sehat</td><td>Alpukat, kacang, minyak zaitun</td><td>400–900</td></tr>
          <tr><td>Sayuran</td><td>Bayam, brokoli, wortel</td><td>20–50</td></tr>
          <tr><td>Buah-buahan</td><td>Apel, pisang, jeruk</td><td>30–80</td></tr>
        </tbody>
      </table>
    </section>

    <!-- Tips Sehat -->
    <section id="tips" class="card">
      <h2 align="center">Tips Mengelola Asupan Kalori</h2>
      <p>
        Kandungan kalori dapat berbeda tergantung porsi dan cara pengolahan. Untuk hasil akurat, periksa label nutrisi makanan.
      </p>
      <p>
        Usahakan konsumsi <b>karbohidrat, protein, lemak sehat, sayur, dan buah</b> secara seimbang. Perhatikan juga ukuran porsi agar kalori tidak berlebihan.
      </p>
      <p>
        Gunakan menu <b>Data Kalori</b> untuk menyimpan dan memantau hasil perhitungan Anda setiap hari.
      </p>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p><b>Ayu Azzhahra Alwi - 2409106022</b> | Praktikum PemWeb A1'24</p>
    <p>
      Sumber: <a href="https://hellosehat.com/health-tools/kebutuhan-kalori/" target="_blank">© KaloriSehat.com</a>
    </p>
  </footer>
</body>
</html>
