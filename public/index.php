<?php

require_once '../vendor/autoload.php';

use app\core\Application;

$app = new Application();

$app->router->get('/', function() {
    return "this is home page";
});

$app->router->get('/about', function() {
    return "this is about page";
});

//Application.php paziures, kokie yra routai ir juo paleis su
// Application.php run() - bus galima nueit tais adresais
$app->run();