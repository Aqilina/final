<?php

require_once '../vendor/autoload.php';

use app\core\Application;
use app\core\AuthController;
use app\controller\SiteController;


//COMPOSER.JSON inicijuota. kad uzkrauti kintamuosius
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);


$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/index', [SiteController::class, 'index']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/feedback', [AuthController::class, 'feedback']);

$app->run();