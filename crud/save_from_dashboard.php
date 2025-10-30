<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // kalau kamu punya kolom user_id di tabel user, ganti dengan $_SESSION['user_id']
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity = $_POST['activity'];
    $bmr = $_POST['bmr'];
    $daily_calories = $_POST['daily_calories'];

    $stmt = $pdo->prepare("INSERT INTO kalkulator 
        (user_id, gender, age, height, weight, activity, bmr, daily_calories)
        VALUES (:user_id, :gender, :age, :height, :weight, :activity, :bmr, :daily_calories)");
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

    // Setelah berhasil simpan, langsung ke halaman Data Kalori
    header("Location: ../crud/read.php?status=saved");
    exit;
} else {
    header("Location: ../dashboard.php");
    exit;
}
?>
