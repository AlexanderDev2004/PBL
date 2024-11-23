<!-- Auth Sing Up -->
<?php
session_start();
include_once '../core/dbconfig.php';

use PDO;


if (isset($_POST['login'])) {
    $username = $_POST['username'];  // NIM atau NIP yang nanti akan di cek
    $password = $_POST['password'];  // Password
    $password_verify = $_POST['password_verify'];  // Password yang di cek apakah sesuai dengan password yang di input 

    if ($password != $password_verify) {
        echo "Maaf Password Anda tidak cocok!";
        exit();
    }

    // Cek apakah username adalah NIM atau NIP (misalnya, berdasarkan panjang karakter)
    if (strlen($username) == 10) {  // Asumsi NIM 10 karakter, sesuaikan jika berbeda
        // Query untuk mahasiswa
        $query = "SELECT m.NIM, m.nama_mahasiswa, m.angkatan, p.nama_prodi, k.nama_kelas, s.status_mahasiswa
                  FROM tbl_mahasiswa m
                  JOIN tbl_prodi p ON m.id_prodi = p.id_prodi
                  JOIN tbl_kelas k ON m.id_kelas = k.id_kelas
                  JOIN tbl_status_mhs s ON m.id_status_mhs = s.id_status_mahasiswa
                  WHERE m.NIM = :username A ND m.password = :password";
    } else {
        // Query untuk dosen/DPA/komdis
        $query = "SELECT p.id_pegawai, p.nama_pegawai, r.nama_role_pegawai
                  FROM tbl_pegawai p
                  JOIN tbl_role_pegawai r ON p.id_role_pegawai = r.id_role_pegawai
                  WHERE p.id_pegawai = :username AND p.password = :password";
    }

    // Persiapkan dan eksekusi query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Cek apakah ada hasil
    if ($stmt->rowCount() > 0) {
        // Set session berdasarkan data yang ditemukan
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = isset($user['nama_role_pegawai']) ? $user['nama_role_pegawai'] : 'mahasiswa';
        $_SESSION['nama'] = isset($user['nama_mahasiswa']) ? $user['nama_mahasiswa'] : $user['nama_pegawai'];

        header("Location: ../index.php");
        exit();
    } else {
        echo "Username atau password salah.";
    }
}
?>

<!-- aku mau buat pages login -->
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password_verify">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_verify" name="password_verify" placeholder="Konfirmasi Password">
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
