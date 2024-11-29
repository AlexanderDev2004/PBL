<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Define Routes
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Welcome to Sistem Informasi Tata Tertib JTI");
    return $response;
});

$app->run();
