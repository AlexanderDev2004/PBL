<!-- Auth Login -->
<?php
session_start();
include_once realpath(__DIR__ . '/../../core/dbconfig.php');

global $pdo;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "Username dan Password harus diisi!";
        exit();
    }

    try {
        // Tentukan jenis pengguna berdasarkan panjang username
        if (strlen($username) == 10) {  // NIM
            $query = "SELECT nim AS username, m.password, nim AS name, 'mahasiswa' AS role
                      FROM tbl_kredensial_mahasiswa m
                      WHERE m.NIM = :username";
        } else {  // Pegawai/Dosen
            $query = "SELECT p.id_pegawai AS username, p.password, p.nama_pegawai AS name, r.nama_role_pegawai AS role
                      FROM tbl_kredensial_pegawai p
                      JOIN tbl_role_pegawai r ON p.id_role_pegawai = r.id_role_pegawai
                      WHERE p.id_pegawai = :username";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];

                switch ($user['role']) {
                    case 'mahasiswa':
                        header("Location: ../views/pages/dasbords/mhs_dasbord.php");
                        break;
                    case 'dosen':
                    case 'dpa':
                    case 'komdis':
                    case 'admin':
                        header("Location: ../views/pages/dasbords/pegawai_dasbord.php");
                        break;
                }
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Username tidak ditemukan!";
        }
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>

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
                            <input type="text" class="form-control" id="username" name="username" placeholder="NIM/NIP" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

