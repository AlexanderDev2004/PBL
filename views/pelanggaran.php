<?php
session_start();
require '../core/dbconfig.php'; // Mengimpor konfigurasi database

// Cek apakah sesi sudah berhasil
// if (!isset($_SESSION['logged_in'])) {
//     header('Location: ../auth/login.php');
//     exit;
// }

// Cek apakah pengguna sudah login
if (!isset($_SESSION['role'])) {
    header('Location: ../auth/login.php');
    exit;
}

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id']; // NIM untuk mahasiswa, NIP untuk dosen/DPA

// Query pelanggaran berdasarkan role
$query = "";
if ($role == "Dosen") {
    $query = "SELECT * FROM tbl_pelanggaran";
} elseif ($role == "DPA") {
    $query = "SELECT * FROM tbl_pelanggaran WHERE kelas = (SELECT kelas FROM tbl_mahasiswa WHERE dpa_id = ?)";
} elseif ($role == "KomDis") {
    $query = "SELECT * FROM tbl_pelanggaran WHERE level = 1";
} elseif ($role == "Mahasiswa") {
    $query = "SELECT * FROM tbl_pelanggaran WHERE nim = ?";
}

// Eksekusi query
$stmt = $conn->prepare($query);
if ($role == "DPA" || $role == "Mahasiswa") {
    $stmt->bind_param("s", $user_id);
}
$stmt->execute();
$result = $stmt->get_result();

?>