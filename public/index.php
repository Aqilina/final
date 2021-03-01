<?php

require_once '../vendor/autoload.php';

use app\core\Application;

$app = new Application(dirname(__DIR__));


$app->router->get('/', 'index');
$app->router->get('/index', 'index');


//Application.php paziures, kokie yra routai ir juo paleis su
// Application.php run() - bus galima nueit tais adresais
$app->run();