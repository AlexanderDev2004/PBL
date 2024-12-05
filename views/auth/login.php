<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');
require_once('./../../models/Pegawai/PegawaiModel.php');

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

        $resultMahasiswa['response'] = filter_var($resultMahasiswa['response'], FILTER_VALIDATE_BOOLEAN);

        if ($resultMahasiswa['response']) {
            $_SESSION['user_id'] = $_POST['username'];

            header("Location: ../dashboard/mahasiswa.php");
            exit();
        }
    }

    // Cek login pegawai
    $sqlPegawai = "EXEC GetLoginPegawai @IdPegawai = ?, @Password = ?";
    $stmtPegawai = sqlsrv_prepare($conn, $sqlPegawai, array($username, $hashedPassword));

    if ($stmtPegawai && sqlsrv_execute($stmtPegawai)) {
        $resultPegawai = sqlsrv_fetch_array($stmtPegawai, SQLSRV_FETCH_ASSOC);

        $resultPegawai['response'] = filter_var($resultPegawai['response'], FILTER_VALIDATE_BOOLEAN);

        if ($resultPegawai['response']) {
            $_SESSION['user_id'] = $_POST['username'];

            // Redirect berdasarkan role
            switch (getRolePegawai($username)) {
                case 'Dosen':
                    header("Location: ../dashboard/dosen.php");
                    break;
                case 'DPA':
                    header("Location: ../dashboard/dpa.php");
                    break;
                case 'Komisi Disiplin':
                    header("Location: ../dashboard/komdis.php");
                    break;
                case 'Administrator':
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
