<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

// global $pdo;
global $conn;

if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Hash password
    $hashedPassword = hash('sha256', $password); // Gunakan password_hash saat produksi

    // Cek login mahasiswa
    $sqlMahasiswa = "EXEC GetLoginMahasiswa @Nim = ?, @Password = ?";
    $stmtMahasiswa = sqlsrv_prepare($conn, $sqlMahasiswa, array($username, $hashedPassword));

    if ($stmtMahasiswa && sqlsrv_execute($stmtMahasiswa)) {
        $resultMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);

        if ($resultMahasiswa) {
            $_SESSION['user_id'] = $resultMahasiswa['Nim'];
            $_SESSION['role'] = 'mahasiswa';
            header("Location: ../dashboard/mahasiswa.php");
            exit();
        }
    }

    // Cek login pegawai
    $sqlPegawai = "EXEC GetLoginPegawai @Nip = ?, @Password = ?";
    $stmtPegawai = sqlsrv_prepare($conn, $sqlPegawai, array($username, $hashedPassword));

    if ($stmtPegawai && sqlsrv_execute($stmtPegawai)) {
        $resultPegawai = sqlsrv_fetch_array($stmtPegawai, SQLSRV_FETCH_ASSOC);

        if ($resultPegawai) {
            $_SESSION['user_id'] = $resultPegawai['Nip'];
            $_SESSION['role'] = $resultPegawai['Role'];

            // Redirect berdasarkan role
            switch ($resultPegawai['Role']) {
                case 'dosen':
                    header("Location: ../dashboard/dosen.php");
                    break;
                case 'dpa':
                    header("Location: ../dashboard/dpa.php");
                    break;
                case 'komdis':
                    header("Location: ../dashboard/komdis.php");
                    break;
                case 'admin':
                    header("Location: ../dashboard/admin.php");
                    break;
            }
            exit();
        }
    }

    // Jika login gagal
    $_SESSION['error'] = "Maaf NIM/NIP atau Password anda salah";
    header("Location: login.php");
    exit();
}
?>

<!-- Form Login -->
<?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form method="POST" action="login.php">  
    <h1>Login</h1>
    <input type="text" name="username" placeholder="NIM/NIP" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
</form>
