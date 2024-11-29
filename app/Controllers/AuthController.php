<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController {
    public function register(Request $request, Response $response) {
        $data = $request->getParsedBody();
        // Logika registrasi di sini
        $response->getBody()->write("Registrasi berhasil!");
        return $response;
    }

    public function login(Request $request, Response $response) {
        $data = $request->getParsedBody();
        // Logika login di sini
        $response->getBody()->write("Login berhasil!");
        return $response;
    }
}
