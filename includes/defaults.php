<?php

//Esta funcion lo que hace es incluir en el router la vista dinamicamente.
if (!function_exists("view")) {
    function view($nombreVista,$plist)
    {
        include_once "./views/{$nombreVista}.php";
    }
}
if (!function_exists("login")) {
    function login()
    {
        include_once "./index.php";
    }
}
