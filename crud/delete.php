<?php
require '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pastikan data ada sebelum dihapus
    $check = $pdo->prepare("SELECT * FROM kalkulator WHERE id = :id");
    $check->execute([':id' => $id]);
    $data = $check->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='read.php';</script>";
        exit;
    }

    // Hapus data
    $stmt = $pdo->prepare("DELETE FROM kalkulator WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo "<script>alert('🗑️ Data berhasil dihapus!'); window.location='read.php';</script>";
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location='read.php';</script>";
    exit;
}
?>
