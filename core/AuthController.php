<?php


namespace app\core;




class AuthController extends Controller
{
    public static function login()
    {
        $data = [
            'vardas' => 'Aqilina'
        ];
        return Application::$app->router->renderView('login', $data);
    }
}