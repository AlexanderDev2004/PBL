<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

// global $pdo;
global $conn;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input
    // if (empty($username) || empty($password)) {
    //     echo "NIM/NIP atau Password tidak boleh kosong.";
    //     exit();
    // }

    // try {
    //     // Tentukan query berdasarkan panjang username
    //     if (strlen($username) >= 10 && strlen($username) <= 12) { // Asumsi NIM
    //         $query = "SELECT nim AS username, password, nim AS name, 'mahasiswa' AS role
    //                   FROM kredensial_mahasiswa
    //                   WHERE nim = :username";
    //     } elseif (strlen($username) == 18) { // Asumsi NIP
    //         $query = "SELECT kp.id_pegawai AS username, kp.password, rp.role_pegawai AS role, rp.role_pegawai AS name
    //                   FROM kredensial_pegawai kp
    //                   JOIN role_pegawai rp ON kp.id_role_pegawai = rp.id_role_pegawai
    //                   WHERE kp.id_pegawai = :username";
    //     } else {
    //         echo "Format NIM/NIP tidak valid.";
    //         exit();
    //     }

    //     // Eksekusi query
    //     $stmt = $pdo->prepare($query);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->execute();

    //     if ($stmt->rowCount() > 0) {
    //         $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //         $hashedPassword = $user['password']; // Hash dari database

    //         // Verifikasi password
    //         if (password_verify($password, $hashedPassword)) {
    //             // Set session
    //             $_SESSION['username'] = $user['username'];
    //             $_SESSION['role'] = $user['role'];
    //             $_SESSION['name'] = $user['name'];

    //             // Redirect sesuai role
    //             $redirectMap = [
    //                 'mahasiswa' => '../views/pages/dasbords/mhs_dasbord.php',
    //                 'dosen' => '../views/pages/dasbords/pegawai_dasbord.php',
    //                 'dpa' => '../views/pages/dasbords/pegawai_dasbord.php',
    //                 'komdis' => '../views/pages/dasbords/pegawai_dasbord.php',
    //                 'admin' => '../views/pages/dasbords/pegawai_dasbord.php',
    //             ];

    //             $redirectUrl = $redirectMap[$user['role']] ?? '/login';
    //             header("Location: $redirectUrl");
    //             exit();
    //         } else {
    //             echo "Password salah.";
    //         }
    //     } else {
    //         echo "NIM/NIP tidak ditemukan.";
    //     }
    // } catch (PDOException $e) {
    //     echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    // }

    // TEST 
    var_dump($username);
    var_dump($password);

    $sql = "SELECT nim AS username, password, nim AS name, 'mahasiswa' AS role
            FROM kredensial_mahasiswa
            WHERE nim = ?";
    $params = array($username);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    } else {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row) {
            echo "DATA: {$row['username']} - {$row['password']}}}";
        } else {
            echo "Login gagal";
        }
    }
}
?>

<!-- Form Login -->
<form method="POST" action="login.php">  
    <h1>Login</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
</form>
