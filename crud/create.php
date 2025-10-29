<?php
require '../config/config.php';

// Proses tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = 1; // sementara pakai user id 1 (bisa diganti dari session)
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity = $_POST['activity'];

    // Rumus BMR
    if ($gender == "Pria") {
        $bmr = 88.36 + (13.4 * $weight) + (4.8 * $height) - (5.7 * $age);
    } else {
        $bmr = 447.6 + (9.2 * $weight) + (3.1 * $height) - (4.3 * $age);
    }

    // Faktor aktivitas
    $factor = [
        "Sedentary" => 1.2,
        "Lightly Active" => 1.375,
        "Moderately Active" => 1.55,
        "Very Active" => 1.725,
        "Extra Active" => 1.9
    ];

    $daily_calories = $bmr * $factor[$activity];

    // Simpan ke DB
    $query = "INSERT INTO kalkulator (user_id, gender, age, height, weight, activity, bmr, daily_calories)
              VALUES (:user_id, :gender, :age, :height, :weight, :activity, :bmr, :daily_calories)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':user_id' => $user_id,
        ':gender' => $gender,
        ':age' => $age,
        ':height' => $height,
        ':weight' => $weight,
        ':activity' => $activity,
        ':bmr' => $bmr,
        ':daily_calories' => $daily_calories
    ]);

    echo "<script>alert('✅ Data berhasil ditambahkan!'); window.location='read.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Kalori</title>
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
                <a href="read.php" class="btn btn-secondary">Lihat Data</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2>Tambah Data Kebutuhan Kalori</h2>
            <form method="POST">
                <label>Jenis Kelamin</label>
                <select name="gender" required>
                    <option value="">-- Pilih --</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select><br><br>

                <label>Umur</label>
                <input type="number" name="age" required><br><br>

                <label>Tinggi Badan (cm)</label>
                <input type="number" name="height" required><br><br>

                <label>Berat Badan (kg)</label>
                <input type="number" name="weight" required><br><br>

                <label>Aktivitas</label>
                <select name="activity" required>
                    <option value="">-- Pilih --</option>
                    <option value="Sedentary">Sedentary</option>
                    <option value="Lightly Active">Lightly Active</option>
                    <option value="Moderately Active">Moderately Active</option>
                    <option value="Very Active">Very Active</option>
                    <option value="Extra Active">Extra Active</option>
                </select><br><br>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="read.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2025 Kemenkes Kalori Tracker</p>
    </footer>
</body>
</html>
