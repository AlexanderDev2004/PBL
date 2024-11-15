<!-- Auth Login -->
<?php
session_start();
include_once '../core/dbconfig.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];  // NIM atau NIP
    $password = $_POST['password'];  // Password

    // Cek apakah username adalah NIM atau NIP (misalnya, berdasarkan panjang karakter)
    if (strlen($username) == 10) {  // Asumsi NIM 10 karakter, sesuaikan jika berbeda
        // Query untuk mahasiswa
        $query = "SELECT m.NIM, m.nama_mahasiswa, m.angkatan, p.nama_prodi, k.nama_kelas, s.status_mahasiswa
                  FROM tbl_mahasiswa m
                  JOIN tbl_prodi p ON m.id_prodi = p.id_prodi
                  JOIN tbl_kelas k ON m.id_kelas = k.id_kelas
                  JOIN tbl_status_mhs s ON m.id_status_mhs = s.id_status_mahasiswa
                  WHERE m.NIM = :username AND m.password = :password";
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
