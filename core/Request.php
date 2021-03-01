<?php


namespace app\core;

//KA NORIM UZKRAUT - KO PRASE VARTOTOJAS
class Request
{
    public function getPath(): string
    {
        //jei sita reiksme $_SERVER['REQUEST_URI'] nenusetinta - duodam '/'
        // '/php/32_eshop_toLaraStyle/'
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $questionMarkPosition = strpos($path, '?');

        if ($questionMarkPosition !== false) :
            $path = substr($path, 0, $questionMarkPosition);
        endif;

        //kad gale butu galima ivesti slash
        if (strlen($path) > 1) :
            $path = rtrim($path, '/');
        endif;

//        var_dump($questionMarkPosition);

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
}