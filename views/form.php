<?php
session_start();
require '../core/dbconfig.php'; // File koneksi database

// Cek apakah pengguna sudah login dan role adalah Dosen
if (!isset($_SESSION['role']) || $_SESSION['role'] != "Dosen") {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $level = $_POST['level'];
    $keterangan = $_POST['keterangan'];

    // Insert ke tbl_pelanggaran
    $query = "INSERT INTO tbl_pelanggaran (nim, kelas, level, status, keterangan) VALUES (?, ?, ?, '-', ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nim, $kelas, $level, $keterangan);

    if ($stmt->execute()) {
        echo "Pelanggaran berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>