<?php
session_start();

// Periksa dan masukkan file konfigurasi database
if (!file_exists(realpath(__DIR__ . '/../../core/dbconfig.php'))) {
    die("File konfigurasi database tidak ditemukan!");
}
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Semua field harus diisi!";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "Password dan Konfirmasi Password tidak cocok!";
        exit();
    }

    // Validasi panjang username (NIM atau NIP)
    if (!(strlen($username) >= 10 && strlen($username) <= 18)) {
        echo "Username harus berupa NIM (10-12 karakter) atau NIP (18 karakter)!";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        global $pdo;

        // Cek apakah username sudah ada
        $checkQuery = "SELECT username FROM tbl_pegawai WHERE username = :username
                       UNION 
                       SELECT nim FROM tbl_kredensial_mahasiswa WHERE nim = :username";
        $stmt = $pdo->prepare($checkQuery);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Username sudah digunakan!";
            exit();
        }

        // Insert ke tabel yang sesuai
        if (strlen($username) >= 10 && strlen($username) <= 12) {  // NIM
            $query = "INSERT INTO tbl_kredensial_mahasiswa (nim, email, password) VALUES (:username, :email, :password)";
        } else {  // NIP
            $query = "INSERT INTO tbl_pegawai (id_pegawai, email, password) VALUES (:username, :email, :password)";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        echo "Pendaftaran berhasil! Silakan login.";
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!-- Form HTML -->
<form method="POST" action="/register">
    <h1>Register</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <button type="submit" name="signup">Register</button>
</form>
