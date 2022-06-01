<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../models/rooms.php";
require __DIR__ . "/../../models/users.php";
require __DIR__ . "/../../library/request.php";

try {
    $token = Request::getHeader("token");
    $user = UserModel::getByToken($token);

    if (!$user) {
        Response::json(401, [], ["success" => false, "error" => "You are not connected"]);
        die();
    }

    $users = RoomModel::getAll();
    Response::json(200, [], [ "Rooms" => $users ]);
    die();


} catch (PDOException $exception) {
    $errorMessage = $exception->getMessage();
    Response::json(500, [], [ "error" => "Error while accessing the database: $errorMessage" ]);
}