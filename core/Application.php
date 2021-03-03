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
    /**
     * @var Router
     */
    public Router $router;
    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Application
     */
    public static Application $app;
    /**
     * @var Controller
     */
    public Controller $controller;
    /**
     * @var Database
     */
    public Database $db;
    /**
     * @var Session
     */
    public Session $session;


    /**
     * Application constructor.
     * @param $rootPath
     * @param $config
     */
    public function __construct($rootPath, $config)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;

        $this->db = new Database($config['db']);
        $this->session = new Session();
    }

    /**
     * This calls router method resolve which executes user function if it is set in routes array.
     * Runs the application
     */
    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

}