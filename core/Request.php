<?php


namespace app\core;

//KA NORIM UZKRAUT - KO PRASE VARTOTOJAS
class Request
{
    public function getPath()
    {
        //jei sita reiksme $_SERVER['REQUEST_URI'] nenusetinta - duodam '/'
        // '/php/32_eshop_toLaraStyle/'
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $questionMarkPosition = strpos($path, '?');
    }
}