<?php


namespace app\controller;

use app\core\Controller;



class SiteController extends Controller

{

    public function index()
    {
        return $this->render('index');
    }


}


