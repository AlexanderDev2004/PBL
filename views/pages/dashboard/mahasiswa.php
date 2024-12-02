<?php
session_start();
include_once realpath(__DIR__ . '/../../../core/dbconfig.php');

// Cek apakah user sudah login dan role-nya mahasiswa
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../../auth/login.php");
    exit();
}

// Ambil data mahasiswa dari database
$nim = $_SESSION['user_id'];
$sql = "EXEC GetDetailMahasiswa @Nim = ?";
$stmt = sqlsrv_prepare($conn, $sql, array($nim));

if (sqlsrv_execute($stmt)) {
    $mahasiswa = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
   
</head>
<body>
    <div class="container">
        <header>
            <h1>Dashboard Mahasiswa</h1>
            <div class="user-info">
                <p>Selamat datang, <?= htmlspecialchars($mahasiswa['Nama']) ?></p>
                <p>NIM: <?= htmlspecialchars($mahasiswa['Nim']) ?></p>
            </div>
            <a href="../../auth/logout.php" class="logout-btn">Logout</a>
        </header>

        <main>
            <div class="profile-section">
                <h2>Profil Mahasiswa</h2>
                <div class="profile-details">
                    <p><strong>Program Studi:</strong> <?= htmlspecialchars($mahasiswa['ProgramStudi']) ?></p>
                    <p><strong>Fakultas:</strong> <?= htmlspecialchars($mahasiswa['Fakultas']) ?></p>
                    <p><strong>Angkatan:</strong> <?= htmlspecialchars($mahasiswa['Angkatan']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($mahasiswa['Email']) ?></p>
                </div>
            </div>

            <div class="menu-section">
                <h2>Menu</h2>
                <div class="menu-grid">
                    <a href="akademik.php" class="menu-item">
                        <i class="fas fa-book"></i>
                        <span>Akademik</span>
                    </a>
                    <a href="jadwal-kuliah.php" class="menu-item">
                        <i class="fas fa-calendar"></i>
                        <span>Jadwal Kuliah</span>
                    </a>
                    <a href="nilai.php" class="menu-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Nilai</span>
                    </a>
                    <a href="krs.php" class="menu-item">
                        <i class="fas fa-edit"></i>
                        <span>KRS</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>