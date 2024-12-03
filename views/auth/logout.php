<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Hapus user dari session
unset($_SESSION['user_id']);
unset($_SESSION['role']);

// Hapus user dari database sebagai mahasiswa
$nim = $_SESSION['user_id'];
$sql = "EXEC DeleteUser @Nim = ?";
$stmt = sqlsrv_prepare($conn, $sql, array($nim));


if (sqlsrv_execute($stmt)) {
    header("Location: ../index.php");
}
?>
