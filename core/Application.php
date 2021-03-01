<?php


namespace app\core;

/**
 * This is main Application
 * Class Application
 * @package app\core
 */
class Application
{

    /**
     * This is instance of Router class
     * We will need it routing in all our application - we will have it as a property
     * @var Router
     */
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    //iskviecia routerio metoda,
    //kai run'inama applikacija,
    public function run()
    {
        echo $this->router->resolve();
    }
}