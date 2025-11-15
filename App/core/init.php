<?php


spl_autoload_register(function($className) {

   
    $controllerPath = "../App/controllers/" . ucfirst($className) . ".php";
    $modelPath = "../App/model/" . ucfirst($className) . ".php";

    if (file_exists($controllerPath)) {
        require $controllerPath;
    } elseif (file_exists($modelPath)) {
        require $modelPath;
    }
});


require 'config.php';
require 'function.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
