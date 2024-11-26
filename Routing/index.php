<?php
require_once 'models/UserModel.php';
require_once 'controllers/AuthController.php';

$database = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
$userModel = new UserModel($database);
$authController = new AuthController($userModel);

if ($_SERVER['REQUEST_URI'] === '/register') {
    $response = $authController->register();
    include 'views/register.php';
} elseif ($_SERVER['REQUEST_URI'] === '/login') {
    $response = $authController->login();
    include 'views/login.php';
}
