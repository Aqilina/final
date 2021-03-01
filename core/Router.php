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
        print "Router is working";
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


        var_dump($path);
        var_dump($method);
        var_dump($callback);
    }
}