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


if($route === "users"){
    if($method === "GET"){

        include __DIR__ . "/controllers/users/get.php";
        die();
    }

    if($method === "PATCH"){

        include __DIR__ . "/controllers/users/patch.php";
        die();
    }

    if($method === "POST"){

        include __DIR__ . "/controllers/users/post.php";
        die();
    }

    if($method === "DELETE"){

        include __DIR__ . "/controllers/users/delete.php";
        die();
    }

}

if($route === "rooms"){
    if($method === "GET"){

        include __DIR__ . "/controllers/rooms/get.php";
        die();
    }

    if($method === "PATCH"){

        include __DIR__ . "/controllers/rooms/patch.php";
        die();
    }

    if($method === "POST"){

        include __DIR__ . "/controllers/rooms/post.php";
        die();
    }

    if($method === "DELETE"){

        include __DIR__ . "/controllers/rooms/delete.php";
        die();
    }

}

if($route === "messages"){
    if($method === "GET"){

        include __DIR__ . "/controllers/messages/get.php";
        die();
    }

    if($method === "PATCH"){

        include __DIR__ . "/controllers/messages/patch.php";
        die();
    }

    if($method === "POST"){

        include __DIR__ . "/controllers/messages/post.php";
        die();
    }

    if($method === "DELETE"){

        include __DIR__ . "/controllers/messages/delete.php";
        die();
    }

}

require __DIR__ . "/library/json-response.php";

Response::json(
    404, [], [
    "error" => "Route not found"
    ]
);