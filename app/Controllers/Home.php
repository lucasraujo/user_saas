<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $adataAssets['js']  = file_get_contents(APPPATH . 'Views/home/js/main.js');
        $adataAssets['js']  .= file_get_contents(APPPATH . 'Views/login/modals/registerUpdate/js/main.js');
        $adataAssets['css'] = file_get_contents(APPPATH . 'Views/home/css/style.css');
        
        return
        view('include/header') .
        view('home/index').
        view('login/modals/registerUpdate/index').
        view('include/footer', $adataAssets);
    }
}
