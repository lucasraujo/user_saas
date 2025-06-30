<?php

if (!function_exists('authUser')) {
    function authUser()
    {
        return service('request')->user;
    }
}