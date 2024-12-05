<?php
require_once 'models/UserModel.php';
require_once 'controllers/AuthController.php';

// Inisialisasi database dan objek model & controller
$database = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
$userModel = new UserModel($database);
$authController = new AuthController($userModel);

// Mendapatkan rute dari URI
$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Routing berdasarkan rute
switch ($route) {
    case 'login':
        $response = $authController->login(); // Logika login
        include 'views/auth/login.php'; // Tampilkan halaman login
        break;

    case 'register':
        $response = $authController->register(); // Logika register
        include 'views/register.php'; // Tampilkan halaman register
        break;

    default:
        // Jika rute tidak ditemukan
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
