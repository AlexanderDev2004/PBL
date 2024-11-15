<!-- Auth Sign Up -->
<?php
session_start();
include_once '../core/dbconfig.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO tbl_pegawai (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $_SESSION['username'] = $username;
    header("Location: ../index.php");
    exit();
}
?>