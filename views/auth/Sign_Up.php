<!-- Auth Sign Up -->
<?php
session_start();
include_once '../core/dbconfig.php';

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password_verify = $_POST['password_verify'];

    // Validasi input
    if (empty($username) || empty($password) || empty($password_verify)) {
        echo "Semua field harus diisi!";
        exit();
    }

    if ($password !== $password_verify) {
        echo "Password dan Konfirmasi Password tidak cocok!";
        exit();
    }

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $query = "INSERT INTO tbl_pegawai (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // Set session dan arahkan ke halaman dashboard
        $_SESSION['username'] = $username;
        header("Location: ../views/pages/dasbords/mhs_dasbord.php");
        exit();
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
                    <h3 class="card-title">Sign Up</h3>
                </div>
                <div class="card-body">
                    <form action="signup.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_verify">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_verify" name="password_verify" placeholder="Konfirmasi Password" required>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
