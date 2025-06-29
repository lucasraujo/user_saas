<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $adataAssets['js']  = file_get_contents(APPPATH . 'Views/login/js/main.js');
        $adataAssets['js']  .= file_get_contents(APPPATH . 'Views/login/modals/login/js/main.js');
        $adataAssets['js']  .= file_get_contents(APPPATH . 'Views/login/modals/register/js/main.js');
        $adataAssets['css'] = file_get_contents(APPPATH . 'Views/login/css/style.css');

        return
        view('include/header') .
        view('login/index').
        view('login/modals/login/index').
        view('login/modals/register/index').
        view('include/footer', $adataAssets);
    }
}
