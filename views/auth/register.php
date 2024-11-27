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

        // Periksa koneksi database
        if (!$pdo) {
            die("Koneksi database gagal!");
        }

        // Debugging koneksi
        echo "Koneksi berhasil!<br>";

        // Periksa jika email sudah terdaftar
        $checkEmailQuery = "SELECT * FROM kredensial_mahasiswa WHERE email = :email UNION SELECT * FROM kredensial_pegawai WHERE email = :email";
        $stmt = $pdo->prepare($checkEmailQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Email sudah terdaftar!";
            exit();
        }

        // Tentukan query berdasarkan panjang username (NIM atau NIP)
        if (strlen($username) >= 10 && strlen($username) <= 12) { // Asumsi NIM
            $query = "INSERT INTO kredensial_mahasiswa (nim, email, password) VALUES (:username, :email, :password)";
        } elseif (strlen($username) == 18) { // Asumsi NIP
            $query = "INSERT INTO kredensial_pegawai (id_pegawai, email, password) VALUES (:username, :email, :password)";
        } else {
            echo "Format NIM/NIP tidak valid.";
            exit();
        }

        // Debugging query
        echo "Query yang dieksekusi: $query<br>";

        // Eksekusi query
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Eksekusi dan cek apakah berhasil
        if (!$stmt->execute()) {
            echo "Kesalahan saat menyimpan data:<br>";
            print_r($stmt->errorInfo());
            exit();
        }

        // Redirect setelah berhasil
        if (!headers_sent()) {
            header("Location: ../index.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Error Database: " . $e->getMessage() . " [" . $e->getCode() . "]");
    }
}
?>

<!-- Form HTML -->
<form method="POST" action="">
    <h1>Register</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <input type="file" name="image" id="id_image" accept="image/*" required />
    <button type="submit" name="signup">Register</button>
</form>
