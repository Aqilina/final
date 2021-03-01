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

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;

    public Response $response;
    public static Application $app;
    public Controller $controller;


    //sukuria nauja routeri
    public function __construct($rootPath)
    {

        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;

    }

    //iskviecia routerio metoda,
    //kai run'inama applikacija,
    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

}