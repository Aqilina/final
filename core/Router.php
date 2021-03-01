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
        //universalus budas kaip nurodyti kelia iki direktorijos (kaip anksciau config faile APPROOT)
        $layout = $this->layoutContent();
        $page =  $this->pageContent($view, $params);

        //take layout and replace the {{content}} with the $page content
        // 1. ka pakeisiu, 2. kuo pakeisiu, 3. kur pakeisiu
        //RETURNAS NESUVEIKE
        echo str_replace('{{content}}', $page, $layout);
    }

    protected function layoutContent()
    {
        ob_start(); //paima i atminti stringo pavidalu
        include_once Application::$ROOT_DIR . "/view/layout/main.php";
        return ob_get_clean(); // grazina i iskvietimo vieta viska stringo pavidalu
    }

    protected function pageContent($view, $params) {
        ob_start();
        include_once Application::$ROOT_DIR . "/view/$view.php";
        return ob_get_clean();
    }


}