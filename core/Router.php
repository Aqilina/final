<?php


namespace app\core;


/**
 * This is where we call controllers and methods
 * Class Router
 * @package app\core
 */
class Router
{
    public function __construct()
    {
        print "Router is working";
    }

    /**
     *  This will hold all routes.
     * @var array
     */
    protected array $routes = [];



    //GET kelio atvaizdavimas
    /**
     * Adds get route and callback fn to routes array
     * @param string $path
     * @param $callback
     */
    public function get($path, $callback) {


        //sukuria routuose toki elementa
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        var_dump($this->routes);
        exit;
    }
}