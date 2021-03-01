<?php

require_once '../vendor/autoload.php';

use app\core\Application;
use app\core\AuthController;
use app\controller\SiteController;

$app = new Application(dirname(__DIR__));


$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/index', [SiteController::class, 'index']);

$app->router->get('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();