<?php


namespace app\core;


/**
 * This is where we call controllers and methods
 * Class Router
 * @package app\core
 */
class Router
{
    /**
     *  This will hold all routes.
     * @var array
     */
    protected array $routes = [];
    public Request $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //GET kelio atvaizdavimas

    /**
     * Adds get route and callback fn to routes array
     * @param string $path
     * @param $callback
     */
    public function get($path, $callback)
    {

        //sukuria routuose toki elementa
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        //GAUNAMAS KELIAS PO "LOCALHOST"
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false; // jei bandys ivykdyti kelia, kurio nera

        if ($callback === false) :
            echo "page doesnt exist";
            die();
        endif;


        if (is_string($callback)) :
            return $this->renderView($callback);
        endif;

//        var_dump('PATH:');
//        var_dump($path);
//        var_dump('METHOD:');
//        var_dump($method);
//        var_dump('CALLBACK:');
//        var_dump($callback);
//        var_dump('ROUTES[]:');
//        var_dump($this->routes);

        return call_user_func($callback); //
    }

    public function renderView(string $view, array $params = [])
    {
        $this->layoutContent();
        include_once Application::$ROOT_DIR . "/view/$view.php";
    }

    protected function layoutContent()
    {
        include_once Application::$ROOT_DIR . "/view/layout/main.php";

    }


}