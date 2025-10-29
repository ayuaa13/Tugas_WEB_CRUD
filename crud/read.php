<?php
require '../config/config.php';

// Ambil data dari tabel kalkulator
$stmt = $pdo->query("SELECT * FROM kalkulator ORDER BY created_at DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kebutuhan Kalori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="header-home">
        <div class="nav-container">
            <div class="logo">
                <img src="../kemenkes.png" alt="Logo Kemenkes" width="60">
                <h1>Kemenkes Kalori Tracker</h1>
            </div>
            <div class="nav-right">
                <a href="create.php" class="btn btn-primary">+ Tambah Data</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2>Daftar Hasil Perhitungan Kalori</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Tinggi (cm)</th>
                        <th>Berat (kg)</th>
                        <th>Aktivitas</th>
                        <th>BMR</th>
                        <th>Kebutuhan Kalori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if ($data) {
                        foreach ($data as $row) {
                            echo "
                            <tr>
                                <td>{$no}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['height']}</td>
                                <td>{$row['weight']}</td>
                                <td>{$row['activity']}</td>
                                <td>".round($row['bmr'])." kcal</td>
                                <td>".round($row['daily_calories'])." kcal</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <a href='update.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-secondary' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='10'>Belum ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>© 2025 Kemenkes Kalori Tracker</p>
    </footer>
</body>
</html>
