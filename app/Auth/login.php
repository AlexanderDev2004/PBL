<?php
// program untuk login user menggunakan nim atau nip dan password (nip di gunakan untuk admin dan dosen kalau untuk nim untuk mahasiswa)

session_start();
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // bisa NIM atau NIP
    $password = $_POST["password"];

    // Ambil user berdasarkan username (NIM atau NIP)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verifikasi password dan peran
    if ($user && password_verify($password, $user["password"])) {

        // Cek peran berdasarkan NIM atau NIP
        if (($user["role"] === 'mahasiswa' && preg_match('/^\d{8,}$/', $username)) || 
            ($user["role"] !== 'mahasiswa' && preg_match('/^\d{7,}$/', $username))) {
            
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];
            
            // Redirect berdasarkan peran
            switch ($user["role"]) {
                case 'admin':
                    header("Location: /admin/nip={$username}");
                    break;
                case 'dosen':
                    header("Location: /dosen/nip={$username}");
                    break;
                case 'kajur':
                    header("Location: /kajur/nip={$username}");
                    break;
                case 'mahasiswa':
                    header("Location: /mahasiswa/nim={$username}");
                    break;
                default:
                    echo "Peran tidak dikenali.";
                    exit();
            }
            exit();
        } else {
            echo "Username tidak sesuai dengan peran Anda!.";
        }
    } else {
        echo "Username (nip atau nim) atau password anda salah.";
    }
}
?>