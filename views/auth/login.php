<!-- Auth Login -->
<?php
session_start();
include_once '../core/dbconfig.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_pegawai WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        echo "Username atau password salah.";
    }
}
?>