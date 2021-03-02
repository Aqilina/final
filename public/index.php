<?php

require_once '../vendor/autoload.php';

use app\core\Application;
use app\core\AuthController;
use app\controller\CommentsController;
use app\core\Api;


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


$app->router->get('/', 'index');
$app->router->get('/index', [CommentsController::class, 'index']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

//not registered
$app->router->get('/feedback', [CommentsController::class, 'feedback']);

//registered
$app->router->get('/commentsGetFromDb', [Api::class, 'commentsGetFromDb']);

//registered - post
$app->router->post('/addComment', [Api::class, 'addComment']);

$app->run();