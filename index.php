<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

$route = $_REQUEST["route"] ?? "undefined";
$method = $_SERVER["REQUEST_METHOD"];

if($route === "login" && $method === "POST"){
    
    include __DIR__ . "/controllers/login/post.php";

    die();

}

if($route === "logout" && $method === "DELETE"){
    
    include __DIR__ . "/controllers/logout/delete.php";

    die();
}