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


//------------------------------------------------------------------
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

//ISVALOMAS BODY POST METU
    public function getBody()
    {
        //store clean values
        $body = [];

        //what type of request
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