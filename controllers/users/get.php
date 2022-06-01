<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../models/users.php";
require __DIR__ . "/../../library/request.php";

try {
    $token = Request::getHeader("token");
    $user = UserModel::getByToken($token);

    if (!$user) {
        Response::json(401, [], ["success" => false, "error" => "Unauthorized"]);
        die();
    }

    if($user["role"] === "ADMINISTRATOR"){
        $users = UserModel::getAll();
        Response::json(200, [], [ "users_get_by_admin" => $users ]);
        die();
    }

    Response::json(401, [], ["success" => false, "error" => "Not admin"]);
    die();

    





} catch (PDOException $exception) {
    $errorMessage = $exception->getMessage();
    Response::json(500, [], [ "error" => "Error while accessing the database: $errorMessage" ]);
}