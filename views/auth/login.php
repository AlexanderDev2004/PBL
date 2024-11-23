<!-- Auth Login -->
<?php
session_start();
include_once '../core/dbconfig.php';


// Cek apakah pengguna sudah login
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    // Enkripsi password dengan password_hash()
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO tbl_pegawai (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $_SESSION['username'] = $username;
    header("Location: ../views/auth/login.php");
    exit();
}
?>

<!-- aku mau buat pages Sing Up -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <form action="Sign_Up.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    