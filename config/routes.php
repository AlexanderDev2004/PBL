<?php
use App\Controllers\AuthController;

$app->get('/', function ($request, $response) {
    $response->getBody()->write("Welcome to Sistem Informasi Tata Tertib JTI");
    return $response;
});

$app->post('/register', [AuthController::class, 'register']);
$app->post('/login', [AuthController::class, 'login']);
