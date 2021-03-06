<?php


namespace app\core;


/**
 * Class Request looks for whar user requested
 * @package app\core
 */
class Request
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $questionMarkPosition = strpos($path, '?');

        if ($questionMarkPosition !== false) :
            $path = substr($path, 0, $questionMarkPosition);
        endif;

        if (strlen($path) > 1) :
            $path = rtrim($path, '/');
        endif;

        return $path;
    }

    /**
     * This will return http method get or post
     * @return string
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


//------------------------------------------------------------------

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    /**
     * helper fn returns true if server method is post
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() === 'post';
    }
//---------------------------------------------------------------------


    /**
     * Body is cleaned when method is post and get
     * @return array
     */
    public function getBody()
    {
        $body = [];

        if ($this->isPost()) :
            foreach ($_POST as $key => $value) :
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //isvalom paduota reiksme
            endforeach;
        endif;

        if ($this->isGet()) :
            foreach ($_POST as $key => $value) :
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //isvalom paduota reiksme
            endforeach;
        endif;

        return $body;
    }


    /**
     * Simple way to redirect to a location
     *
     * @param $whereTo string
     */
    public function redirect($whereTo)
    {
        header("Location: $whereTo");
    }
}