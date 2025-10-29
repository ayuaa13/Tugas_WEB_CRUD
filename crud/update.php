<?php
require '../config/config.php';

// Ambil data berdasarkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM kalkulator WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='read.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='read.php';</script>";
    exit;
}

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity = $_POST['activity'];

    // Hitung ulang BMR
    if ($gender == "Pria") {
        $bmr = 88.36 + (13.4 * $weight) + (4.8 * $height) - (5.7 * $age);
    } else {
        $bmr = 447.6 + (9.2 * $weight) + (3.1 * $height) - (4.3 * $age);
    }

    $factor = [
        "Sedentary" => 1.2,
        "Lightly Active" => 1.375,
        "Moderately Active" => 1.55,
        "Very Active" => 1.725,
        "Extra Active" => 1.9
    ];

    $daily_calories = $bmr * $factor[$activity];

    // Update ke database
    $query = "UPDATE kalkulator 
              SET gender=:gender, age=:age, height=:height, weight=:weight, activity=:activity, 
                  bmr=:bmr, daily_calories=:daily_calories 
              WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':gender' => $gender,
        ':age' => $age,
        ':height' => $height,
        ':weight' => $weight,
        ':activity' => $activity,
        ':bmr' => $bmr,
        ':daily_calories' => $daily_calories,
        ':id' => $id
    ]);

    echo "<script>alert('✅ Data berhasil diperbarui!'); window.location='read.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Kalori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="header-home">
        <div class="nav-container">
            <div class="logo">
                <img src="../kemenkes.png" alt="Logo Kemenkes" width="60">
                <h1>Edit Data Kalori</h1>
            </div>
            <div class="nav-right">
                <a href="read.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2>Ubah Data Perhitungan Kalori</h2>
            <form method="POST">
                <label>Jenis Kelamin</label>
                <select name="gender" required>
                    <option value="Pria" <?= $data['gender'] == 'Pria' ? 'selected' : '' ?>>Pria</option>
                    <option value="Wanita" <?= $data['gender'] == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                </select><br><br>

                <label>Umur</label>
                <input type="number" name="age" value="<?= $data['age'] ?>" required><br><br>

                <label>Tinggi Badan (cm)</label>
                <input type="number" name="height" value="<?= $data['height'] ?>" required><br><br>

                <label>Berat Badan (kg)</label>
                <input type="number" name="weight" value="<?= $data['weight'] ?>" required><br><br>

                <label>Aktivitas</label>
                <select name="activity" required>
                    <?php
                    $activities = ["Sedentary", "Lightly Active", "Moderately Active", "Very Active", "Extra Active"];
                    foreach ($activities as $act) {
                        $selected = ($data['activity'] == $act) ? 'selected' : '';
                        echo "<option value='$act' $selected>$act</option>";
                    }
                    ?>
                </select><br><br>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="read.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2025 Kemenkes Kalori Tracker</p>
    </footer>
</body>
</html>
