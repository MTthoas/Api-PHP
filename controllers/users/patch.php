<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../library/request.php";
require __DIR__ . "/../../models/users.php";

try {

    $token = Request::getHeader("token");
    $user = UserModel::getByToken($token);

    if(!$user){
        Response::json(401, [], ["success" => false, "step" => "Not connected"]);
    }

    $json = Request::getJsonBody();

    if($user["role"] === "USER"){
        if($user["id"] === $json["id"]){
            UserModel::updateById($json);
            Response::json(401, [], ["success" => true, "step" => "Update of profil done"]);;
            die();
        }else{
            Response::json(401, [], ["success" => false, "step" => "U can't modify data from other"]);;
            die();
        }
    }

    if($user["role"] === "ADMINISTRATOR"){
            UserModel::updateById($json);
            Response::json(401, [], ["success" => true, "step" => "Update of profil done by admnistrator"]);
            die();

    }

    
    $json = Request::getJsonBody();
    $user = UserModel::getById($json["id"]);

    if(!$user){
        Response::json(201, [], ["success" => false, "step" => "User not found"]);
        die();
    }


} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}