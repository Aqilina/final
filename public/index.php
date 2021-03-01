<?php

require_once '../vendor/autoload.php';

use app\core\Application;
use app\core\AuthController;

$app = new Application(dirname(__DIR__));


$app->router->get('/', 'index');
$app->router->get('/index', 'index');

$app->router->get('/login', [AuthController::class, 'login']);

$app->run();