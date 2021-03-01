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

    public function __construct()
    {
        $this->router = new Router();
    }
}