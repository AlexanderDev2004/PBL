<?php
// program untuk register admin khusus untuk admin

session_start();
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Username or email already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        $_SESSION["user_id"] = $pdo->lastInsertId();
        header("Location: index.php");
        exit();
    }
}
?>