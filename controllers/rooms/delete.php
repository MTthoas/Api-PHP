<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../models/rooms.php";
require __DIR__ . "/../../models/users.php";
require __DIR__ . "/../../library/request.php";

try {

    $token = Request::getHeader("token");
    $user = UserModel::getByToken($token);


    if(!$user){
        Response::json(201, [], ["success" => false, "step" => "not connected"]);
        die();
    }

    if($user["role"] === "ADMINISTRATOR"){

        $json = Request::getJsonBody();
        RoomModel::deleteById($json);
        Response::json(201, [], ["success" => true, "step" => "Delete room by the administrator"]);
        die();

    }else{

        Response::json(201, [], ["success" => false, "step" => "Not authorized to delete room"]);
        die();
    }

    $json = Request::getJsonBody();
    $room = RoomModel::getById($json["id"]);

    if(!$room){
        Response::json(201, [], ["success" => false, "step" => "User not found"]);
        die();
    }

    
} catch (PDOException $exception) {
    $errorMessage = $exception->getMessage();
    Response::json(500, [], [ "error" => "Error while accessing the database: $errorMessage" ]);
}