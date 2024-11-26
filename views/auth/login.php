<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

global $pdo;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "Login gagal. Periksa kembali kredensial Anda.";
        exit();
    }

    try {
        // Tentukan query berdasarkan panjang username
        if (strlen($username) >= 10 && strlen($username) <= 12) {  // Asumsi NIM
            $query = "SELECT nim AS username, password, nim AS name, 'mahasiswa' AS role
                      FROM tbl_kredensial_mahasiswa
                      WHERE nim = :username";
        } elseif (strlen($username) == 18) {  // Asumsi NIP
            $query = "SELECT id_pegawai AS username, password, nama_pegawai AS name, nama_role_pegawai AS role
                      FROM tbl_kredensial_pegawai
                      JOIN tbl_role_pegawai ON tbl_kredensial_pegawai.id_role_pegawai = tbl_role_pegawai.id_role_pegawai
                      WHERE id_pegawai = :username";
        } else {
            echo "Login gagal. Periksa kembali kredensial Anda.";
            exit();
        }

        // Eksekusi query
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Cek apakah username ditemukan
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];

                // Redirect sesuai role
                $redirectMap = [
                    'mahasiswa' => '../views/pages/dasbords/mhs_dasbord.php',
                    'dosen' => '../views/pages/dasbords/pegawai_dasbord.php',
                    'dpa' => '../views/pages/dasbords/pegawai_dasbord.php',
                    'komdis' => '../views/pages/dasbords/pegawai_dasbord.php',
                    'admin' => '../views/pages/dasbords/pegawai_dasbord.php',
                ];

                $redirectUrl = $redirectMap[$user['role']] ?? '/login';
                header("Location: $redirectUrl");
                exit();
            }
        }

        // Jika login gagal
        echo "Login gagal. Periksa kembali kredensial Anda.";
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    }
}
?>

<form method="POST" action="views/components/footer.php">  
    <h1>Login</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
</form>
