<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

global $pdo;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "NIM/NIP atau Password tidak boleh kosong.";
        exit();
    }

    try {
        // Tentukan query berdasarkan panjang username
        if (strlen($username) >= 10 && strlen($username) <= 12) { // Asumsi NIM
            $query = "SELECT nim AS username, password, nim AS name, 'mahasiswa' AS role
                      FROM kredensial_mahasiswa
                      WHERE nim = :username";
        } elseif (strlen($username) == 18) { // Asumsi NIP
            $query = "SELECT kredensial_pegawai.id_pegawai AS username, password, nama_pegawai AS name, role_pegawai.role_pegawai AS role
                      FROM kredensial_pegawai
                      JOIN role_pegawai ON kredensial_pegawai.id_role_pegawai = role_pegawai.id_role_pegawai
                      WHERE kredensial_pegawai.id_pegawai = :username";
        } else {
            echo "Format NIM/NIP tidak valid.";
            exit();
        }

        // Eksekusi query
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $user['password']; // Hash dari database

            // Verifikasi password
            if (password_verify($password, $hashedPassword)) {
                echo "Login berhasil.";
                
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
            } else {
                echo "Password salah.";
            }
        } else {
            echo "NIM/NIP tidak ditemukan.";
        }
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    }
}
?>

<form method="POST" action="login.php">  
    <h1>Login</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
</form>
