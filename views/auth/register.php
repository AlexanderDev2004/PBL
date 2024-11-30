<?php
session_start();

if (!file_exists(realpath(__DIR__ . '/../../core/dbconfig.php'))) {
    die("File konfigurasi database tidak ditemukan!");
}
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // $id_image = $_POST['id_image'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Semua field harus diisi!";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "Password dan Konfirmasi Password tidak cocok!";
        exit();
    }

    if (!(strlen($username) >= 10 && strlen($username) <= 18)) {
        echo "Username harus berupa NIM (10-12 karakter) atau NIP (18 karakter)!";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validasi gambar
    if (isset($_FILES['id_image']) && $_FILES['id_image']['error'] === UPLOAD_ERR_OK) {
        $FileName = $_FILES['id_image']['name']; // Nama file
        $FileTmp = $_FILES['id_image']['tmp_name']; // Path file sementara
        $ImageData = file_get_contents($FileTmp); // Data binary file
    } else {
        echo "Gagal mengunggah file gambar!";
        exit();
    }

    var_dump($_POST, $_FILES, $FileName, $FileTmp);


    try {
        // Periksa jika email sudah terdaftar
        $checkEmailQuery = "SELECT * FROM kredensial_mahasiswa WHERE email = ? UNION SELECT * FROM kredensial_pegawai WHERE email = ?";
        $stmt = sqlsrv_query($conn, $checkEmailQuery, array($email, $email));

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_has_rows($stmt)) {
            echo "Email sudah terdaftar!";
            exit();
        }

        // Tentukan tabel berdasarkan panjang username
        if (strlen($username) >= 10 && strlen($username) <= 12) {
            // $sql = "INSERT INTO kredensial_mahasiswa (nim, email, password) VALUES (?, ?, ?)";
            $sql = "EXEC GetRegisterMahasiswa @Nim = ?, @Email = ?, @Password = ?, @FileName = ?, @ImageData = ?";
        } elseif (strlen($username) == 18) {
            // $sql = "INSERT INTO kredensial_pegawai (id_pegawai, email, password) VALUES (?, ?, ?)";
            $sql = "EXEC GetRegisterPegawai @IdPegawai = ?, @Email = ?, @Password = ?, @FileName = ?, @ImageData = ?";
        } else {
            echo "Format NIM/NIP tidak valid.";
            exit();
        }

        // Eksekusi query
        $params = array($username, $email, $hashed_password, $FileName, $ImageData);
        $stmt = sqlsrv_query($conn, $sql, $params);

        echo "TESTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT\n" . $stmt['result'];
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        header("Location: ../views/index.php");
        exit();
    } catch (Exception $e) {
        die("Error Database: " . $e->getMessage());
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <h1>Register</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
    <input type="file" name="id_image" id="id_image" accept="image/*" required />
    <button type="submit" name="signup">Register</button>
</form>
